<?php

namespace App\Providers;

use App\Models\Box;
use App\Models\InternalNote;
use App\Policies\BoxPolicy;
use App\Policies\InternalNotePolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Pulse\Facades\Pulse;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Timeouts extendidos para subidas grandes (hasta 5000MB).
        // NOTA: upload_max_filesize y post_max_size son PHP_INI_PERDIR — solo
        // surten efecto desde .user.ini / .htaccess / php.ini, no aquí.
        @ini_set('max_execution_time', '1800');
        @ini_set('max_input_time', '1800');
        @ini_set('memory_limit', '5200M');
        @set_time_limit(1800);

        // Registrar Policies
        Gate::policy(Box::class, BoxPolicy::class);
        Gate::policy(InternalNote::class, InternalNotePolicy::class);

        // Gate global: admin puede hacer todo
        Gate::before(function ($user, $ability) {
            // No interceptamos para que las policies específicas manejen la lógica
            return null;
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
