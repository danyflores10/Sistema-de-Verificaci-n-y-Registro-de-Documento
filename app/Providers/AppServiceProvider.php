<?php

namespace App\Providers;

use App\Models\Box;
use App\Models\InternalNote;
use App\Models\User;
use App\Policies\BoxPolicy;
use App\Policies\InternalNotePolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Pulse\Facades\Pulse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Habilidades de escritura que el rol Visualizador (solo lectura) nunca
     * puede ejecutar en ninguna parte del sistema.
     */
    private const WRITE_ABILITIES = [
        'create', 'update', 'delete', 'restore', 'forceDelete',
        'send', 'verify', 'reject',
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Timeouts y memoria extendidos para subidas grandes (hasta 5000MB).
        // IMPORTANTE: solo en peticiones web. En consola (php artisan serve,
        // colas, scheduler, tinker) son procesos de larga duración y aplicar
        // set_time_limit(1800) los mataría a los 30 min con
        // "Maximum execution time of 1800 seconds exceeded".
        // NOTA: upload_max_filesize y post_max_size son PHP_INI_PERDIR — solo
        // surten efecto desde .user.ini / .htaccess / php.ini, no aquí.
        if (! $this->app->runningInConsole()) {
            @ini_set('max_execution_time', '1800');
            @ini_set('max_input_time', '1800');
            @ini_set('memory_limit', '5200M');
            @set_time_limit(1800);
        }

        // Registrar Policies
        Gate::policy(Box::class, BoxPolicy::class);
        Gate::policy(InternalNote::class, InternalNotePolicy::class);

        // Candado global de SOLO LECTURA para el rol Visualizador.
        // Cualquier habilidad de escritura (crear, editar, eliminar, enviar,
        // verificar, etc.) se niega automáticamente en TODO el sistema, de modo
        // que los botones (@can) y las acciones (authorize) quedan bloqueados
        // sin tener que tocar cada policy individualmente.
        Gate::before(function (User $user, string $ability) {
            if ($user->isVisualizador() && in_array($ability, self::WRITE_ABILITIES, true)) {
                return false;
            }

            return null; // las policies específicas resuelven el resto
        });

        // Laravel Pulse - Solo ADMIN puede acceder
        Gate::define('viewPulse', function ($user) {
            return $user->isAdmin();
        });

        // Log Viewer - Solo ADMIN puede acceder
        Gate::define('viewLogViewer', function ($user) {
            return $user->isAdmin();
        });

        // Compartir contador de notas pendientes de verificación al sidebar
        View::composer('layouts.navigation', function ($view) {
            $pendingCount = 0;
            if (Auth::check() && Auth::user()->hasModule('verification')) {
                $pendingCount = InternalNote::where('status', 'ENVIADO')->count();
            }
            $view->with('pendingCount', $pendingCount);
        });
    }
}
