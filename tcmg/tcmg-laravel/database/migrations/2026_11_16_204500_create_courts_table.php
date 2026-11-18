<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('courts')) {
            return;
        }

        Schema::create('courts', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('country');
            $table->string('city');
            $table->string('governorate');
            $table->string('police_station');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
