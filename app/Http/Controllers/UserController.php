<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($role = $request->get('role')) {
            $query->where('role', $role);
        }

        $users = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:150',
            'email'    => 'required|email|max:150|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'role'     => 'required|in:SUPER_ADMIN,ADMIN,USUARIO',
        ], [
            'name.required'  => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique'   => 'Este correo ya está registrado.',
        ]);

        $user = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role'      => $validated['role'],
            'is_active' => true,
        ]);

        AuditLog::record('CREAR_USUARIO', 'users', $user->id, null, [
            'name' => $user->name, 'email' => $user->email, 'role' => $user->role,
        ]);

        return redirect()->route('users.index')
                         ->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users,email,' . $user->id,
            'role'  => 'required|in:SUPER_ADMIN,ADMIN,USUARIO',
        ]);

        $old = $user->only(['name', 'email', 'role']);
        $user->update($validated);

        AuditLog::record('EDITAR_USUARIO', 'users', $user->id, $old, $user->fresh()->only(['name', 'email', 'role']));

        return redirect()->route('users.index')
                         ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function toggleActive(User $user)
    {
        $old = ['is_active' => $user->is_active];
        $user->update(['is_active' => !$user->is_active]);

        $action = $user->is_active ? 'ACTIVAR_USUARIO' : 'DESACTIVAR_USUARIO';
        AuditLog::record($action, 'users', $user->id, $old, ['is_active' => $user->is_active]);

        $msg = $user->is_active ? 'Usuario activado.' : 'Usuario desactivado.';
        return redirect()->route('users.index')->with('success', $msg);
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->update(['password' => Hash::make($request->password)]);

        AuditLog::record('RESETEAR_PASSWORD', 'users', $user->id, null, null);

        return redirect()->route('users.index')
                         ->with('success', 'Contraseña reseteada exitosamente.');
    }
}
