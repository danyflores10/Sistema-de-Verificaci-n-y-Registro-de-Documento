<?php

namespace App\Http\Controllers;

use App\Exports\InternalNotesExport;
use App\Models\Box;
use App\Models\InternalNote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $boxes = Box::withCount([
            'internalNotes',
            'internalNotes as borradores_count' => fn($q) => $q->where('status', 'BORRADOR'),
            'internalNotes as enviados_count'    => fn($q) => $q->where('status', 'ENVIADO'),
            'internalNotes as verificados_count'  => fn($q) => $q->where('status', 'VERIFICADO'),
            'internalNotes as rechazados_count'   => fn($q) => $q->where('status', 'RECHAZADO'),
        ])->orderBy('box_number')->get();

        return view('reports.index', compact('boxes'));
    }

    /**
     * Exportar a Excel
     */
    public function exportExcel(Request $request)
    {
        $filters = $request->only(['box_id', 'status', 'date_from', 'date_to', 'created_by']);

        return Excel::download(
            new InternalNotesExport($filters),
            'notas_internas_' . now()->format('Y-m-d_His') . '.xlsx'
        );
    }

    /**
     * Exportar a PDF
     */
    public function exportPdf(Request $request)
    {
        $query = InternalNote::with(['box', 'creator']);

        if ($boxId = $request->get('box_id')) {
            $query->where('box_id', $boxId);
        }
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }
        if ($dateFrom = $request->get('date_from')) {
            $query->where('note_date', '>=', $dateFrom);
        }
        if ($dateTo = $request->get('date_to')) {
            $query->where('note_date', '<=', $dateTo);
        }
        if ($createdBy = $request->get('created_by')) {
            $query->where('created_by', $createdBy);
        }

        $notes = $query->orderBy('note_date', 'desc')->get();

        $pdf = Pdf::loadView('reports.pdf', compact('notes'))
                  ->setPaper('letter', 'landscape');

        return $pdf->download('notas_internas_' . now()->format('Y-m-d_His') . '.pdf');
    }
}
