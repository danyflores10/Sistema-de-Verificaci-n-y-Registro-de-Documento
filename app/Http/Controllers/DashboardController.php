<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\InternalNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $scopedNotes = InternalNote::query();

        if (!$user->isAdmin()) {
            $scopedNotes->where('created_by', $user->id);
        }

        $totalBoxes = Box::count();
        $totalNotes = (clone $scopedNotes)->count();
        $borradores = (clone $scopedNotes)->where('status', InternalNote::STATUS_BORRADOR)->count();
        $enviados = (clone $scopedNotes)->where('status', InternalNote::STATUS_ENVIADO)->count();
        $verificados = (clone $scopedNotes)->where('status', InternalNote::STATUS_VERIFICADO)->count();
        $rechazados = (clone $scopedNotes)->where('status', InternalNote::STATUS_RECHAZADO)->count();
        $pendientesRevision = $enviados;

        $recentNotes = (clone $scopedNotes)
            ->with(['box', 'creator'])
            ->latest()
            ->paginate(20, ['*'], 'pagina')
            ->withQueryString();

        // Extrae el primer número del campo pages para cálculos numéricos
        // Maneja tanto valores simples ("12") como rangos ("12 - 233")
        // Compatible con MySQL y PostgreSQL
        $sqlDialect = config('database.default');
        if ($sqlDialect === 'pgsql') {
            $totalPages = (int) ((clone $scopedNotes)->selectRaw('COALESCE(SUM(CAST(SPLIT_PART(pages, \'-\', 1) AS INTEGER)), 0) as total')
                ->first()?->total ?? 0);
        } else {
            $totalPages = (int) ((clone $scopedNotes)->selectRaw('COALESCE(SUM(CAST(SUBSTRING_INDEX(pages, \'-\', 1) AS UNSIGNED)), 0) as total')
                ->first()?->total ?? 0);
        }
        $averagePages = $totalNotes > 0 ? round($totalPages / $totalNotes, 1) : 0;
        $verificationRate = $totalNotes > 0 ? round(($verificados / $totalNotes) * 100, 1) : 0;
        $rejectionRate = $totalNotes > 0 ? round(($rechazados / $totalNotes) * 100, 1) : 0;

        $tipologiaStats = (clone $scopedNotes)
            ->selectRaw("COALESCE(NULLIF(TRIM(tipologia), ''), 'SIN TIPOLOGÍA') as label, COUNT(*) as total")
            ->groupBy(DB::raw("COALESCE(NULLIF(TRIM(tipologia), ''), 'SIN TIPOLOGÍA')"))
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        $topBoxes = (clone $scopedNotes)
            ->join('boxes', 'internal_notes.box_id', '=', 'boxes.id');
        
        if ($sqlDialect === 'pgsql') {
            $topBoxes = $topBoxes->selectRaw('boxes.box_number as box_number, COUNT(*) as total_documentos, COALESCE(SUM(CAST(SPLIT_PART(internal_notes.pages, \'-\', 1) AS INTEGER)), 0) as total_fojas');
        } else {
            $topBoxes = $topBoxes->selectRaw('boxes.box_number as box_number, COUNT(*) as total_documentos, COALESCE(SUM(CAST(SUBSTRING_INDEX(internal_notes.pages, \'-\', 1) AS UNSIGNED)), 0) as total_fojas');
        }
        
        $topBoxes = $topBoxes->groupBy('boxes.box_number')
            ->orderByDesc('total_documentos')
            ->limit(6)
            ->get();

        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->copy()->startOfMonth()->subMonths($i);
            $key = $date->format('Y-m');

            $months[$key] = [
                'key' => $key,
                'label' => ucfirst($date->translatedFormat('M y')),
                'total' => 0,
                'enviados' => 0,
                'verificados' => 0,
                'rechazados' => 0,
            ];
        }

        $monthlyNotes = (clone $scopedNotes)
            ->where('created_at', '>=', now()->copy()->startOfMonth()->subMonths(5))
            ->get(['created_at', 'status']);

        foreach ($monthlyNotes as $note) {
            $key = $note->created_at?->format('Y-m');
            if (!$key || !isset($months[$key])) {
                continue;
            }

            $months[$key]['total']++;

            if ($note->status === InternalNote::STATUS_ENVIADO) {
                $months[$key]['enviados']++;
            } elseif ($note->status === InternalNote::STATUS_VERIFICADO) {
                $months[$key]['verificados']++;
            } elseif ($note->status === InternalNote::STATUS_RECHAZADO) {
                $months[$key]['rechazados']++;
            }
        }

        $monthlyStats = array_values($months);

        return view('dashboard', compact(
            'totalBoxes',
            'totalNotes',
            'borradores',
            'enviados',
            'verificados',
            'rechazados',
            'pendientesRevision',
            'recentNotes',
            'totalPages',
            'averagePages',
            'verificationRate',
            'rejectionRate',
            'tipologiaStats',
            'topBoxes',
            'monthlyStats'
        ));
    }
}
