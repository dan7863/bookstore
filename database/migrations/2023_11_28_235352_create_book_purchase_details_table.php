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
        Schema::create('book_purchase_details', function (Blueprint $table) {
            $table->id();
            $table->string('signatory');
            $table->unsignedDecimal('price', 10, 3);
            $table->boolean('available_state');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')
            ->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_purchase_details');
    }
};
