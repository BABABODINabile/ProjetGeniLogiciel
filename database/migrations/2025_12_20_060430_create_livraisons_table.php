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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            
            // Relation avec l'assignation (qui a rendu quoi ?)
            $table->foreignId('assignation_id')->constrained('assignations')->onDelete('cascade');
            // Le contenu rendu : peut être un texte long, un lien URL, ou un chemin de fichier
            $table->text('contenu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
