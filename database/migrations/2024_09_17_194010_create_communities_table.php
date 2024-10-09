<?php

use App\Enums\UnityTypeEnum;
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
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->string('corporate_name');
            $table->string('fantasy_name');
            $table->string('document');
            $table->enum('unity_type', UnityTypeEnum::values())->default(UnityTypeEnum::Community->value);
            $table->string('phone');
            $table->string('email');
            $table->foreignId('address_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropForeign(['address_id']);  // Remover a chave estrangeira
        });        
        Schema::dropIfExists('communities');
    }
};
