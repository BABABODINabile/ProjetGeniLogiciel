<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('espaces', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('matiere_id')->constrained('matieres')->onDelete('cascade');
            $table->foreignId('promotion_id')->nullable()->constrained('promotions')->onDelete('cascade');
            $table->foreignId('formateur_id')->nullable()->constrained('formateurs')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['matiere_id', 'promotion_id', 'formateur_id'], 'unique_cours_index');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espaces');
    }
};
