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
            $table->rememberToken();
            $table->string('gender');
            $table->unsignedSmallInteger('birth_year');
            $table->string('citizenship');
            $table->string('region')->nullable();
            $table->string('language');
            $table->boolean('keep_informed')->default(false);
            $table->json('disorders');
            $table->text('other_disorders')->nullable();
            $table->json('diagnosis');
            $table->json('synesthesies');
            $table->json('spatial_synesthesies');
            $table->boolean('subtitles');
            $table->boolean('always_existed')->nullable();
            $table->boolean('has_changed')->nullable();
            $table->text('has_changed_details')->nullable();
            $table->boolean('problematic')->nullable();
            $table->text('problematic_details')->nullable();
            $table->text('comments')->nullable();
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
