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

        // Documentos registrados por día (últimos 30 días)
        $dailyCounts = InternalNote::selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupByRaw('DATE(created_at)')
            ->orderByRaw('DATE(created_at) DESC')
            ->get();

        return view('reports.index', compact('boxes', 'dailyCounts'));
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
        $query = InternalNote::with(['box', 'creator', 'verifier']);

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

        // Resumen por estado
        $summary = [
            'total'        => $notes->count(),
            'borradores'   => $notes->where('status', 'BORRADOR')->count(),
            'enviados'     => $notes->where('status', 'ENVIADO')->count(),
            'verificados'  => $notes->where('status', 'VERIFICADO')->count(),
            'rechazados'   => $notes->where('status', 'RECHAZADO')->count(),
            'total_fojas'  => $notes->sum(fn ($n) => self::parsePagesValue($n->pages)),
        ];

        // Información de filtros aplicados (para mostrar en el header del PDF)
        $appliedFilters = [];
        if ($boxId = $request->get('box_id')) {
            $boxName = Box::find($boxId)?->box_number;
            if ($boxName) $appliedFilters[] = "Caja: {$boxName}";
        }
        if ($status = $request->get('status')) {
            $appliedFilters[] = "Estado: {$status}";
        }
        if ($dateFrom = $request->get('date_from')) {
            $appliedFilters[] = "Desde: " . \Carbon\Carbon::parse($dateFrom)->format('d/m/Y');
        }
        if ($dateTo = $request->get('date_to')) {
            $appliedFilters[] = "Hasta: " . \Carbon\Carbon::parse($dateTo)->format('d/m/Y');
        }

        $pdf = Pdf::loadView('reports.pdf', compact('notes', 'summary', 'appliedFilters'))
                  ->setPaper('letter', 'landscape');

        return $pdf->download('reporte_documentos_' . now()->format('Y-m-d_His') . '.pdf');
    }

    /**
     * Extrae el primer número del campo "pages".
     * Soporta valores como "12", "12 - 233", "Folios 12", etc.
     */
    public static function parsePagesValue($value): int
    {
        if (is_null($value) || $value === '') {
            return 0;
        }
        if (preg_match('/(\d+)/', (string) $value, $m)) {
            return (int) $m[1];
        }
        return 0;
    }
}
