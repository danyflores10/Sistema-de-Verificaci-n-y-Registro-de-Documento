<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Renombra el rol USUARIO -> VERIFICADOR y habilita el rol OPERADOR.
     *
     * - En PostgreSQL el "enum" de Laravel es un CHECK constraint, por lo que se
     *   reemplaza para admitir los nuevos valores. En MySQL se redefine el ENUM
     *   (usando un superconjunto temporal para poder renombrar el dato). En
     *   SQLite no hay restricción que actualizar.
     * - Los usuarios renombrados quedan con el menú por defecto del rol
     *   Verificador para que vean exactamente los módulos de su rol.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            $this->dropRoleCheckConstraintPgsql();
            DB::table('users')->where('role', 'USUARIO')->update(['role' => 'VERIFICADOR']);
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role::text = ANY (ARRAY['SUPER_ADMIN', 'ADMIN', 'VERIFICADOR', 'OPERADOR', 'VISUALIZADOR']::text[]))");
            DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'VERIFICADOR'");
        } elseif (in_array($driver, ['mysql', 'mariadb'], true)) {
            // Superconjunto temporal: permite renombrar sin violar el ENUM.
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('SUPER_ADMIN', 'ADMIN', 'USUARIO', 'VERIFICADOR', 'OPERADOR', 'VISUALIZADOR') NOT NULL DEFAULT 'VERIFICADOR'");
            DB::table('users')->where('role', 'USUARIO')->update(['role' => 'VERIFICADOR']);
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('SUPER_ADMIN', 'ADMIN', 'VERIFICADOR', 'OPERADOR', 'VISUALIZADOR') NOT NULL DEFAULT 'VERIFICADOR'");
        } else {
            DB::table('users')->where('role', 'USUARIO')->update(['role' => 'VERIFICADOR']);
        }

        // Fijar el menú de los verificadores al conjunto por defecto del rol.
        DB::table('users')
            ->where('role', 'VERIFICADOR')
            ->update(['allowed_modules' => json_encode(User::VERIFICADOR_MODULES)]);
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            $this->dropRoleCheckConstraintPgsql();
            // OPERADOR no existía antes: se reasigna a USUARIO.
            DB::table('users')->whereIn('role', ['VERIFICADOR', 'OPERADOR'])->update(['role' => 'USUARIO']);
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role::text = ANY (ARRAY['SUPER_ADMIN', 'ADMIN', 'USUARIO', 'VISUALIZADOR']::text[]))");
            DB::statement("ALTER TABLE users ALTER COLUMN role SET DEFAULT 'USUARIO'");
        } elseif (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('SUPER_ADMIN', 'ADMIN', 'USUARIO', 'VERIFICADOR', 'OPERADOR', 'VISUALIZADOR') NOT NULL DEFAULT 'USUARIO'");
            DB::table('users')->whereIn('role', ['VERIFICADOR', 'OPERADOR'])->update(['role' => 'USUARIO']);
            DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('SUPER_ADMIN', 'ADMIN', 'USUARIO', 'VISUALIZADOR') NOT NULL DEFAULT 'USUARIO'");
        } else {
            DB::table('users')->whereIn('role', ['VERIFICADOR', 'OPERADOR'])->update(['role' => 'USUARIO']);
        }
    }

    /**
     * Elimina cualquier CHECK constraint existente sobre la columna `role`
     * sin depender del nombre exacto generado por Laravel.
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
