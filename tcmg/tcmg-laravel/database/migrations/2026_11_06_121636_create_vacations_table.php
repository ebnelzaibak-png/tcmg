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
    Schema::create('vacations', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('employee_id')->nullable();
        $table->string('leave_type'); // عارضة، سنوية، مرضية، إلخ.
        $table->date('start_date');
        $table->date('end_date');
        $table->text('reason')->nullable();
        $table->string('status')->default('معلقة'); // معلقة، مقبول، مرفوض
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacations');
    }
};
