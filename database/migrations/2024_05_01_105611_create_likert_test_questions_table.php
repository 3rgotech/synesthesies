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
        Schema::create('likert_test_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('likert_test_id')->constrained('likert_tests')->cascadeOnDelete();
            $table->string('question', 1000);
            $table->unsignedInteger('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likert_test_questions');
    }
};
