<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cambia el campo 'pages' de unsignedInteger a string.
     * Permite almacenar rangos como "12 - 233" además de números simples.
     */
    public function up(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            $table->string('pages', 50)->change();
        });
    }

    public function down(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            $table->unsignedInteger('pages')->change();
        });
    }
};
