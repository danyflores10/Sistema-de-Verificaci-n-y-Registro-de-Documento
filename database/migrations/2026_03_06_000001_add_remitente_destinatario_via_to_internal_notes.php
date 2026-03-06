<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            $table->string('remitente', 200)->nullable()->after('note_date');
            $table->string('destinatario', 200)->nullable()->after('remitente');
            $table->string('via', 100)->nullable()->after('destinatario');
        });
    }

    public function down(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            $table->dropColumn(['remitente', 'destinatario', 'via']);
        });
    }
};
