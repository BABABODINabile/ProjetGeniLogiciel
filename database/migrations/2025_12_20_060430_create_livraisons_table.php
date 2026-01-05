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
            $table->foreignId('assignation_id')->constrained('assignations')->onDelete('cascade');
            
            // Le chemin du fichier (optionnel si l'étudiant n'envoie que du texte)
            $table->string('fichier_path')->nullable();
            
            // Le message ou texte saisi par l'étudiant (optionnel)
            $table->text('message')->nullable();
            
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
