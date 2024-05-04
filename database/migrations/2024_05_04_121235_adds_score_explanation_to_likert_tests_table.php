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
        Schema::table('likert_tests', function (Blueprint $table) {
            $table->text('score_explanation')->nullable()->after('score_computation_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('likert_tests', function (Blueprint $table) {
            $table->dropColumn('score_explanation');
        });
    }
};
