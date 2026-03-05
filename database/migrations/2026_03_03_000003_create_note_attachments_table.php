<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('note_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internal_note_id')->constrained('internal_notes')->cascadeOnDelete();
            $table->string('original_name', 255);
            $table->string('file_path', 500);
            $table->string('mime_type', 100)->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->index('internal_note_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('note_attachments');
    }
};
