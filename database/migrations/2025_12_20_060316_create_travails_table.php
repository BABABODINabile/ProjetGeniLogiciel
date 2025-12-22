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
        Schema::create('travails', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('consigne');
        
        // Type de travail : individuel ou collectif
        $table->enum('type', ['individuel', 'collectif','groupe'])->default('individuel');
        
        // Relation avec l'espace pédagogique
        $table->foreignId('espace_id')->constrained('espaces')->onDelete('cascade');
        $table->enum('statut', ['en_attente', 'en_cours', 'termine'])->default('en_attente');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travails');
    }
};
