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
        Schema::create('bateaux', function (Blueprint $table) {
            $table->id();

            // Visibility & Status
            $table->boolean('visible')->default(true);
            $table->boolean('occasion')->default(false);

            // Relations
            $table->foreignId('zone_id')->nullable()->constrained('zones')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('type_id')->nullable()->constrained('types')->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('slogan_id')->nullable()->constrained('actions')->onDelete('set null')->onUpdate('cascade');

            // Basic Info
            $table->string('modele', 150)->nullable();
            $table->string('slug')->unique();

            // Price
            $table->decimal('prix', 12, 2)->nullable();
            $table->boolean('afficher_prix')->default(true);

            // Description & Marketing
            $table->text('description')->nullable();
            $table->string('symboles', 255)->nullable();
            $table->string('mots', 255)->nullable();

            // Technical Details
            $table->string('chantier', 150)->nullable();
            $table->string('architecte', 150)->nullable();
            $table->string('pavillon', 100)->nullable();
            $table->unsignedInteger('annee')->nullable();
            $table->string('materiaux', 100)->nullable();

            // Dimensions
            $table->decimal('longueurht', 6, 2)->nullable();
            $table->decimal('largeur', 6, 2)->nullable();
            $table->decimal('tirantdeau', 6, 2)->nullable();
            $table->decimal('poidslegeencharges', 10, 2)->nullable();
            $table->decimal('surfaceaupres', 10, 2)->nullable();

            // Engine & Mechanics
            $table->unsignedInteger('heuresmoteur')->nullable();
            $table->unsignedInteger('puissance')->nullable();
            $table->string('moteur', 100)->nullable();
            $table->string('systemeantiderive', 100)->nullable();

            // Accommodation
            $table->unsignedInteger('cabines')->nullable();
            $table->unsignedInteger('passagers')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index('visible');
            $table->index('occasion');
            $table->index('prix');
            $table->index(['zone_id', 'type_id']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bateaux');
    }
};
