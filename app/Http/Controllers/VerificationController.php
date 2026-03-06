<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\InternalNote;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Bandeja de revisión del admin: solo notas ENVIADAS
     */
    public function index(Request $request)
    {
        $query = InternalNote::with(['box', 'creator'])
                    ->where('status', 'ENVIADO');

        if ($boxId = $request->get('box_id')) {
            $query->where('box_id', $boxId);
        }
        if ($internalNumber = $request->get('internal_number')) {
            $query->where('internal_number', 'like', "%{$internalNumber}%");
        }

        $notes = $query->oldest()->paginate(15)->withQueryString();

        return view('verification.index', compact('notes'));
    }

    /**
     * Verificar (aprobar) una nota
     */
    public function verify(Request $request, InternalNote $note)
    {
        $this->authorize('verify', $note);

        $old = ['status' => $note->status];

        $note->update([
            'status'      => 'VERIFICADO',
            'verified_by' => $request->user()->id,
            'verified_at' => now(),
            'rejection_reason' => null,
        ]);

        AuditLog::record('VERIFICAR', 'internal_notes', $note->id, $old, [
            'status'      => 'VERIFICADO',
            'verified_by' => $request->user()->id,
        ]);

        return redirect()->route('verification.index')
                         ->with('success', 'Nota verificada exitosamente.');
    }

    /**
     * Rechazar una nota
     */
    public function reject(Request $request, InternalNote $note)
    {
        $this->authorize('verify', $note);

        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ], [
            'rejection_reason.required' => 'Debe indicar el motivo de rechazo.',
        ]);

        $old = ['status' => $note->status];

        $note->update([
            'status'           => 'RECHAZADO',
            'rejection_reason' => $request->rejection_reason,
            'verified_by'      => $request->user()->id,
            'verified_at'      => now(),
        ]);

        AuditLog::record('RECHAZAR', 'internal_notes', $note->id, $old, [
            'status'           => 'RECHAZADO',
            'rejection_reason' => $request->rejection_reason,
            'verified_by'      => $request->user()->id,
        ]);

        return redirect()->route('verification.index')
                         ->with('success', 'Nota rechazada.');
    }

    /**
     * Historial de documentos aprobados (VERIFICADO) con filtros de fecha
     */
    public function approved(Request $request)
    {
        $query = InternalNote::with(['box', 'creator', 'verifier'])
                    ->where('status', 'VERIFICADO');

        if ($dateFrom = $request->get('date_from')) {
            $query->whereDate('verified_at', '>=', $dateFrom);
        }
        if ($dateTo = $request->get('date_to')) {
            $query->whereDate('verified_at', '<=', $dateTo);
        }
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('internal_number', 'like', "%{$search}%")
                  ->orWhere('reference', 'like', "%{$search}%")
                  ->orWhere('remitente', 'like', "%{$search}%")
                  ->orWhere('destinatario', 'like', "%{$search}%");
            });
        }

        $notes = $query->latest('verified_at')->paginate(20)->withQueryString();
        $total = InternalNote::where('status', 'VERIFICADO')->count();

        return view('verification.approved', compact('notes', 'total'));
    }
}
