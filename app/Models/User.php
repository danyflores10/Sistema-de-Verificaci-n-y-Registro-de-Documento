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

    /* ---- Roles del sistema ---- */

    public const ROLE_ADMIN        = 'ADMIN';
    public const ROLE_VERIFICADOR  = 'VERIFICADOR';   // antes "USUARIO": gestión documental
    public const ROLE_OPERADOR     = 'OPERADOR';      // revisa / aprueba documentos
    public const ROLE_VISUALIZADOR = 'VISUALIZADOR';

    /**
     * Roles que un administrador puede asignar desde la gestión de usuarios,
     * con su etiqueta legible. (SUPER_ADMIN es heredado y no se asigna.)
     */
    public const ASSIGNABLE_ROLES = [
        self::ROLE_VERIFICADOR  => 'Verificador',
        self::ROLE_OPERADOR     => 'Operador',
        self::ROLE_ADMIN        => 'Administrador',
        self::ROLE_VISUALIZADOR => 'Visualizador (solo lectura)',
    ];

    /**
     * Menú del rol VERIFICADOR: gestión documental (cajas, documentos e
     * importación) más reportes. Registra y envía documentos para su revisión.
     */
    public const VERIFICADOR_MODULES = [
        'dashboard',
        'boxes',
        'notes',
        'import',
        'reports',
    ];

    /**
     * Menú del rol OPERADOR: revisión y aprobación de documentos enviados
     * (Verificación y Aprobaciones) más reportes.
     */
    public const OPERADOR_MODULES = [
        'dashboard',
        'verification',
        'reports',
    ];

    /**
     * Módulos del menú que un Visualizador puede llegar a ver. Es un rol de
     * SOLO LECTURA, por lo que nunca accede a módulos de escritura o
     * administración (usuarios, permisos, importar, verificación, etc.).
     */
    public const VISUALIZADOR_MODULES = [
        'dashboard',
        'boxes',
        'notes',
        'reports',
    ];

    /**
     * Conjunto de módulos por defecto de un rol acotado, o null si el rol no
     * tiene límite de menú (ADMIN / SUPER_ADMIN ven todo). Sirve tanto para
     * fijar el menú del rol como para inicializar sus permisos.
     */
    public static function defaultModulesForRole(string $role): ?array
    {
        return match ($role) {
            self::ROLE_VERIFICADOR  => self::VERIFICADOR_MODULES,
            self::ROLE_OPERADOR     => self::OPERADOR_MODULES,
            self::ROLE_VISUALIZADOR => self::VISUALIZADOR_MODULES,
            default                 => null,
        };
    }

    /* ---- Helpers de módulos ---- */

    /**
     * Obtener los módulos permitidos del usuario.
     * Si es null (nunca configurado), tiene acceso a todo.
     */
    public function getAllowedModules(): array
    {
        $availableModules = array_keys(self::ALL_MODULES);

        // Los roles acotados (Verificador, Operador, Visualizador) nunca ven
        // módulos fuera del conjunto definido para su rol, pase lo que pase con
        // sus permisos individuales. ADMIN / SUPER_ADMIN no tienen límite.
        if ($cap = self::defaultModulesForRole($this->role)) {
            $availableModules = array_values(array_intersect($availableModules, $cap));
        }

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

    public function isVerificador(): bool
    {
        return $this->role === self::ROLE_VERIFICADOR;
    }

    public function isOperador(): bool
    {
        return $this->role === self::ROLE_OPERADOR;
    }

    public function isVisualizador(): bool
    {
        return $this->role === self::ROLE_VISUALIZADOR;
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
