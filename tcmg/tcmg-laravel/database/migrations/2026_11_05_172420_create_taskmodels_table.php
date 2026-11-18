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
    Schema::create('task_models', function (Blueprint $table) {
        $table->id();
        $table->foreignId('clint_id')->nullable()->constrained('clints')->onDelete('cascade'); // ربط المهمة بالعميل (اختياري)
        $table->string('title'); // عنوان المهمة
        $table->text('description')->nullable(); // وصف أو تفاصيل المهمة
        $table->string('priority')->default('عادية'); // الأولوية (عالية، متوسطة، عادية)
        $table->string('status')->default('قيد التنفيذ'); // حالة المهمة (قيد التنفيذ، مكتملة)
        $table->date('due_date')->nullable(); // الموعد النهائي للإنجاز
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_models');
    }
};
