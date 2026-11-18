<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ClientsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('clints', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('nationality')->default('مصر');
            $table->string('type')->default('فرد');
            $table->timestamps();
        });
    }

    public function test_client_list_and_create_form_are_available(): void
    {
        $this->get('/clients')->assertOk()->assertSee('قائمة العملاء');
        $this->get('/clients/create')
            ->assertOk()
            ->assertSee('إضافة عميل')
            ->assertSee('name="nationality"', false)
            ->assertSee('name="type"', false);
    }

    public function test_client_can_be_created_with_country_and_category(): void
    {
        $this->post('/clients', [
            'name' => 'عميل جديد',
            'nationality' => 'مصر',
            'phone' => '01012345678',
            'email' => 'client@example.com',
            'type' => 'عميل',
        ])->assertRedirect('/clients');

        $this->assertDatabaseHas('clints', [
            'name' => 'عميل جديد',
            'nationality' => 'مصر',
            'phone' => '01012345678',
            'email' => 'client@example.com',
            'type' => 'عميل',
        ]);

        $this->get('/clients')->assertOk()->assertSee('عميل جديد');
    }

    public function test_client_country_and_category_are_validated(): void
    {
        $this->from('/clients/create')->post('/clients', [
            'name' => 'عميل غير صالح',
            'nationality' => 'بلد غير معروف',
            'phone' => '01012345678',
            'email' => '',
            'type' => 'فئة غير معروفة',
        ])->assertRedirect('/clients/create')
            ->assertSessionHasErrors(['nationality', 'type']);

        $this->assertSame(0, DB::table('clints')->count());
    }

    public function test_clients_can_be_updated_deleted_and_bulk_deleted(): void
    {
        $id = DB::table('clints')->insertGetId([
            'name' => 'عميل',
            'nationality' => 'مصر',
            'phone' => '01000000000',
            'type' => 'فرد',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->put("/clients/{$id}", [
            'name' => 'عميل معدل',
            'nationality' => 'السعودية',
            'phone' => '01111111111',
            'email' => '',
            'type' => 'شركة ومؤسسة',
        ])->assertRedirect('/clients');

        $this->assertDatabaseHas('clints', [
            'id' => $id,
            'name' => 'عميل معدل',
            'nationality' => 'السعودية',
            'type' => 'شركة ومؤسسة',
        ]);

        $this->delete('/clients', ['ids' => [$id]])->assertRedirect('/clients');
        $this->assertDatabaseMissing('clints', ['id' => $id]);
    }
}
