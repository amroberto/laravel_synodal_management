<?php

use App\Enums\GenderEnum;
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
        Schema::create('leaderships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->date('birthdate');
            $table->enum('gender', GenderEnum::values());
            $table->foreignId('community_id')->constrained()->onDelete('cascade');
            $table->string('mobile');
            $table->string('business_phone');
            $table->string('home_phone');
            $table->string('email');
            $table->string('photo')->nullable(); 
            $table->foreignId('address_id')->constrained()->onDelete('cascade');                
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
