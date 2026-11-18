<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CasesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('clints', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->timestamps();
        });
        Schema::create('casemodels', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('clint_id');
            $table->string('case_number');
            $table->string('court_name');
            $table->string('case_type')->nullable();
            $table->date('session_date')->nullable();
            $table->text('details')->nullable();
            $table->string('country')->nullable();
            $table->unsignedBigInteger('client2_id')->nullable();
            $table->string('lawyer1_name')->nullable();
            $table->string('lawyer2_name')->nullable();
            $table->date('first_session_date')->nullable();
            $table->date('judgment_date')->nullable();
            $table->string('judgment')->nullable();
            $table->decimal('fee', 12, 2)->nullable();
            $table->text('tasks')->nullable();
            $table->string('status')->default('نشطة');
            $table->text('report')->nullable();
            $table->timestamps();
        });
    }

    public function test_case_list_and_create_form_are_available(): void
    {
        DB::table('clints')->insert([
            'name' => 'موكل اختبار',
            'phone' => '01000000000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->get('/cases')->assertOk()->assertSee('القضايا');
        $this->get('/cases/create')
            ->assertOk()
            ->assertSee('إضافة قضية')
            ->assertSee('name="clint_id"', false)
            ->assertSee('name="first_session_date"', false)
            ->assertSee('name="report"', false);
    }

    public function test_case_can_be_created_updated_and_deleted(): void
    {
        $clientId = DB::table('clints')->insertGetId([
            'name' => 'موكل أول',
            'phone' => '01000000000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $client2Id = DB::table('clints')->insertGetId([
            'name' => 'موكل ثان',
            'phone' => '01111111111',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->post('/cases', [
            'clint_id' => $clientId,
            'client2_id' => $client2Id,
            'country' => 'مصر',
            'case_type' => 'تجارية',
            'lawyer1_name' => 'محامي أول',
            'lawyer2_name' => 'محامي ثان',
            'first_session_date' => '2026-11-20',
            'session_date' => '2026-12-01',
            'judgment_date' => '',
            'judgment' => '',
            'court_name' => 'محكمة القاهرة',
            'status' => 'نشطة',
            'fee' => '2500',
            'tasks' => 'تجهيز المستندات',
            'report' => 'تقرير القضية',
        ])->assertRedirect('/cases');

        $id = DB::table('casemodels')->value('id');
        $this->assertDatabaseHas('casemodels', [
            'id' => $id,
            'case_number' => (string) $id,
            'clint_id' => $clientId,
            'client2_id' => $client2Id,
            'case_type' => 'تجارية',
            'court_name' => 'محكمة القاهرة',
            'fee' => 2500,
            'status' => 'نشطة',
        ]);
        $this->get('/cases')->assertOk()->assertSee('موكل أول')->assertSee('تجارية');

        $this->put("/cases/{$id}", [
            'case_number' => '',
            'clint_id' => $clientId,
            'client2_id' => '',
            'country' => 'السعودية',
            'case_type' => 'مدنية',
            'lawyer1_name' => '',
            'lawyer2_name' => '',
            'first_session_date' => '',
            'session_date' => '',
            'judgment_date' => '',
            'judgment' => 'حكم ابتدائي',
            'court_name' => 'محكمة الرياض',
            'status' => 'قيد المراجعة',
            'fee' => '',
            'tasks' => '',
            'report' => '',
        ])->assertRedirect('/cases');

        $this->assertDatabaseHas('casemodels', [
            'id' => $id,
            'case_number' => (string) $id,
            'country' => 'السعودية',
            'case_type' => 'مدنية',
            'status' => 'قيد المراجعة',
        ]);

        $this->delete("/cases/{$id}")->assertRedirect('/cases');
        $this->assertDatabaseMissing('casemodels', ['id' => $id]);

        $bulkId = DB::table('casemodels')->insertGetId([
            'clint_id' => $clientId,
            'case_number' => 'BULK-1',
            'court_name' => 'محكمة القاهرة',
            'case_type' => 'مدنية',
            'status' => 'نشطة',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->delete('/cases', ['ids' => [$bulkId]])->assertRedirect('/cases');
        $this->assertDatabaseMissing('casemodels', ['id' => $bulkId]);
    }

    public function test_case_requires_a_valid_client_country_and_category(): void
    {
        $this->from('/cases/create')->post('/cases', [
            'clint_id' => 99,
            'country' => 'بلد غير صالح',
            'case_type' => 'نوع غير صالح',
            'court_name' => 'محكمة',
            'status' => 'نشطة',
        ])->assertRedirect('/cases/create')
            ->assertSessionHasErrors(['clint_id', 'country', 'case_type']);

        $this->assertSame(0, DB::table('casemodels')->count());
    }
}
