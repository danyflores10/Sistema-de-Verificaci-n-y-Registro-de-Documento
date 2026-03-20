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
        // Aumentar límites de upload para soportar hasta 500MB
        @ini_set('upload_max_filesize', '512M');
        @ini_set('post_max_size', '520M');
        @ini_set('max_execution_time', '300');
        @ini_set('max_input_time', '300');

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
