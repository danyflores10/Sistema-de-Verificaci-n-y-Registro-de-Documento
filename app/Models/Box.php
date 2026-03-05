<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Box extends Model
{
    protected $fillable = [
        'box_number',
        'description',
        'created_by',
    ];

    /* ---- Relaciones ---- */

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function internalNotes(): HasMany
    {
        return $this->hasMany(InternalNote::class, 'box_id');
    }
}
