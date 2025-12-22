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
        // Add translations column to types table
        Schema::table('types', function (Blueprint $table) {
            $table->json('libelle_translations')->nullable()->after('libelle');
        });

        // Add translations column to zones table
        Schema::table('zones', function (Blueprint $table) {
            $table->json('libelle_translations')->nullable()->after('libelle');
        });

        // Add translations column to actions table
        Schema::table('actions', function (Blueprint $table) {
            $table->json('libelle_translations')->nullable()->after('libelle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('types', function (Blueprint $table) {
            $table->dropColumn('libelle_translations');
        });

        Schema::table('zones', function (Blueprint $table) {
            $table->dropColumn('libelle_translations');
        });

        Schema::table('actions', function (Blueprint $table) {
            $table->dropColumn('libelle_translations');
        });
    }
};
