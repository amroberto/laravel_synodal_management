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
        Schema::create('revenue_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('revenue_category_id')->index()->constrained()->cascadeOnDelete();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenue_sub_categories');
    }
};
