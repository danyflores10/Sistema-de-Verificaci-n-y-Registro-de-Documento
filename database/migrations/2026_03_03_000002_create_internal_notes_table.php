<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internal_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('box_id')->constrained('boxes')->cascadeOnDelete();
            $table->string('internal_number', 60);
            $table->date('note_date');
            $table->text('reference');
            $table->enum('doc_type', ['ORIGINAL', 'FOTOCOPIA', 'AMBOS']);
            $table->unsignedInteger('pages');
            $table->text('observations')->nullable();
            $table->enum('status', ['BORRADOR', 'ENVIADO', 'VERIFICADO', 'RECHAZADO'])->default('BORRADOR');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->index('box_id');
            $table->index('status');
            $table->index('note_date');
            $table->index('internal_number');
            $table->index('created_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internal_notes');
    }
};
