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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            //13 digits and 4 dash to separate by 5 groups
            $table->char('isbn', 17)->unique()->nullable();
            $table->unsignedInteger('page_count');
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('set null')->onUpdate('set null');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null')->onUpdate('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
