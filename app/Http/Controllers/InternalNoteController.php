<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Box;
use App\Models\InternalNote;
use App\Models\NoteAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InternalNoteController extends Controller
{
    public function index(Request $request)
    {
        $user  = $request->user();
        $query = InternalNote::with(['box', 'creator']);

        // USUARIO solo ve sus registros
        if ($user->isUsuario()) {
            $query->where('created_by', $user->id);
        }

        // Filtros
        if ($boxId = $request->get('box_id')) {
            $query->where('box_id', $boxId);
        }
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }
        if ($internalNumber = $request->get('internal_number')) {
            $query->where('internal_number', 'like', "%{$internalNumber}%");
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

        $notes = $query->latest('note_date')->paginate(15)->withQueryString();
        $boxes = Box::orderBy('box_number')->get();

        return view('notes.index', compact('notes', 'boxes'));
    }

    public function create()
    {
        $this->authorize('create', InternalNote::class);
        $boxes = Box::orderBy('box_number')->get();
        return view('notes.create', compact('boxes'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', InternalNote::class);

        $validated = $request->validate([
            'box_id'          => 'required|exists:boxes,id',
            'internal_number' => 'required|string|max:60',
            'note_date'       => 'required|date',
            'remitente'       => 'required|string|max:200',
            'destinatario'    => 'required|string|max:200',
            'via'             => 'required|string|max:100',
            'reference'       => 'required|string|max:1000',
            'doc_type'        => 'required|in:ORIGINAL,FOTOCOPIA,AMBOS,FOTOGRAFÍA',
            'note_type'       => 'required|in:NOTA INTERNA,NOTA EXTERNA,INFORME,EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO',
            'pages'           => 'required|integer|min:1',
            'observations'    => 'nullable|string|max:2000',
            'attachments'     => 'nullable|array',
            'attachments.*'   => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
        ], [
            'box_id.required'          => 'La caja es obligatoria.',
            'internal_number.required' => 'El CITE es obligatorio.',
            'note_date.required'       => 'La fecha es obligatoria.',
            'remitente.required'       => 'El remitente es obligatorio.',
            'destinatario.required'    => 'El destinatario es obligatorio.',
            'via.required'             => 'La vía de envío es obligatoria.',
            'reference.required'       => 'La referencia es obligatoria.',
            'doc_type.required'        => 'El estado del documento es obligatorio.',
            'doc_type.in'              => 'El estado debe ser ORIGINAL, FOTOCOPIA, AMBOS o FOTOGRAFÍA.',
            'note_type.required'       => 'La nota interno es obligatoria.',
            'note_type.in'             => 'Seleccione un tipo de nota válido.',
            'pages.required'           => 'Las fojas son obligatorias.',
            'pages.min'               => 'Las fojas deben ser al menos 1.',
        ]);

        $note = InternalNote::create([
            'box_id'          => $validated['box_id'],
            'internal_number' => $validated['internal_number'],
            'note_date'       => $validated['note_date'],
            'remitente'       => $validated['remitente'],
            'destinatario'    => $validated['destinatario'],
            'via'             => $validated['via'],
            'reference'       => $validated['reference'],
            'doc_type'        => $validated['doc_type'],
            'note_type'       => $validated['note_type'],
            'pages'           => $validated['pages'],
            'observations'    => $validated['observations'] ?? null,
            'status'          => 'BORRADOR',
            'created_by'      => $request->user()->id,
        ]);

        // Guardar adjuntos
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments/' . $note->id, 'public');
                NoteAttachment::create([
                    'internal_note_id' => $note->id,
                    'original_name'    => $file->getClientOriginalName(),
                    'file_path'        => $path,
                    'mime_type'        => $file->getMimeType(),
                    'file_size'        => $file->getSize(),
                    'uploaded_by'      => $request->user()->id,
                ]);
            }
        }

        AuditLog::record('CREAR', 'internal_notes', $note->id, null, $note->toArray());

        return redirect()->route('notes.index')
                         ->with('success', 'Documento registrado exitosamente.');
    }

    public function show(InternalNote $note)
    {
        $this->authorize('view', $note);
        $note->load(['box', 'creator', 'verifier', 'attachments.uploader']);

        $auditLogs = AuditLog::where('entity', 'internal_notes')
                             ->where('entity_id', $note->id)
                             ->with('user')
                             ->orderBy('created_at', 'desc')
                             ->get();

        return view('notes.show', compact('note', 'auditLogs'));
    }

    public function edit(InternalNote $note)
    {
        $this->authorize('update', $note);
        $boxes = Box::orderBy('box_number')->get();
        return view('notes.edit', compact('note', 'boxes'));
    }

    public function update(Request $request, InternalNote $note)
    {
        $this->authorize('update', $note);

        $validated = $request->validate([
            'box_id'          => 'required|exists:boxes,id',
            'internal_number' => 'required|string|max:60',
            'note_date'       => 'required|date',
            'remitente'       => 'required|string|max:200',
            'destinatario'    => 'required|string|max:200',
            'via'             => 'required|string|max:100',
            'reference'       => 'required|string|max:1000',
            'doc_type'        => 'required|in:ORIGINAL,FOTOCOPIA,AMBOS,FOTOGRAFÍA',
            'note_type'       => 'required|in:NOTA INTERNA,NOTA EXTERNA,INFORME,EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO',
            'pages'           => 'required|integer|min:1',
            'observations'    => 'nullable|string|max:2000',
            'attachments'     => 'nullable|array',
            'attachments.*'   => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
        ], [
            'remitente.required'    => 'El remitente es obligatorio.',
            'destinatario.required' => 'El destinatario es obligatorio.',
            'via.required'          => 'La vía de envío es obligatoria.',
        ]);

        $old = $note->toArray();

        $note->update([
            'box_id'          => $validated['box_id'],
            'internal_number' => $validated['internal_number'],
            'note_date'       => $validated['note_date'],
            'remitente'       => $validated['remitente'],
            'destinatario'    => $validated['destinatario'],
            'via'             => $validated['via'],
            'reference'       => $validated['reference'],
            'doc_type'        => $validated['doc_type'],
            'note_type'       => $validated['note_type'],
            'pages'           => $validated['pages'],
            'observations'    => $validated['observations'] ?? null,
        ]);

        // Nuevos adjuntos
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments/' . $note->id, 'public');
                NoteAttachment::create([
                    'internal_note_id' => $note->id,
                    'original_name'    => $file->getClientOriginalName(),
                    'file_path'        => $path,
                    'mime_type'        => $file->getMimeType(),
                    'file_size'        => $file->getSize(),
                    'uploaded_by'      => $request->user()->id,
                ]);
            }
        }

        AuditLog::record('EDITAR', 'internal_notes', $note->id, $old, $note->fresh()->toArray());

        return redirect()->route('notes.show', $note)
                         ->with('success', 'Documento actualizado exitosamente.');
    }

    public function destroy(InternalNote $note)
    {
        $this->authorize('delete', $note);

        $old = $note->toArray();

        // Eliminar archivos físicos
        foreach ($note->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->file_path);
        }

        $note->delete();

        AuditLog::record('ELIMINAR', 'internal_notes', $note->id, $old, null);

        return redirect()->route('notes.index')
                         ->with('success', 'Documento eliminado exitosamente.');
    }

    /**
     * Enviar nota para revisión (BORRADOR → ENVIADO)
     */
    public function send(InternalNote $note)
    {
        $this->authorize('send', $note);

        $old = ['status' => $note->status];
        $note->update(['status' => 'ENVIADO']);

        AuditLog::record('ENVIAR', 'internal_notes', $note->id, $old, ['status' => 'ENVIADO']);

        return redirect()->route('notes.show', $note)
                         ->with('success', 'Documento enviado para revisión.');
    }

    /**
     * Eliminar adjunto individual
     */
    public function deleteAttachment(NoteAttachment $attachment)
    {
        $note = $attachment->internalNote;
        $this->authorize('update', $note);

        Storage::disk('public')->delete($attachment->file_path);
        $old = $attachment->toArray();
        $attachment->delete();

        AuditLog::record('ELIMINAR_ADJUNTO', 'note_attachments', $attachment->id, $old, null);

        return back()->with('success', 'Adjunto eliminado.');
    }
}
