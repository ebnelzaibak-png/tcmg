<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $addCountry = ! Schema::hasColumn('task_models', 'country');
        $addCategory = ! Schema::hasColumn('task_models', 'category');

        if ($addCountry || $addCategory) {
            Schema::table('task_models', function (Blueprint $table) use ($addCountry, $addCategory): void {
                if ($addCountry) {
                    $table->string('country')->nullable();
                }

                if ($addCategory) {
                    $table->string('category')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('task_models')) {
            return;
        }

        $dropCountry = Schema::hasColumn('task_models', 'country');
        $dropCategory = Schema::hasColumn('task_models', 'category');

        if ($dropCountry || $dropCategory) {
            Schema::table('task_models', function (Blueprint $table) use ($dropCountry, $dropCategory): void {
                $columns = [];
                if ($dropCountry) {
                    $columns[] = 'country';
                }
                if ($dropCategory) {
                    $columns[] = 'category';
                }
                $table->dropColumn($columns);
            });
        }
    }
};
