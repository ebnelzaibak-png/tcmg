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
        Schema::create('clints', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // اسم العميل
            $table->string('phone');             // رقم الهاتف
            $table->string('email')->nullable(); // البريد الإلكتروني
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clints');
    }
};
