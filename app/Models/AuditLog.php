<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'entity',
        'entity_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
            'created_at' => 'datetime',
        ];
    }

    /* ---- Relaciones ---- */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /* ---- Helper para registrar auditoría ---- */

    public static function record(
        string $action,
        string $entity,
        int $entityId,
        ?array $oldValues = null,
        ?array $newValues = null
    ): self {
        return self::create([
            'user_id'    => auth()->id(),
            'action'     => $action,
            'entity'     => $entity,
            'entity_id'  => $entityId,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
        ]);
    }
}
