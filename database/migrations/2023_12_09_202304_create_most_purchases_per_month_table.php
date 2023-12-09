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
        Schema::create('most_purchases_per_month', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('purchases');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')
            ->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamp('first_of_month')->default(now());
            $table->timestamp('last_of_month')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('most_purchases_per_month');
    }
};
