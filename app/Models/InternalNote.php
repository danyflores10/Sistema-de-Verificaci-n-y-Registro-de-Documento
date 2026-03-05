<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InternalNote extends Model
{
    protected $fillable = [
        'box_id',
        'internal_number',
        'note_date',
        'reference',
        'doc_type',
        'note_type',
        'pages',
        'observations',
        'status',
        'rejection_reason',
        'created_by',
        'verified_by',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'note_date'   => 'date',
            'verified_at' => 'datetime',
            'pages'       => 'integer',
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

    public function attachments(): HasMany
    {
        return $this->hasMany(NoteAttachment::class, 'internal_note_id');
    }
}
