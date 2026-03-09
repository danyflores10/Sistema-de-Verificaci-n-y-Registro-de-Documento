<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            $table->string('folder_number', 60)->nullable()->after('box_id');
        });
    }

    public function down(): void
    {
        Schema::table('internal_notes', function (Blueprint $table) {
            $table->dropColumn('folder_number');
        });
    }
};
