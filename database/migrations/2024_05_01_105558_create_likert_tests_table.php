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
        Schema::create('likert_tests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->text('introduction');
            $table->string('icon');
            $table->string('duration');
            $table->json('scale');
            $table->boolean('fixed_order')->default(false);
            $table->string('score_computation_method')->nullable();
            $table->timestamps();
        });

        Schema::create('likert_test_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('likert_test_id')->constrained('likert_tests')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likert_test_subjects');
        Schema::dropIfExists('likert_tests');
    }
};
