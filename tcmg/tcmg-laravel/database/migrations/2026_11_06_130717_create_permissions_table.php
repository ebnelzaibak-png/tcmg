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
    Schema::create('permissions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id');
        $table->string('module_name'); // اسم القسم (العملاء، القضايا، الموارد البشرية، المالية...)
        $table->boolean('can_view')->default(true);   // صلاحية العرض
        $table->boolean('can_add')->default(false);   // صلاحية الإضافة
        $table->boolean('can_edit')->default(false);  // صلاحية التعديل
        $table->boolean('can_delete')->default(false); // صلاحية الحذف
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
