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
        Schema::create('leaderships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_actice')->default(true);
            $table->date('birthdate');
            $table->enum('gender', array_column(GenderEnum::cases(), 'value'));
            $table->foreignId('community_id')->index()->constrained()->cascadeOnDelete();
            $table->string('mobile');
            $table->string('business_phone');
            $table->string('home_phone');
            $table->string('email');
            $table->foreignId('address_id')->index()->constrained()->cascadeOnDelete(); 
            $table->string('photo')->nullable();                 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaderships');
    }
};
