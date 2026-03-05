<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ServerSuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $name = env('INITIAL_SUPERADMIN_NAME', 'Super Administrador');
        $email = env('INITIAL_SUPERADMIN_EMAIL', 'superadmin@correos.bo');
        $password = env('INITIAL_SUPERADMIN_PASSWORD', 'Super2026*');

        $allModules = array_keys(User::ALL_MODULES);

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'role' => 'SUPER_ADMIN',
                'is_active' => true,
                'allowed_modules' => $allModules,
            ]
        );

        $this->command?->info("SUPER_ADMIN listo: {$email}");

        if (!env('INITIAL_SUPERADMIN_PASSWORD')) {
            $this->command?->warn('INITIAL_SUPERADMIN_PASSWORD no está definido; se usó el password por defecto. Cambia la clave inmediatamente.');
        }
    }
}
