<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            if (!Schema::hasColumn('internal_notes', 'tipologia')) {
                $table->string('tipologia', 150)->nullable()->after('note_type');
            }
            if (!Schema::hasColumn('internal_notes', 'estado_conservacion')) {
                $table->string('estado_conservacion', 100)->nullable()->after('tipologia');
            }
        });
    }

    public function down(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('internal_notes', 'tipologia')) {
                $columns[] = 'tipologia';
            }
            if (Schema::hasColumn('internal_notes', 'estado_conservacion')) {
                $columns[] = 'estado_conservacion';
            }
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
