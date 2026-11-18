<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clints', function (Blueprint $table): void {
            if (! Schema::hasColumn('clints', 'nationality')) {
                $table->string('nationality')->default('مصر');
            }

            if (! Schema::hasColumn('clints', 'type')) {
                $table->string('type')->default('عميل');
            }
        });
    }

    public function down(): void
    {
        Schema::table('clints', function (Blueprint $table): void {
            $columns = [];

            if (Schema::hasColumn('clints', 'nationality')) {
                $columns[] = 'nationality';
            }

            if (Schema::hasColumn('clints', 'type')) {
                $columns[] = 'type';
            }

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
