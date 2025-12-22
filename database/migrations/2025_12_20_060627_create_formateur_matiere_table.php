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
        Schema::create('formateur_matiere', function (Blueprint $table) {
        $table->id();
        $table->foreignId('formateur_id')->constrained('formateurs')->onDelete('cascade');
        $table->foreignId('matiere_id')->constrained('matieres')->onDelete('cascade');
        $table->timestamps();

        // Empêche les doublons (Un formateur ne peut être lié qu'une fois à une même matière)
        $table->unique(['formateur_id', 'matiere_id']);
     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formateur_matiere');
    }
};
