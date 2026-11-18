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
    Schema::create('consultations', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('clint_id'); // العميل صاحب الاستشارة
        $table->string('subject');              // موضوع الاستشارة
        $table->text('details');                // تفاصيل الاستشارة
 
        $table->string('status')->default('قيد الدراسة'); // قيد الدراسة، تم الرد، مغلقة
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
$table->text('legal_opinion')->nullable();