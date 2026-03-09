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
            $import = new InternalNotesImport($request->user()->id);
            Excel::import($import, $request->file('file'));

            $count = $import->getImportedCount();

            AuditLog::record('IMPORTAR', 'internal_notes', 0, null, [
                'archivo'  => $request->file('file')->getClientOriginalName(),
                'cantidad' => $count,
            ]);

            return redirect()->route('import.index')
                             ->with('success', "Se importaron {$count} documentos exitosamente.");
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
