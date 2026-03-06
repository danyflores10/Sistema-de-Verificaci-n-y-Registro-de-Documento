<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')
            ->where('role', 'SUPER_ADMIN')
            ->update(['role' => 'ADMIN']);
    }

    public function down(): void
    {
        // No revertible automáticamente
    }
};
