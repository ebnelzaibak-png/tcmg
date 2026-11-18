<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultations', function (Blueprint $table): void {
            if (! Schema::hasColumn('consultations', 'consultation_type')) {
                $table->string('consultation_type')->nullable();
            }

            if (! Schema::hasColumn('consultations', 'specialization')) {
                $table->string('specialization')->nullable();
            }

            if (! Schema::hasColumn('consultations', 'lawyer_name')) {
                $table->string('lawyer_name')->nullable();
            }

            if (! Schema::hasColumn('consultations', 'consultation_date')) {
                $table->date('consultation_date')->nullable();
            }

            if (! Schema::hasColumn('consultations', 'consultation_time')) {
                $table->time('consultation_time')->nullable();
            }

            if (! Schema::hasColumn('consultations', 'price')) {
                $table->decimal('price', 12, 2)->nullable();
            }

            if (! Schema::hasColumn('consultations', 'country')) {
                $table->string('country')->nullable();
            }

            if (! Schema::hasColumn('consultations', 'legal_opinion')) {
                $table->text('legal_opinion')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('consultations', function (Blueprint $table): void {
            $columns = [
                'consultation_type',
                'specialization',
                'lawyer_name',
                'consultation_date',
                'consultation_time',
                'price',
                'country',
                'legal_opinion',
            ];
            $existingColumns = array_filter(
                $columns,
                fn (string $column): bool => Schema::hasColumn('consultations', $column)
            );

            if ($existingColumns !== []) {
                $table->dropColumn(array_values($existingColumns));
            }
        });
    }
};
