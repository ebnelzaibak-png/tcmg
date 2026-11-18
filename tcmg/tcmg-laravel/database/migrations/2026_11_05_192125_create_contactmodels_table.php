<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_models', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الشخص أو الجهة
            $table->string('category')->default('أخرى'); // التصنيف (خبير، محام خصم، جهة حكومية، شاهد...)
            $table->string('phone'); // رقم الهاتف
            $table->string('email')->nullable(); // البريد الإلكتروني
            $table->text('address')->nullable(); // العنوان
            $table->text('notes')->nullable(); // ملاحظات إضافية
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_models');
    }
};