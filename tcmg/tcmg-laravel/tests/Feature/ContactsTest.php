<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('contact_models', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('category')->default('أخرى');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->string('country')->nullable();
            $table->string('other_lawyer_phone')->nullable();
            $table->timestamps();
        });
        Schema::create('promotion_contacts', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('country');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->timestamps();
        });
        Schema::create('meetings', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('country');
            $table->dateTime('meeting_at');
            $table->timestamps();
        });
    }

    public function test_contact_form_and_list_are_available(): void
    {
        $this->get('/contacts/create')
            ->assertOk()
            ->assertSee('إضافة جهة اتصال')
            ->assertSee('name="country"', false)
            ->assertSee('name="category"', false);

        $this->get('/contacts')->assertOk();
    }

    public function test_contact_can_be_created_and_appears_in_the_list(): void
    {
        $this->post('/contacts', [
            'name' => 'أحمد علي',
            'country' => 'مصر',
            'phone' => '01012345678',
            'email' => 'ahmed@example.com',
            'category' => 'محامي',
        ])->assertRedirect('/contacts');

        $this->assertDatabaseHas('contact_models', [
            'name' => 'أحمد علي',
            'country' => 'مصر',
            'phone' => '01012345678',
            'email' => 'ahmed@example.com',
            'category' => 'محامي',
        ]);

        $this->get('/contacts')->assertOk()->assertSee('أحمد علي');
    }

    public function test_contact_can_be_updated_and_deleted(): void
    {
        $id = DB::table('contact_models')->insertGetId([
            'name' => 'عميل',
            'category' => 'عميل',
            'country' => 'مصر',
            'phone' => '01000000000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->put("/contacts/{$id}", [
            'name' => 'عميل معدل',
            'country' => 'السعودية',
            'phone' => '01111111111',
            'email' => '',
            'category' => 'محامي',
        ])->assertRedirect('/contacts');

        $this->assertDatabaseHas('contact_models', [
            'id' => $id,
            'name' => 'عميل معدل',
            'country' => 'السعودية',
            'category' => 'محامي',
        ]);

        $this->delete("/contacts/{$id}")->assertRedirect('/contacts');
        $this->assertDatabaseMissing('contact_models', ['id' => $id]);
    }

    public function test_promotion_contacts_support_create_update_and_bulk_delete(): void
    {
        $this->post('/promotion-contacts', [
            'name' => 'مرشح ترويجي',
            'country' => 'مصر',
            'phone' => '01012345678',
            'email' => 'promo@example.com',
        ])->assertRedirect('/contacts');

        $id = DB::table('promotion_contacts')->where('name', 'مرشح ترويجي')->value('id');
        $this->assertNotNull($id);
        $this->get('/contacts')->assertOk()->assertSee('مرشح ترويجي');

        $this->put("/promotion-contacts/{$id}", [
            'name' => 'مرشح معدل',
            'country' => 'السعودية',
            'phone' => '01111111111',
            'email' => '',
        ])->assertRedirect('/contacts');

        $this->assertDatabaseHas('promotion_contacts', [
            'id' => $id,
            'name' => 'مرشح معدل',
            'country' => 'السعودية',
        ]);

        $this->delete('/promotion-contacts', ['ids' => [$id]])->assertRedirect('/contacts');
        $this->assertDatabaseMissing('promotion_contacts', ['id' => $id]);
    }

    public function test_meetings_support_create_update_and_delete(): void
    {
        $this->post('/meetings', [
            'title' => 'اجتماع اختبار',
            'country' => 'مصر',
            'meeting_at' => '2026-11-20T14:30',
        ])->assertRedirect('/contacts');

        $id = DB::table('meetings')->where('title', 'اجتماع اختبار')->value('id');
        $this->assertNotNull($id);
        $this->get('/contacts')->assertOk()->assertSee('اجتماع اختبار');

        $this->put("/meetings/{$id}", [
            'title' => 'اجتماع معدل',
            'country' => 'الإمارات',
            'meeting_at' => '2026-11-21T15:00',
        ])->assertRedirect('/contacts');

        $this->assertDatabaseHas('meetings', [
            'id' => $id,
            'title' => 'اجتماع معدل',
            'country' => 'الإمارات',
        ]);

        $this->delete("/meetings/{$id}")->assertRedirect('/contacts');
        $this->assertDatabaseMissing('meetings', ['id' => $id]);
    }
}
