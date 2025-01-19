<?php

use App\Models\Position;
use App\Models\Community;
use App\Models\Leadership;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('community_leaderships', function (Blueprint $table) {
        $table->id();
        $table->foreignIdFor(Leadership::class)
            ->constrained()
            ->onDelete('cascade');
        $table->foreignIdFor(Position::class)
            ->constrained()
            ->onDelete('cascade');
        $table->foreignIdFor(Community::class)
            ->constrained()
            ->onDelete('cascade');
        $table->timestamps();

        // Índice único com nome personalizado para evitar o limite de 64 caracteres
        $table->unique(['leadership_id', 'position_id', 'community_id'], 'unique_leadership_position_community');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_leaderships');
    }
};
