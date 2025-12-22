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
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bateau_id')->constrained('bateaux')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('type', ['image', 'video'])->default('image');
            $table->text('url');
            $table->string('description', 255)->nullable();
            $table->unsignedInteger('ordre')->default(0);
            $table->timestamps();

            // Indexes for performance
            $table->index(['bateau_id', 'ordre']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
