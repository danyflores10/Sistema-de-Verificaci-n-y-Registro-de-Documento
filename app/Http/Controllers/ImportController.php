<?php

namespace App\Http\Controllers;

use App\Imports\InternalNotesImport;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:204800',
        ], [
            'file.required' => 'Debe seleccionar un archivo Excel.',
            'file.mimes'    => 'El archivo debe ser de tipo: xlsx, xls o csv.',
            'file.max'      => 'El archivo no debe superar los 200 MB.',
        ]);

        try {
            $file = $request->file('file');
            $filePath = $file->getRealPath();

            $import = new InternalNotesImport($request->user()->id, $filePath);
            Excel::import($import, $file);

            $count = $import->getImportedCount();
            $skipped = $import->getSkippedCount();
            $sheets = $import->getSheetsProcessed();

            AuditLog::record('IMPORTAR', 'internal_notes', 0, null, [
                'archivo'  => $file->getClientOriginalName(),
                'cantidad' => $count,
                'omitidos' => $skipped,
                'hojas'    => $sheets,
            ]);

            $msg = "Se importaron {$count} documentos exitosamente";
            if ($sheets > 1) {
                $msg .= " de {$sheets} hojas";
            }
            if ($skipped > 0) {
                $msg .= " ({$skipped} filas omitidas por estar vacías)";
            }
            $msg .= '.';

            return redirect()->route('import.index')
                             ->with('success', $msg);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = "Fila {$failure->row()}: " . implode(', ', $failure->errors());
            }
            return redirect()->route('import.index')
                             ->with('import_errors', $errors)
                             ->with('error', 'Hubo errores en la importación.');
        } catch (\Exception $e) {
            return redirect()->route('import.index')
                             ->with('error', 'Error al procesar el archivo: ' . $e->getMessage());
        }
    }
}
