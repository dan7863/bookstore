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
        Schema::create('progress_states', function (Blueprint $table) {
            $table->enum('reading_state', ['Not Started', 'Ongoing', 'Completed']);
            $table->unsignedInteger('page_count')->nullable()->default(0);
            $table->unsignedBigInteger('progress_stateable_id');
            $table->string('progress_stateable_type');
            $table->primary(['progress_stateable_id', 'progress_stateable_type']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_states');
    }
};
