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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('address_number');
            $table->string('complement')->nullable();
            $table->string('neighborhood');
            $table->string('postal_code');
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            
            // Chaves estrangeiras específicas
            $table->foreignId('community_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('leadership_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign(['city_id']);  // Remover a chave estrangeira
        });
    
        Schema::dropIfExists('addresses');
    }
};
