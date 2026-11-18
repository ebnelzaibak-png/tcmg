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
    Schema::create('casemodels', function (Blueprint $table) {
        $table->id();
        $table->foreignId('clint_id')->constrained('clints')->onDelete('cascade'); // ربط القضية بالعميل
        $table->string('case_number'); // رقم القضية
        $table->string('court_name'); // اسم المحكمة
        $table->string('case_type')->nullable(); // نوع القضية
        $table->date('session_date')->nullable(); // تاريخ الجلسة
        $table->text('details')->nullable(); // تفاصيل القضية
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casemodels');
    }
};
