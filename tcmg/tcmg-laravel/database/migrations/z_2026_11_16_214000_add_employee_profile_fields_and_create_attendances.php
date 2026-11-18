<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $addAge = ! Schema::hasColumn('employee_models', 'age');
        $addCountry = ! Schema::hasColumn('employee_models', 'country');
        $addSalaryType = ! Schema::hasColumn('employee_models', 'salary_type');

        if ($addAge || $addCountry || $addSalaryType) {
            Schema::table('employee_models', function (Blueprint $table) use ($addAge, $addCountry, $addSalaryType): void {
                if ($addAge) {
                    $table->unsignedTinyInteger('age')->nullable();
                }

                if ($addCountry) {
                    $table->string('country')->nullable();
                }

                if ($addSalaryType) {
                    $table->string('salary_type')->nullable();
                }
            });
        }

        if (! Schema::hasTable('employee_attendances')) {
            Schema::create('employee_attendances', function (Blueprint $table): void {
                $table->id();
                $table->foreignId('employee_id')->constrained('employee_models')->cascadeOnDelete();
                $table->date('attendance_date');
                $table->time('check_in')->nullable();
                $table->time('check_out')->nullable();
                $table->string('status')->default('حاضر');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_attendances');

        if (! Schema::hasTable('employee_models')) {
            return;
        }

        $columns = array_values(array_filter(
            ['age', 'country', 'salary_type'],
            fn (string $column): bool => Schema::hasColumn('employee_models', $column)
        ));

        if ($columns !== []) {
            Schema::table('employee_models', fn (Blueprint $table) => $table->dropColumn($columns));
        }
    }
};
