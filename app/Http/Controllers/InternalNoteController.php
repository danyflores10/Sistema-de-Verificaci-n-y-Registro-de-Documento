<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Box;
use App\Models\InternalNote;
use App\Models\NoteAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class InternalNoteController extends Controller
{
    /**
     * Tipos MIME aceptados para los adjuntos (PDF, Word, ZIP y RAR).
     *
     * Se incluyen variantes reportadas por distintos navegadores/sistemas
     * operativos (incluido application/octet-stream, que es lo que devuelven
     * muchos clientes para .rar y .zip) para evitar rechazos falsos.
     * La validación de extensión (`extensions:`) ya restringe el tipo real.
     */
    private const ATTACHMENT_MIME_TYPES = 'application/pdf,'
        . 'application/msword,application/vnd.ms-office,application/x-ole-storage,application/CDFV2,'
        . 'application/vnd.openxmlformats-officedocument.wordprocessingml.document,'
        . 'application/zip,application/x-zip-compressed,application/x-zip,multipart/x-zip,'
        . 'application/x-rar-compressed,application/vnd.rar,application/x-rar,application/x-compressed,'
        . 'application/octet-stream';

    public function index(Request $request)
    {
        $user  = $request->user();
        $query = InternalNote::with(['box', 'creator', 'verifier', 'attachments']);

        // El VERIFICADOR solo ve sus propios registros
        if ($user->isVerificador()) {
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
        if ($folderNumber = $request->get('folder_number')) {
            $query->where('folder_number', 'like', "%{$folderNumber}%");
        }
        if ($reference = $request->get('reference')) {
            $query->whereRaw('LOWER(reference) LIKE ?', ['%' . mb_strtolower($reference, 'UTF-8') . '%']);
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

        // IDs de TODOS los documentos enviables (BORRADOR) que coinciden con los
        // filtros actuales, en todas las páginas. Permite "seleccionar todos" a
        // través de la paginación. La consulta ya está acotada al propietario si
        // el usuario es VERIFICADOR, y solo los BORRADOR son enviables.
        $sendableNoteIds = (clone $query)
            ->where('status', InternalNote::STATUS_BORRADOR)
            ->pluck('id')
            ->values();

        $notes = $query->latest('note_date')->paginate(15)->withQueryString();
        $this->hydrateEffectiveAttachments($notes->getCollection());
        $boxes = Box::orderBy('box_number')->get();
        $users = \App\Models\User::where('is_active', true)
                                 ->orderBy('name')
                                 ->get(['id', 'name', 'role']);

        // Verificadores disponibles para el envío masivo (usuarios activos
        // con el módulo de verificación habilitado).
        $verifiers = \App\Models\User::where('is_active', true)
                                     ->orderBy('name')
                                     ->get(['id', 'name', 'role', 'allowed_modules'])
                                     ->filter(fn ($u) => $u->hasModule('verification'))
                                     ->values();

        return view('notes.index', compact('notes', 'boxes', 'users', 'verifiers', 'sendableNoteIds'));
    }

    public function create()
    {
        $this->authorize('create', InternalNote::class);
        $boxes = Box::orderBy('box_number')->get();
        $users = \App\Models\User::where('is_active', true)->orderBy('name')->get(['id', 'name', 'role']);
        return view('notes.create', compact('boxes', 'users'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', InternalNote::class);

        $validated = $request->validate([
            'box_id'              => 'required|exists:boxes,id',
            'folder_number'       => 'nullable|string|max:60',
            'internal_number'     => 'required|string|max:60',
            'note_date'           => 'required|date',
            'remitente'           => 'required|string|max:200',
            'destinatario'        => 'required|string|max:200',
            'via'                 => 'nullable|string|max:100',
            'reference'           => 'required|string|max:1000',
            'doc_type'            => 'required|in:ORIGINAL,FOTOCOPIA,AMBOS,FOTOGRAFÍA',
            'note_type'           => 'required|in:NOTA INTERNA,NOTA EXTERNA,INFORME,EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO',
            'tipologia'           => 'nullable|string|max:150',
            'estado_conservacion' => 'nullable|string|max:100',
            'pages'               => 'required|string|max:50',
            'observations'        => 'nullable|string|max:2000',
            'attachments'         => 'nullable|array|max:10',
            'attachments.*'       => ['file', 'extensions:pdf,doc,docx,zip,rar', 'mimetypes:' . self::ATTACHMENT_MIME_TYPES, 'max:5120000'],
        ], [
            'box_id.required'          => 'La caja es obligatoria.',
            'internal_number.required' => 'El CITE es obligatorio.',
            'note_date.required'       => 'La fecha es obligatoria.',
            'remitente.required'       => 'El remitente es obligatorio.',
            'destinatario.required'    => 'El destinatario es obligatorio.',
            'reference.required'       => 'La referencia es obligatoria.',
            'doc_type.required'        => 'El estado del documento es obligatorio.',
            'doc_type.in'              => 'El estado debe ser ORIGINAL, FOTOCOPIA, AMBOS o FOTOGRAFÍA.',
            'note_type.required'       => 'La nota interno es obligatoria.',
            'note_type.in'             => 'Seleccione un tipo de nota válido.',
            'pages.required'           => 'Las fojas son obligatorias.',
            'attachments.array'        => 'La lista de adjuntos no tiene un formato válido.',
            'attachments.max'          => 'Solo puede subir un máximo de 10 archivos.',
            'attachments.*.file'       => 'Uno de los adjuntos no es un archivo válido.',
            'attachments.*.extensions' => 'Solo se permiten archivos PDF, Word (DOC/DOCX), ZIP o RAR.',
            'attachments.*.mimetypes'  => 'Solo se permiten archivos PDF, Word (DOC/DOCX), ZIP o RAR.',
            'attachments.*.max'        => 'Cada archivo no debe superar 5000 MB.',
        ]);

        $note = InternalNote::create([
            'box_id'              => $validated['box_id'],
            'folder_number'       => $validated['folder_number'] ?? null,
            'internal_number'     => $validated['internal_number'],
            'note_date'           => $validated['note_date'],
            'remitente'           => $validated['remitente'],
            'destinatario'        => $validated['destinatario'],
            'via'                 => $validated['via'],
            'reference'           => $validated['reference'],
            'doc_type'            => $validated['doc_type'],
            'note_type'           => $validated['note_type'],
            'tipologia'           => $validated['tipologia'] ?? null,
            'estado_conservacion' => $validated['estado_conservacion'] ?? null,
            'pages'               => $validated['pages'],
            'observations'        => $validated['observations'] ?? null,
            'status'              => 'BORRADOR',
            'created_by'          => $request->user()->id,
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
        $this->hydrateEffectiveAttachments(collect([$note]), true);

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
        $users = \App\Models\User::where('is_active', true)->orderBy('name')->get(['id', 'name', 'role']);
        return view('notes.edit', compact('note', 'boxes', 'users'));
    }

    public function update(Request $request, InternalNote $note)
    {
        $this->authorize('update', $note);

        $validated = $request->validate([
            'box_id'              => 'required|exists:boxes,id',
            'folder_number'       => 'nullable|string|max:60',
            'internal_number'     => 'required|string|max:60',
            'note_date'           => 'required|date',
            'remitente'           => 'required|string|max:200',
            'destinatario'        => 'required|string|max:200',
            'via'                 => 'nullable|string|max:100',
            'reference'           => 'required|string|max:1000',
            'doc_type'            => 'required|in:ORIGINAL,FOTOCOPIA,AMBOS,FOTOGRAFÍA',
            'note_type'           => 'required|in:NOTA INTERNA,NOTA EXTERNA,INFORME,EVALUACIONES Y/O NOTAS DE LA CONTRALORIA GENERAL DEL ESTADO',
            'tipologia'           => 'nullable|string|max:150',
            'estado_conservacion' => 'nullable|string|max:100',
            'pages'               => 'required|string|max:50',
            'observations'        => 'nullable|string|max:2000',
            'attachments'         => 'nullable|array|max:10',
            'attachments.*'       => ['file', 'extensions:pdf,doc,docx,zip,rar', 'mimetypes:' . self::ATTACHMENT_MIME_TYPES, 'max:5120000'],
            'remove_attachment_ids'   => 'nullable|array',
            'remove_attachment_ids.*' => 'integer',
        ], [
            'remitente.required'    => 'El remitente es obligatorio.',
            'destinatario.required' => 'El destinatario es obligatorio.',
            'pages.required'        => 'Las fojas son obligatorias.',
            'attachments.array'     => 'La lista de adjuntos no tiene un formato válido.',
            'attachments.max'       => 'Solo puede subir un máximo de 10 archivos.',
            'attachments.*.file'    => 'Uno de los adjuntos no es un archivo válido.',
            'attachments.*.extensions' => 'Solo se permiten archivos PDF, Word (DOC/DOCX), ZIP o RAR.',
            'attachments.*.mimetypes'  => 'Solo se permiten archivos PDF, Word (DOC/DOCX), ZIP o RAR.',
            'attachments.*.max'     => 'Cada archivo no debe superar 5000 MB.',
            'remove_attachment_ids.array'     => 'La lista de adjuntos a eliminar no tiene un formato válido.',
            'remove_attachment_ids.*.integer' => 'Uno de los adjuntos a eliminar no es válido.',
        ]);

        $old = $note->toArray();

        $note->update([
            'box_id'              => $validated['box_id'],
            'folder_number'       => $validated['folder_number'] ?? null,
            'internal_number'     => $validated['internal_number'],
            'note_date'           => $validated['note_date'],
            'remitente'           => $validated['remitente'],
            'destinatario'        => $validated['destinatario'],
            'via'                 => $validated['via'],
            'reference'           => $validated['reference'],
            'doc_type'            => $validated['doc_type'],
            'note_type'           => $validated['note_type'],
            'tipologia'           => $validated['tipologia'] ?? null,
            'estado_conservacion' => $validated['estado_conservacion'] ?? null,
            'pages'               => $validated['pages'],
            'observations'        => $validated['observations'] ?? null,
        ]);

        $removeAttachmentIds = collect($validated['remove_attachment_ids'] ?? [])
            ->map(static fn ($id) => (int) $id)
            ->filter(static fn ($id) => $id > 0)
            ->unique()
            ->values();

        if ($removeAttachmentIds->isNotEmpty()) {
            $attachmentsToDelete = $note->attachments()
                ->whereIn('id', $removeAttachmentIds)
                ->get();

            foreach ($attachmentsToDelete as $attachment) {
                Storage::disk('public')->delete($attachment->file_path);
                $attachmentOld = $attachment->toArray();
                $attachmentId  = $attachment->id;
                $attachment->delete();

                AuditLog::record('ELIMINAR_ADJUNTO', 'note_attachments', $attachmentId, $attachmentOld, null);
            }
        }

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
     * Envío masivo de documentos a un verificador (BORRADOR → ENVIADO).
     * Recibe una lista de IDs seleccionados y el verificador destinatario.
     */
    public function bulkSend(Request $request)
    {
        $validated = $request->validate([
            'note_ids'    => 'required|array|min:1',
            'note_ids.*'  => 'integer|exists:internal_notes,id',
            'assigned_to' => 'required|integer|exists:users,id',
        ], [
            'note_ids.required'    => 'Debe seleccionar al menos un documento.',
            'note_ids.array'       => 'La selección de documentos no es válida.',
            'note_ids.min'         => 'Debe seleccionar al menos un documento.',
            'note_ids.*.exists'    => 'Uno de los documentos seleccionados no existe.',
            'assigned_to.required' => 'Debe seleccionar a quién enviar para verificación.',
            'assigned_to.exists'   => 'El verificador seleccionado no es válido.',
        ]);

        // El destinatario debe ser un usuario activo con módulo de verificación.
        $assignee = \App\Models\User::where('is_active', true)->find($validated['assigned_to']);

        if (! $assignee || ! $assignee->hasModule('verification')) {
            return back()->with('error', 'El usuario seleccionado no puede verificar documentos.');
        }

        $notes = InternalNote::whereIn('id', $validated['note_ids'])->get();

        $sent    = 0;
        $skipped = 0;

        foreach ($notes as $note) {
            // Solo se envían los BORRADOR sobre los que el usuario tiene permiso.
            if (! $note->isBorrador() || $request->user()->cannot('send', $note)) {
                $skipped++;
                continue;
            }

            $old = ['status' => $note->status, 'assigned_to' => $note->assigned_to];

            $note->update([
                'status'      => InternalNote::STATUS_ENVIADO,
                'assigned_to' => $assignee->id,
            ]);

            AuditLog::record('ENVIAR', 'internal_notes', $note->id, $old, [
                'status'      => InternalNote::STATUS_ENVIADO,
                'assigned_to' => $assignee->id,
            ]);

            $sent++;
        }

        if ($sent === 0) {
            return back()->with('error', 'No se envió ningún documento. Solo se pueden enviar documentos en estado BORRADOR.');
        }

        $message = "Se enviaron {$sent} documento(s) a {$assignee->name} para verificación.";
        if ($skipped > 0) {
            $message .= " {$skipped} omitido(s) por no estar en estado BORRADOR.";
        }

        return back()->with('success', $message);
    }

    /**
     * Eliminar adjunto individual
     */
    public function deleteAttachment(Request $request, NoteAttachment $attachment)
    {
        $note = $attachment->internalNote;
        $this->authorize('update', $note);

        Storage::disk('public')->delete($attachment->file_path);
        $old = $attachment->toArray();
        $attachment->delete();

        AuditLog::record('ELIMINAR_ADJUNTO', 'note_attachments', $attachment->id, $old, null);

        if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
            return response()->json([
                'ok'      => true,
                'message' => 'Adjunto eliminado.',
                'id'      => $old['id'] ?? null,
            ]);
        }

        return back()->with('success', 'Adjunto eliminado.');
    }

    /**
     * Expone PDFs de la misma caja solo a nivel visual cuando una nota no
     * tiene PDF propio. No crea ni duplica registros en note_attachments.
     */
    private function hydrateEffectiveAttachments(Collection $notes, bool $loadUploader = false): void
    {
        if ($notes->isEmpty()) {
            return;
        }

        $boxIds = $notes->pluck('box_id')
            ->filter()
            ->unique()
            ->values();

        if ($boxIds->isEmpty()) {
            return;
        }

        $boxPdfAttachments = NoteAttachment::query()
            ->select('note_attachments.*', 'internal_notes.box_id')
            ->join('internal_notes', 'internal_notes.id', '=', 'note_attachments.internal_note_id')
            ->whereIn('internal_notes.box_id', $boxIds)
            ->when($loadUploader, fn ($query) => $query->with('uploader'))
            ->orderBy('note_attachments.id')
            ->get()
            ->filter(fn (NoteAttachment $attachment) => $this->isPdfAttachment($attachment))
            ->groupBy('box_id')
            ->map(fn (Collection $attachments) => $attachments
                ->unique(fn (NoteAttachment $attachment) => mb_strtolower($attachment->file_path . '|' . $attachment->original_name))
                ->values()
            );

        foreach ($notes as $note) {
            $ownAttachments = ($note->attachments ?? collect())
                ->map(function (NoteAttachment $attachment) {
                    $clonedAttachment = clone $attachment;
                    $clonedAttachment->setAttribute('is_inherited_from_box', false);
                    $clonedAttachment->setAttribute('is_primary_from_note', $this->isPdfAttachment($attachment));

                    return $clonedAttachment;
                })
                ->values();

            $existingKeys = $ownAttachments
                ->map(fn (NoteAttachment $attachment) => mb_strtolower($attachment->file_path . '|' . $attachment->original_name))
                ->all();

            $inheritedPdfs = ($boxPdfAttachments->get($note->box_id) ?? collect())
                ->reject(fn (NoteAttachment $attachment) => (int) $attachment->internal_note_id === (int) $note->id)
                ->reject(fn (NoteAttachment $attachment) => in_array(
                    mb_strtolower($attachment->file_path . '|' . $attachment->original_name),
                    $existingKeys,
                    true
                ))
                ->map(function (NoteAttachment $attachment) {
                    $clonedAttachment = clone $attachment;
                    $clonedAttachment->setAttribute('is_inherited_from_box', true);
                    $clonedAttachment->setAttribute('is_primary_from_note', false);

                    return $clonedAttachment;
                })
                ->values();

            $effectiveAttachments = $ownAttachments->concat($inheritedPdfs)->values();
            $hasInheritedBoxPdfs = $inheritedPdfs->isNotEmpty();

            $note->setRelation('effectiveAttachments', $effectiveAttachments);
            $note->setAttribute('has_inherited_box_pdfs', $hasInheritedBoxPdfs);
        }
    }

    private function isPdfAttachment(NoteAttachment $attachment): bool
    {
        $extension = strtolower(pathinfo($attachment->original_name ?? '', PATHINFO_EXTENSION));

        if ($extension === 'pdf') {
            return true;
        }

        return str_contains(strtolower((string) $attachment->mime_type), 'pdf');
    }
}
