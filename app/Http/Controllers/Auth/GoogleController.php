<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirigir a Google para autenticación
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback de Google después de autenticación
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'email' => 'Ocurrió un error al autenticar con Google. Intente nuevamente.',
            ]);
        }

        // Buscar usuario por email en la base de datos
        $user = User::where('email', $googleUser->getEmail())->first();

        if (! $user) {
            return redirect()->route('login')->withErrors([
                'email' => 'El correo ' . $googleUser->getEmail() . ' no está registrado en el sistema. Contacte al administrador.',
            ]);
        }

        // Verificar que el usuario esté activo
        if (! $user->is_active) {
            return redirect()->route('login')->withErrors([
                'email' => 'Su cuenta se encuentra desactivada. Contacte al administrador.',
            ]);
        }

        // Guardar google_id si no lo tiene
        if (! $user->google_id) {
            $user->update(['google_id' => $googleUser->getId()]);
        }

        // Iniciar sesión
        Auth::login($user, true);

        return redirect()->intended(route('dashboard'));
    }
}
