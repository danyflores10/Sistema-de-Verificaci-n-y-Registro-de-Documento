<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\InternalNote;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $totalBoxes      = Box::count();
            $totalNotes       = InternalNote::count();
            $borradores       = InternalNote::where('status', 'BORRADOR')->count();
            $enviados         = InternalNote::where('status', 'ENVIADO')->count();
            $verificados      = InternalNote::where('status', 'VERIFICADO')->count();
            $rechazados       = InternalNote::where('status', 'RECHAZADO')->count();
            $pendientesRevision = InternalNote::where('status', 'ENVIADO')->count();
            $recentNotes      = InternalNote::with(['box', 'creator'])
                                    ->latest()
                                    ->take(10)
                                    ->get();
        } else {
            $totalBoxes      = Box::count();
            $totalNotes       = InternalNote::where('created_by', $user->id)->count();
            $borradores       = InternalNote::where('created_by', $user->id)->where('status', 'BORRADOR')->count();
            $enviados         = InternalNote::where('created_by', $user->id)->where('status', 'ENVIADO')->count();
            $verificados      = InternalNote::where('created_by', $user->id)->where('status', 'VERIFICADO')->count();
            $rechazados       = InternalNote::where('created_by', $user->id)->where('status', 'RECHAZADO')->count();
            $pendientesRevision = 0;
            $recentNotes      = InternalNote::with(['box', 'creator'])
                                    ->where('created_by', $user->id)
                                    ->latest()
                                    ->take(10)
                                    ->get();
        }

        return view('dashboard', compact(
            'totalBoxes',
            'totalNotes',
            'borradores',
            'enviados',
            'verificados',
            'rechazados',
            'pendientesRevision',
            'recentNotes'
        ));
    }
}
