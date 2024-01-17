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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('gender');
            $table->unsignedSmallInteger('birth_year');
            $table->string('citizenship');
            $table->string('region');
            $table->string('language');
            $table->boolean('keep_informed')->default(false);
            $table->json('disorders');
            $table->string('diagnosis');
            $table->boolean('always_existed')->nullable();
            $table->boolean('has_changed')->nullable();
            $table->string('has_changed_details')->nullable();
            $table->boolean('problematic')->nullable();
            $table->string('problematic_details')->nullable();
            $table->text('comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
