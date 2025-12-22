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
        Schema::create('evaluations', function (Blueprint $table) {
        $table->id();
        // Relation unique : une livraison n'est évaluée qu'une seule fois
        $table->foreignId('livraison_id')->unique()->constrained('livraisons')->onDelete('cascade');
        $table->integer('note');
        $table->integer('points');
        $table->text('commentaire')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
