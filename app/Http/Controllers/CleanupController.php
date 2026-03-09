<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Box;
use App\Models\InternalNote;
use App\Models\NoteAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CleanupController extends Controller
{
    public function index(Request $request)
    {
        $boxes = Box::orderBy('box_number')->get();

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

        $notes = $query->latest('note_date')->paginate(20)->withQueryString();

        return view('cleanup.index', compact('notes', 'boxes'));
    }

    public function destroySelected(Request $request)
    {
        $validated = $request->validate([
            'note_ids'   => 'required|array|min:1',
            'note_ids.*' => 'integer|exists:internal_notes,id',
        ], [
            'note_ids.required' => 'Debe seleccionar al menos un documento.',
            'note_ids.min'      => 'Debe seleccionar al menos un documento.',
        ]);

        $notes = InternalNote::with('attachments')->whereIn('id', $validated['note_ids'])->get();
        $count = 0;

        foreach ($notes as $note) {
            $old = $note->toArray();

            foreach ($note->attachments as $attachment) {
                Storage::disk('public')->delete($attachment->file_path);
                $attachment->delete();
            }

            $note->delete();
            $count++;

            AuditLog::record('ELIMINAR_MASIVO', 'internal_notes', $note->id, $old, null);
        }

        return redirect()->route('cleanup.index')
                         ->with('success', "{$count} documento(s) eliminado(s) permanentemente.");
    }

    public function destroyAll(Request $request)
    {
        $request->validate([
            'confirm_text' => 'required|in:ELIMINAR TODO',
        ], [
            'confirm_text.in' => 'Debe escribir "ELIMINAR TODO" para confirmar.',
        ]);

        $notes = InternalNote::with('attachments')->get();
        $count = 0;

        foreach ($notes as $note) {
            $old = $note->toArray();

            foreach ($note->attachments as $attachment) {
                Storage::disk('public')->delete($attachment->file_path);
                $attachment->delete();
            }

            $note->delete();
            $count++;

            AuditLog::record('ELIMINAR_MASIVO_TODO', 'internal_notes', $note->id, $old, null);
        }

        return redirect()->route('cleanup.index')
                         ->with('success', "{$count} documento(s) eliminado(s) permanentemente.");
    }

    public function destroySystem(Request $request)
    {
        $request->validate([
            'confirm_text' => 'required|in:LIMPIAR SISTEMA',
        ], [
            'confirm_text.in' => 'Debe escribir "LIMPIAR SISTEMA" para confirmar.',
        ]);

        // Eliminar archivos físicos de adjuntos
        $attachments = NoteAttachment::all();
        foreach ($attachments as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        // Eliminar en orden correcto por FK
        NoteAttachment::query()->delete();
        InternalNote::query()->delete();
        Box::query()->delete();
        AuditLog::query()->delete();

        AuditLog::record('LIMPIAR_SISTEMA', 'system', 0, null, ['accion' => 'Limpieza total del sistema (excepto usuarios)']);

        return redirect()->route('cleanup.index')
                         ->with('success', 'Sistema limpiado exitosamente. Se eliminaron todos los documentos, cajas y registros de auditoría.');
    }
}
