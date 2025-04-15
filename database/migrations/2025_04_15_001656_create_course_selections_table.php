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
        Schema::create('course_selections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quotations')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses');
            $table->date('start_date');
            $table->unsignedInteger('duration_weeks');
            $table->unsignedInteger('sequence_order')->default(0);
            $table->timestamps();

            // Add index for faster lookups
            $table->index(['quotation_id', 'sequence_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_selections');
    }
};
