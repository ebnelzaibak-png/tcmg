<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('court_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->nullable()->constrained('casemodels')->onDelete('cascade');
            $table->string('court_name');
            $table->string('judge_name')->nullable();
            $table->date('session_date');
            $table->time('session_time')->nullable();
            $table->text('session_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('court_models');
    }
};