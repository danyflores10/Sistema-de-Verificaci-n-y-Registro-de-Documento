<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Añade el rol VISUALIZADOR (solo lectura) a la columna `role`.
     *
     * En PostgreSQL el enum de Laravel se implementa como un CHECK constraint,
     * por lo que hay que reemplazarlo para admitir el nuevo valor. En MySQL se
     * redefine el ENUM. En SQLite no hay restricción que actualizar.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            $this->dropRoleCheckConstraintPgsql();
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role::text = ANY (ARRAY['SUPER_ADMIN', 'ADMIN', 'USUARIO', 'VISUALIZADOR']::text[]))");
        } elseif (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('SUPER_ADMIN', 'ADMIN', 'USUARIO', 'VISUALIZADOR') NOT NULL DEFAULT 'USUARIO'");
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        // Reasignar a USUARIO los registros que usen el rol que vamos a quitar,
        // de lo contrario la restricción anterior no podría volver a aplicarse.
        DB::table('users')->where('role', 'VISUALIZADOR')->update(['role' => 'USUARIO']);

        if ($driver === 'pgsql') {
            $this->dropRoleCheckConstraintPgsql();
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role::text = ANY (ARRAY['SUPER_ADMIN', 'ADMIN', 'USUARIO']::text[]))");
        } elseif (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('SUPER_ADMIN', 'ADMIN', 'USUARIO') NOT NULL DEFAULT 'USUARIO'");
        }
    }

    /**
     * Elimina cualquier CHECK constraint existente sobre la columna `role`
     * sin depender del nombre exacto generado por Laravel (por defecto
     * `users_role_check`).
     */
    private function dropRoleCheckConstraintPgsql(): void
    {
        $constraints = DB::select(<<<'SQL'
            SELECT con.conname
            FROM pg_constraint con
            JOIN pg_class rel ON rel.oid = con.conrelid
            WHERE rel.relname = 'users'
              AND con.contype = 'c'
              AND pg_get_constraintdef(con.oid) ILIKE '%role%'
        SQL);

        foreach ($constraints as $constraint) {
            DB::statement('ALTER TABLE users DROP CONSTRAINT ' . $constraint->conname);
        }
    }
};
