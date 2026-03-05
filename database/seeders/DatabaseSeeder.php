<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\InternalNote;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==============================
        // USUARIO ADMIN INICIAL
        // ==============================
        $superAdmin = User::create([
            'name'      => 'Super Administrador',
            'email'     => 'superadmin@correos.bo',
            'password'  => Hash::make('Super2026*'),
            'role'      => 'SUPER_ADMIN',
            'is_active' => true,
        ]);

        $admin = User::create([
            'name'      => 'Administrador',
            'email'     => 'admin@correos.bo',
            'password'  => Hash::make('Admin2026*'),
            'role'      => 'ADMIN',
            'is_active' => true,
        ]);

        // ==============================
        // USUARIO DE EJEMPLO
        // ==============================
        $usuario = User::create([
            'name'      => 'Juan Pérez',
            'email'     => 'juan.perez@correos.bo',
            'password'  => Hash::make('Usuario2026*'),
            'role'      => 'USUARIO',
            'is_active' => true,
        ]);

        // ==============================
        // CAJAS DE EJEMPLO
        // ==============================
        $caja1 = Box::create([
            'box_number'  => 'CAJA-001',
            'description' => 'Archivo central - Documentos administrativos',
            'created_by'  => $admin->id,
        ]);

        $caja2 = Box::create([
            'box_number'  => 'CAJA-002',
            'description' => 'Archivo central - Correspondencia',
            'created_by'  => $admin->id,
        ]);

        $caja3 = Box::create([
            'box_number'  => 'CAJA-003',
            'description' => 'Archivo histórico',
            'created_by'  => $admin->id,
        ]);

        // ==============================
        // NOTAS INTERNAS DE EJEMPLO
        // ==============================
        InternalNote::create([
            'box_id'          => $caja1->id,
            'internal_number' => 'NI-2026-001',
            'note_date'       => '2026-03-03',
            'reference'       => 'Remisión de documentos administrativos gestión 2025',
            'doc_type'        => 'ORIGINAL',
            'pages'           => 10,
            'observations'    => 'Documentos completos sin observaciones',
            'status'          => 'VERIFICADO',
            'created_by'      => $usuario->id,
            'verified_by'     => $admin->id,
            'verified_at'     => now(),
        ]);

        InternalNote::create([
            'box_id'          => $caja1->id,
            'internal_number' => 'NI-2026-002',
            'note_date'       => '2026-03-03',
            'reference'       => 'Informe de gestión trimestral Q1-2026',
            'doc_type'        => 'FOTOCOPIA',
            'pages'           => 5,
            'observations'    => null,
            'status'          => 'ENVIADO',
            'created_by'      => $usuario->id,
        ]);

        InternalNote::create([
            'box_id'          => $caja2->id,
            'internal_number' => 'NI-2026-003',
            'note_date'       => '2026-03-01',
            'reference'       => 'Correspondencia recibida - Febrero 2026',
            'doc_type'        => 'AMBOS',
            'pages'           => 15,
            'observations'    => 'Incluye originales y fotocopias notariadas',
            'status'          => 'BORRADOR',
            'created_by'      => $usuario->id,
        ]);

        InternalNote::create([
            'box_id'          => $caja2->id,
            'internal_number' => 'NI-2026-004',
            'note_date'       => '2026-02-28',
            'reference'       => 'Resolución administrativa N° 045/2026',
            'doc_type'        => 'ORIGINAL',
            'pages'           => 3,
            'observations'    => null,
            'status'          => 'RECHAZADO',
            'rejection_reason' => 'Falta la firma del director en la última página',
            'created_by'      => $usuario->id,
            'verified_by'     => $admin->id,
            'verified_at'     => now(),
        ]);
    }
}
