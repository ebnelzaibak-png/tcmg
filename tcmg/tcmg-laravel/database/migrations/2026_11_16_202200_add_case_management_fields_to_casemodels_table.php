<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('casemodels', function (Blueprint $table): void {
            if (! Schema::hasColumn('casemodels', 'country')) {
                $table->string('country')->nullable();
            }

            if (! Schema::hasColumn('casemodels', 'client2_id')) {
                $table->unsignedBigInteger('client2_id')->nullable();
            }

            if (! Schema::hasColumn('casemodels', 'lawyer1_name')) {
                $table->string('lawyer1_name')->nullable();
            }

            if (! Schema::hasColumn('casemodels', 'lawyer2_name')) {
                $table->string('lawyer2_name')->nullable();
            }

            if (! Schema::hasColumn('casemodels', 'first_session_date')) {
                $table->date('first_session_date')->nullable();
            }

            if (! Schema::hasColumn('casemodels', 'judgment_date')) {
                $table->date('judgment_date')->nullable();
            }

            if (! Schema::hasColumn('casemodels', 'judgment')) {
                $table->string('judgment')->nullable();
            }

            if (! Schema::hasColumn('casemodels', 'fee')) {
                $table->decimal('fee', 12, 2)->nullable();
            }

            if (! Schema::hasColumn('casemodels', 'tasks')) {
                $table->text('tasks')->nullable();
            }

            if (! Schema::hasColumn('casemodels', 'status')) {
                $table->string('status')->default('نشطة');
            }

            if (! Schema::hasColumn('casemodels', 'report')) {
                $table->text('report')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('casemodels', function (Blueprint $table): void {
            $columns = [
                'country',
                'client2_id',
                'lawyer1_name',
                'lawyer2_name',
                'first_session_date',
                'judgment_date',
                'judgment',
                'fee',
                'tasks',
                'status',
                'report',
            ];
            $existingColumns = array_values(array_filter(
                $columns,
                fn (string $column): bool => Schema::hasColumn('casemodels', $column)
            ));

            if ($existingColumns !== []) {
                $table->dropColumn($existingColumns);
            }
        });
    }
};
