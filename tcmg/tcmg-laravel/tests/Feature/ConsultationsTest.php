<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ConsultationsTest extends TestCase
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
            $table->timestamps();
        });

        Schema::create('consultations', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('clint_id');
            $table->string('subject');
            $table->text('details');
            $table->text('legal_opinion')->nullable();
            $table->string('consultation_type')->nullable();
            $table->string('specialization')->nullable();
            $table->string('lawyer_name')->nullable();
            $table->date('consultation_date')->nullable();
            $table->time('consultation_time')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->string('country')->nullable();
            $table->string('status')->default('قيد الدراسة');
            $table->timestamps();
        });
    }

    public function test_consultation_list_and_add_form_are_available(): void
    {
        $this->get('/consultations')
            ->assertOk()
            ->assertSee('الاستشارات القانونية')
            ->assertSee('عدد الاستشارات القانونية')
            ->assertSee('لا توجد استشارات قانونية مسجلة');

        $this->get('/consultations/create')
            ->assertOk()
            ->assertSee('إضافة استشارة قانونية')
            ->assertSee('name="country"', false)
            ->assertSee('إضافة عميل');
    }

    public function test_consultation_can_be_created_updated_and_deleted(): void
    {
        $clientId = $this->insertClient();

        $this->post('/consultations', $this->consultationData($clientId))
            ->assertRedirect('/consultations');

        $id = DB::table('consultations')->value('id');
        $this->assertDatabaseHas('consultations', [
            'id' => $id,
            'clint_id' => $clientId,
            'subject' => 'تجاري',
            'consultation_type' => 'مكتبية',
            'specialization' => 'تجاري',
            'consultation_date' => '2026-11-25',
            'consultation_time' => '14:30',
            'price' => '1500.00',
            'country' => 'السعودية',
            'status' => 'قيد الدراسة',
        ]);
        $this->get('/consultations')->assertOk()->assertSee('استشارة ' . $id)->assertSee('عميل استشارات');
        $this->get("/consultations/{$id}/edit")->assertOk()->assertSee('تعديل الاستشارة القانونية');

        $updated = $this->consultationData($clientId);
        $updated['consultation_type'] = 'هاتفية';
        $updated['specialization'] = 'مدني';
        $updated['lawyer_name'] = 'محامي معدل';
        $updated['consultation_date'] = '2026-11-26';
        $updated['country'] = 'البحرين';
        $updated['status'] = 'تم الرد';
        $this->put("/consultations/{$id}", $updated)->assertRedirect('/consultations');

        $this->assertDatabaseHas('consultations', [
            'id' => $id,
            'consultation_type' => 'هاتفية',
            'specialization' => 'مدني',
            'lawyer_name' => 'محامي معدل',
            'consultation_date' => '2026-11-26',
            'country' => 'البحرين',
            'status' => 'تم الرد',
        ]);
        $this->get('/consultations?q=محامي%20معدل&type=هاتفية&status=تم%20الرد')
            ->assertOk()
            ->assertSee('عميل استشارات');

        $this->delete("/consultations/{$id}")->assertRedirect('/consultations');
        $this->assertDatabaseMissing('consultations', ['id' => $id]);
    }

    public function test_consultations_support_bulk_delete_and_validate_form_data(): void
    {
        $clientId = $this->insertClient();
        $ids = [
            $this->insertConsultation($clientId),
            $this->insertConsultation($clientId),
        ];

        $this->delete('/consultations', ['ids' => $ids])->assertRedirect('/consultations');
        foreach ($ids as $id) {
            $this->assertDatabaseMissing('consultations', ['id' => $id]);
        }

        $this->from('/consultations/create')->post('/consultations', [
            'clint_id' => 999,
            'consultation_type' => 'غير معروف',
            'specialization' => 'غير معروف',
            'lawyer_name' => '',
            'country' => 'بلد غير مدعوم',
            'consultation_date' => 'تاريخ غير صحيح',
            'consultation_time' => 'وقت غير صحيح',
            'price' => '-1',
            'details' => '',
        ])->assertRedirect('/consultations/create')
            ->assertSessionHasErrors([
                'clint_id',
                'consultation_type',
                'specialization',
                'lawyer_name',
                'country',
                'consultation_date',
                'consultation_time',
                'price',
                'details',
            ]);
    }

    private function insertClient(): int
    {
        return DB::table('clints')->insertGetId([
            'name' => 'عميل استشارات',
            'phone' => '01012345678',
            'email' => 'consultation-client@example.test',
            'nationality' => 'مصر',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function insertConsultation(int $clientId): int
    {
        return DB::table('consultations')->insertGetId([
            'clint_id' => $clientId,
            'subject' => 'قضية تجارية',
            'details' => 'تقرير استشارة تجريبية',
            'consultation_type' => 'هاتفية',
            'specialization' => 'تجاري',
            'lawyer_name' => 'محامي تجريبي',
            'country' => 'مصر',
            'consultation_date' => '2026-11-25',
            'consultation_time' => '14:30',
            'price' => 1000,
            'country' => 'مصر',
            'status' => 'قيد الدراسة',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function consultationData(int $clientId): array
    {
        return [
            'clint_id' => $clientId,
            'consultation_type' => 'مكتبية',
            'specialization' => 'تجاري',
            'lawyer_name' => 'محامي تجريبي',
            'country' => 'السعودية',
            'consultation_date' => '2026-11-25',
            'consultation_time' => '14:30',
            'price' => '1500.00',
            'details' => 'تقرير استشارة تجريبية',
        ];
    }
}
