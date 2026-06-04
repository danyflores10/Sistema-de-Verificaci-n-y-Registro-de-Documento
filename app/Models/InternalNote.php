<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InternalNote extends Model
{
    protected $fillable = [
        'box_id',
        'folder_number',
        'internal_number',
        'note_date',
        'remitente',
        'destinatario',
        'via',
        'reference',
        'doc_type',
        'note_type',
        'tipologia',
        'estado_conservacion',
        'pages',
        'observations',
        'status',
        'rejection_reason',
        'created_by',
        'assigned_to',
        'verified_by',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'note_date'   => 'date',
            'verified_at' => 'datetime',
            'pages'       => 'string',
        ];
    }

    /* ---- Constantes de estado ---- */

    const STATUS_BORRADOR   = 'BORRADOR';
    const STATUS_ENVIADO    = 'ENVIADO';
    const STATUS_VERIFICADO = 'VERIFICADO';
    const STATUS_RECHAZADO  = 'RECHAZADO';

    /* ---- Helpers ---- */

    public function isBorrador(): bool
    {
        return $this->status === self::STATUS_BORRADOR;
    }

    public function isEnviado(): bool
    {
        return $this->status === self::STATUS_ENVIADO;
    }

    public function isVerificado(): bool
    {
        return $this->status === self::STATUS_VERIFICADO;
    }

    public function isRechazado(): bool
    {
        return $this->status === self::STATUS_RECHAZADO;
    }

    public function canBeEditedBy(User $user): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $this->created_by === $user->id
            && in_array($this->status, [self::STATUS_BORRADOR, self::STATUS_ENVIADO]);
    }

    public function canBeDeletedBy(User $user): bool
    {
        if ($user->isAdmin()) {
            return !$this->isVerificado();
        }
        return $this->created_by === $user->id && $this->isBorrador();
    }

    /* ---- Relaciones ---- */

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(NoteAttachment::class, 'internal_note_id');
    }

    /* ---- Scopes ---- */

    /**
     * Mapa de tipos de filtro de archivo → extensiones que coinciden.
     */
    public const FILE_TYPE_EXTENSIONS = [
        'pdf'  => ['pdf'],
        'zip'  => ['zip'],
        'rar'  => ['rar'],
        'word' => ['doc', 'docx'],
    ];

    /**
     * Filtra las notas según los archivos adjuntos subidos:
     *  - 'con'  → tiene al menos un adjunto
     *  - 'sin'  → no tiene adjuntos
     *  - 'pdf' | 'zip' | 'rar' | 'word' → tiene un adjunto de ese tipo
     *
     * Se compara por la extensión del nombre original con LOWER() porque en
     * PostgreSQL LIKE distingue mayúsculas y el mime_type no es confiable para
     * .zip/.rar (a menudo llega como application/octet-stream).
     */
    public function scopeWithFileType($query, ?string $fileType)
    {
        if (! $fileType) {
            return $query;
        }

        if ($fileType === 'con') {
            return $query->whereHas('attachments');
        }

        if ($fileType === 'sin') {
            return $query->whereDoesntHave('attachments');
        }

        if (isset(self::FILE_TYPE_EXTENSIONS[$fileType])) {
            $extensions = self::FILE_TYPE_EXTENSIONS[$fileType];

            return $query->whereHas('attachments', function ($attachmentQuery) use ($extensions) {
                $attachmentQuery->where(function ($inner) use ($extensions) {
                    foreach ($extensions as $ext) {
                        $inner->orWhereRaw('LOWER(original_name) LIKE ?', ['%.' . $ext]);
                    }
                });
            });
        }

        return $query;
    }
}
