<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $addCountry = ! Schema::hasColumn('contact_models', 'country');
        $addOtherLawyerPhone = ! Schema::hasColumn('contact_models', 'other_lawyer_phone');

        if ($addCountry || $addOtherLawyerPhone) {
            Schema::table('contact_models', function (Blueprint $table) use ($addCountry, $addOtherLawyerPhone): void {
                if ($addCountry) {
                    $table->string('country')->nullable();
                }

                if ($addOtherLawyerPhone) {
                    $table->string('other_lawyer_phone')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        $columns = array_values(array_filter(
            ['country', 'other_lawyer_phone'],
            fn (string $column): bool => Schema::hasColumn('contact_models', $column)
        ));

        if ($columns !== []) {
            Schema::table('contact_models', fn (Blueprint $table) => $table->dropColumn($columns));
        }
    }
};
