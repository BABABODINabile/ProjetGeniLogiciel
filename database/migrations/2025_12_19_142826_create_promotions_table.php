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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->foreignId('filiere_option_id')->constrained('filiere_options')->onDelete('cascade');
            $table->year('year');
            $table->timestamps();
            $table->unique(['libelle', 'filiere_option_id', 'year'], 'promotion_unique_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
