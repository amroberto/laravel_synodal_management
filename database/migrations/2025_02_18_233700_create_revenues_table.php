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
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('community_id')->constrained()->onDelete('cascade');
            $table->date('dt_revenue');
            $table->string('reference_month', 2);
            $table->string('reference_year', 4);
            $table->decimal('total_revenue', 10, 2);
            $table->decimal('tithe', 10, 2);
            $table->decimal('other', 10, 2)->nullable();
            $table->decimal('total_offers', 10, 2)->nullable();
            $table->string('month', 2);
            $table->string('year', 4);
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
