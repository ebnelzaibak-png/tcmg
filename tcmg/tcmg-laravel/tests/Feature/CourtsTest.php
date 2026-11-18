<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CourtsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('courts', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->string('country');
            $table->string('city');
            $table->string('governorate');
            $table->string('police_station');
            $table->timestamps();
        });
    }

    public function test_court_list_and_create_form_are_available(): void
    {
        $this->get('/court')->assertOk()->assertSee('كشف بالمحاكم');
        $this->get('/court/create')
            ->assertOk()
            ->assertSee('إضافة محكمة')
            ->assertSee('name="category"', false)
            ->assertSee('name="country"', false)
            ->assertSee('name="governorate"', false)
            ->assertSee('name="city"', false)
            ->assertSee('name="police_station"', false);
    }

    public function test_court_can_be_created_updated_and_deleted(): void
    {
        $this->post('/court', [
            'category' => 'محكمة ابتدائية',
            'country' => 'مصر',
            'city' => 'القاهرة',
            'governorate' => 'القاهرة',
            'police_station' => 'قسم وسط البلد',
        ])->assertRedirect('/court');

        $id = DB::table('courts')->value('id');
        $this->assertNotNull($id);
        $this->get('/court')->assertOk()->assertSee("محكمة {$id}");

        $this->put("/court/{$id}", [
            'category' => 'محكمة استئناف',
            'country' => 'مصر',
            'city' => 'الجيزة',
            'governorate' => 'الجيزة',
            'police_station' => 'قسم الدقي',
        ])->assertRedirect('/court');

        $this->assertDatabaseHas('courts', [
            'id' => $id,
            'name' => "محكمة {$id}",
            'category' => 'محكمة استئناف',
            'city' => 'الجيزة',
        ]);

        $this->delete("/court/{$id}")->assertRedirect('/court');
        $this->assertDatabaseMissing('courts', ['id' => $id]);
    }

    public function test_court_fields_are_validated(): void
    {
        $this->from('/court/create')->post('/court', [
            'category' => 'فئة غير صالحة',
            'country' => 'بلد غير صالح',
            'city' => '',
            'governorate' => '',
            'police_station' => '',
        ])->assertRedirect('/court/create')
            ->assertSessionHasErrors(['category', 'country', 'city', 'governorate', 'police_station']);

        $this->assertSame(0, DB::table('courts')->count());
    }

    public function test_courts_can_be_bulk_deleted(): void
    {
        $id = DB::table('courts')->insertGetId([
            'name' => 'محكمة اختبار',
            'category' => 'محكمة ابتدائية',
            'country' => 'مصر',
            'city' => 'القاهرة',
            'governorate' => 'القاهرة',
            'police_station' => 'قسم وسط البلد',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->delete('/court', ['ids' => [$id]])->assertRedirect('/court');
        $this->assertDatabaseMissing('courts', ['id' => $id]);
    }
}
