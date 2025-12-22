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
        Schema::create('bateau_equipement', function (Blueprint $table) {
            $table->foreignId('bateau_id')->constrained('bateaux')->onDelete('cascade');
            $table->foreignId('equipement_id')->constrained('equipements')->onDelete('cascade');
            $table->timestamps();

            $table->primary(['bateau_id', 'equipement_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bateau_equipement');
    }
};
