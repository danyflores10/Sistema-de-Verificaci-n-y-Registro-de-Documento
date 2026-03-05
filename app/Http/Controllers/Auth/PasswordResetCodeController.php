<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class PasswordResetCodeController extends Controller
{
    /**
     * Mostrar formulario para ingresar email
     */
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Enviar código de verificación al email
     */
    public function sendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'email.exists' => 'No encontramos una cuenta con ese correo electrónico.',
        ]);

        // Eliminar códigos previos para este email
        DB::table('password_reset_codes')->where('email', $request->email)->delete();

        // Generar código de 6 dígitos
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Guardar en BD
        DB::table('password_reset_codes')->insert([
            'email'      => $request->email,
            'code'       => $code,
            'expires_at' => now()->addMinutes(5),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Enviar email
        Mail::to($request->email)->send(new PasswordResetCodeMail($code));

        return redirect()->route('password.verify.form', ['email' => $request->email])
                         ->with('status', 'Hemos enviado un código de verificación a su correo electrónico.');
    }

    /**
     * Mostrar formulario para ingresar código
     */
    public function showVerifyForm(Request $request)
    {
        return view('auth.verify-code', ['email' => $request->query('email')]);
    }

    /**
     * Verificar el código ingresado
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code'  => 'required|string|size:6',
        ], [
            'code.required' => 'El código de verificación es obligatorio.',
            'code.size'     => 'El código debe ser de 6 dígitos.',
        ]);

        $record = DB::table('password_reset_codes')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();

        if (! $record) {
            return back()->withErrors(['code' => 'El código es inválido o ha expirado. Solicite uno nuevo.'])->withInput();
        }

        // Código válido → redirigir a formulario de nueva contraseña con token temporal
        $token = encrypt($request->email . '|' . $request->code . '|' . now()->timestamp);

        return redirect()->route('password.reset.form', ['token' => $token]);
    }

    /**
     * Mostrar formulario para nueva contraseña
     */
    public function showResetForm(Request $request)
    {
        try {
            $data = decrypt($request->query('token'));
            $parts = explode('|', $data);
            $email = $parts[0];
        } catch (\Exception $e) {
            return redirect()->route('password.request')->withErrors(['email' => 'Token inválido. Solicite un nuevo código.']);
        }

        return view('auth.reset-password', [
            'token' => $request->query('token'),
            'email' => $email,
        ]);
    }

    /**
     * Restablecer la contraseña
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required'  => 'La contraseña es obligatoria.',
            'password.min'       => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        try {
            $data = decrypt($request->token);
            $parts = explode('|', $data);
            $email = $parts[0];
            $code  = $parts[1];
        } catch (\Exception $e) {
            return redirect()->route('password.request')->withErrors(['email' => 'Token inválido.']);
        }

        // Verificar que el código aún existe
        $record = DB::table('password_reset_codes')
            ->where('email', $email)
            ->where('code', $code)
            ->first();

        if (! $record) {
            return redirect()->route('password.request')->withErrors(['email' => 'El código ya fue utilizado o expiró.']);
        }

        // Actualizar contraseña
        $user = User::where('email', $email)->first();

        if (! $user) {
            return redirect()->route('password.request')->withErrors(['email' => 'Usuario no encontrado.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Eliminar código usado
        DB::table('password_reset_codes')->where('email', $email)->delete();

        return redirect()->route('login')->with('status', '¡Contraseña restablecida exitosamente! Inicie sesión con su nueva contraseña.');
    }
}
