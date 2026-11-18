<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotion_contacts', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('country');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::create('meetings', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('country');
            $table->dateTime('meeting_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meetings');
        Schema::dropIfExists('promotion_contacts');
    }
};
