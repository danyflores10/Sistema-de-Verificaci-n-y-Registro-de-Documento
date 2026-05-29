<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            // Verificador al que se envía la nota para su revisión.
            $table->foreignId('assigned_to')
                  ->nullable()
                  ->after('created_by')
                  ->constrained('users')
                  ->nullOnDelete();

            $table->index('assigned_to');
        });
    }

    public function down(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('assigned_to');
        });
    }
};
