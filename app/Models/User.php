<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'google_id',
        'allowed_modules',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'allowed_modules' => 'array',
        ];
    }

    /* ---- Constante: todos los módulos disponibles ---- */

    public const ALL_MODULES = [
        'dashboard'    => 'Dashboard',
        'boxes'        => 'Cajas',
        'notes'        => 'Documentos',
        'import'       => 'Importar Excel',
        'reports'      => 'Reportes',
        'verification' => 'Verificación',
        'users'        => 'Usuarios',
        'audit'        => 'Auditoría',
        'permissions'  => 'Permisos',
        'pulse'        => 'Pulse Monitor',
        'log-viewer'   => 'Log Viewer',
    ];

    /* ---- Helpers de módulos ---- */

    /**
     * Obtener los módulos permitidos del usuario.
     * Si es null (nunca configurado), tiene acceso a todo.
     */
    public function getAllowedModules(): array
    {
        $availableModules = array_keys(self::ALL_MODULES);

        if (is_null($this->allowed_modules)) {
            return $availableModules;
        }

        $allowed = is_array($this->allowed_modules) ? $this->allowed_modules : [];
        $filtered = array_values(array_intersect($allowed, $availableModules));

        if (!in_array('dashboard', $filtered, true)) {
            array_unshift($filtered, 'dashboard');
        }

        return array_values(array_unique($filtered));
    }

    /**
     * Verificar si el usuario tiene acceso a un módulo específico.
     */
    public function hasModule(string $module): bool
    {
        if (!array_key_exists($module, self::ALL_MODULES)) {
            return false;
        }

        return in_array($module, $this->getAllowedModules(), true);
    }

    /* ---- Helpers de rol ---- */

    public function isAdmin(): bool
    {
        return $this->role === 'ADMIN';
    }

    public function isUsuario(): bool
    {
        return $this->role === 'USUARIO';
    }

    public function hasRole(string ...$roles): bool
    {
        return in_array($this->role, $roles);
    }

    /* ---- Relaciones ---- */

    public function boxes(): HasMany
    {
        return $this->hasMany(Box::class, 'created_by');
    }

    public function internalNotes(): HasMany
    {
        return $this->hasMany(InternalNote::class, 'created_by');
    }

    public function verifiedNotes(): HasMany
    {
        return $this->hasMany(InternalNote::class, 'verified_by');
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class);
    }
}
