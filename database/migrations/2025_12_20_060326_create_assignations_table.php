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
        Schema::create('assignations', function (Blueprint $table) {
            $table->id();
            
            // Le travail concerné
            $table->foreignId('travail_id')->constrained('travails')->onDelete('cascade');
            
            // Choix de la cible (un seul doit être rempli)
            $table->foreignId('etudiant_id')->nullable()->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('groupe_id')->nullable()->constrained('groupes')->onDelete('cascade');
            $table->foreignId('promotion_id')->nullable()->constrained('promotions')->onDelete('cascade');
            // Calendrier
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignations');
    }
};
