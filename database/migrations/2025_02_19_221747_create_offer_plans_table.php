<?php

use App\Enums\OfferTypeEnum;
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
        Schema::create('offer_plans', function (Blueprint $table) {
            $table->id();
            $table->date('offer_date')->unique();
            $table->string('liturgical_date');
            $table->string('destination');
            $table->enum('offer_type', OfferTypeEnum::values());
            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_plans');
    }
};
