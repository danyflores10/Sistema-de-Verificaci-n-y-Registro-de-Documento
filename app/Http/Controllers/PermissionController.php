<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Lista de usuarios con sus módulos asignados.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // ADMIN no puede ver SUPER_ADMIN
        if (!auth()->user()->isSuperAdmin()) {
            $query->where('role', '!=', 'SUPER_ADMIN');
        }

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', "%{$search}%")
                  ->orWhere('email', 'ilike', "%{$search}%");
            });
        }

        if ($role = $request->get('role')) {
            $query->where('role', $role);
        }

        $users = $query->orderBy('name')->paginate(20)->withQueryString();

        return view('permissions.index', compact('users'));
    }

    /**
     * Actualizar los módulos permitidos de un usuario.
     */
    public function updateModules(Request $request, User $user)
    {
        // No puede modificarse a sí mismo
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes modificar tus propios permisos.');
        }

        // ADMIN no puede modificar a SUPER_ADMIN
        if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'No tienes permisos para modificar a un Super Administrador.');
        }

        $validated = $request->validate([
            'modules'   => 'required|array|min:1',
            'modules.*' => 'string|in:' . implode(',', array_keys(User::ALL_MODULES)),
        ], [
            'modules.required' => 'Debes seleccionar al menos un módulo.',
            'modules.min'      => 'Debes seleccionar al menos un módulo.',
        ]);

        // Asegurar que dashboard siempre esté incluido
        $modules = $validated['modules'];
        if (!in_array('dashboard', $modules)) {
            array_unshift($modules, 'dashboard');
        }

        // Eliminar duplicados
        $modules = array_values(array_unique($modules));

        $old = ['allowed_modules' => $user->allowed_modules];
        $user->update(['allowed_modules' => $modules]);

        AuditLog::record('ACTUALIZAR_PERMISOS', 'users', $user->id, $old, ['allowed_modules' => $modules]);

        $count = count($modules);
        return redirect()->route('permissions.index')
                         ->with('success', "Permisos de {$user->name} actualizados ({$count} módulos asignados).");
    }
}
