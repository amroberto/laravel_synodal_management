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
        Schema::create('synods', function (Blueprint $table) {
            $table->id();
            $table->string('corporate_name'); // Razão social
            $table->string('trade_name'); // Nome fantasia
            $table->string('cnpj')->unique();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable(); // Celular/WhatsApp
            $table->string('cep')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('synods');
    }
};
