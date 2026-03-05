<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternalNoteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Redirigir raíz al dashboard
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| Rutas autenticadas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'active'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ========================================
    // CAJAS - todos ven, solo admin CRUD
    // ========================================
    Route::resource('boxes', BoxController::class)->except(['show']);

    // ========================================
    // NOTAS INTERNAS
    // ========================================
    Route::resource('notes', InternalNoteController::class);
    Route::post('/notes/{note}/send', [InternalNoteController::class, 'send'])->name('notes.send');
    Route::delete('/attachments/{attachment}', [InternalNoteController::class, 'deleteAttachment'])->name('attachments.destroy');

    // ========================================
    // REPORTES Y EXPORTACIÓN
    // ========================================
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');
    Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');

    // ========================================
    // SOLO ADMIN
    // ========================================
    Route::middleware('role:SUPER_ADMIN,ADMIN')->group(function () {

        // Gestión de usuarios
        Route::resource('users', UserController::class)->except(['show', 'destroy']);
        Route::post('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
        Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');

        // Verificación / Revisión
        Route::get('/verification', [VerificationController::class, 'index'])->name('verification.index');
        Route::post('/verification/{note}/verify', [VerificationController::class, 'verify'])->name('verification.verify');
        Route::post('/verification/{note}/reject', [VerificationController::class, 'reject'])->name('verification.reject');

        // Auditoría
        Route::get('/audit', [AuditLogController::class, 'index'])->name('audit.index');

        // Permisos de acceso (módulos del menú)
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::put('/permissions/{user}/modules', [PermissionController::class, 'updateModules'])->name('permissions.update-modules');

        // Pulse Monitor (embebido)
        Route::get('/admin/pulse', function () {
            return view('admin.pulse');
        })->name('admin.pulse');

        // Log Viewer (embebido)
        Route::get('/admin/log-viewer', function () {
            return view('admin.log-viewer');
        })->name('admin.log-viewer');
    });
});

require __DIR__.'/auth.php';

