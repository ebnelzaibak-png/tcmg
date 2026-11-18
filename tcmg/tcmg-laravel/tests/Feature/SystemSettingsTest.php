<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SystemSettingsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('system_settings', function (Blueprint $table): void {
            $table->string('key')->primary();
            $table->text('value');
            $table->timestamps();
        });
    }

    public function test_settings_page_shows_all_sections_and_defaults(): void
    {
        $this->get('/settings')
            ->assertOk()
            ->assertSee('إعدادات النظام')
            ->assertSee('تغيير صورة الجدول')
            ->assertSee('تنسيق التاريخ')
            ->assertSee('العملة')
            ->assertSee('المنطقة الزمنية')
            ->assertSee('Africa/Cairo');
    }

    public function test_system_setting_can_be_saved_and_is_shown_again(): void
    {
        $this->put('/settings', [
            'section' => 'currency',
            'currency' => 'SAR',
        ])->assertRedirect('/settings')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('system_settings', [
            'key' => 'currency',
            'value' => 'SAR',
        ]);

        $this->get('/settings')
            ->assertOk()
            ->assertSee('value="SAR" selected', false);
    }

    public function test_invalid_setting_values_are_rejected_without_overwriting_saved_values(): void
    {
        DB::table('system_settings')->insert([
            'key' => 'date_format',
            'value' => 'd/m/Y',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->from('/settings')->put('/settings', [
            'section' => 'date_format',
            'date_format' => 'invalid',
        ])->assertRedirect('/settings')
            ->assertSessionHasErrors('date_format');

        $this->assertDatabaseHas('system_settings', [
            'key' => 'date_format',
            'value' => 'd/m/Y',
        ]);
    }
}
