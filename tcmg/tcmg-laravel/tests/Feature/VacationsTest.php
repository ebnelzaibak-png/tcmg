<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class VacationsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('employee_models', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('job_title');
            $table->string('country')->nullable();
            $table->timestamps();
        });

        Schema::create('vacations', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('leave_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason')->nullable();
            $table->string('status')->default('معلقة');
            $table->timestamps();
        });
    }

    public function test_vacation_list_and_request_form_are_available(): void
    {
        $this->get('/vacations')
            ->assertOk()
            ->assertSee('إدارة الإجازات')
            ->assertSee('لا توجد طلبات إجازة مسجلة');

        $this->get('/vacations/create')
            ->assertOk()
            ->assertSee('طلب إجازة')
            ->assertSee('أضف موظفًا أولًا');
    }

    public function test_vacation_can_be_created_updated_and_deleted(): void
    {
        $employeeId = $this->insertEmployee('موظف إجازة');

        $this->post('/vacations', [
            'employee_id' => $employeeId,
            'leave_type' => 'سنوية',
            'duration_days' => 3,
            'start_date' => '2026-12-01',
            'reason' => 'طلب إجازة سنوية',
            'status' => 'معلقة',
        ])->assertRedirect('/vacations');

        $id = DB::table('vacations')->value('id');
        $this->assertDatabaseHas('vacations', [
            'id' => $id,
            'employee_id' => $employeeId,
            'start_date' => '2026-12-01',
            'end_date' => '2026-12-03',
            'status' => 'معلقة',
        ]);
        $this->get('/vacations')->assertOk()->assertSee('موظف إجازة')->assertSee('سنوية');
        $this->get("/vacations/{$id}/edit")->assertOk()->assertSee('تعديل إجازة');

        $this->put("/vacations/{$id}", [
            'employee_id' => $employeeId,
            'leave_type' => 'مرضية',
            'duration_days' => 7,
            'start_date' => '2026-12-10',
            'reason' => 'تقرير طبي',
            'status' => 'مقبولة',
        ])->assertRedirect('/vacations');

        $this->assertDatabaseHas('vacations', [
            'id' => $id,
            'leave_type' => 'مرضية',
            'start_date' => '2026-12-10',
            'end_date' => '2026-12-16',
            'status' => 'مقبولة',
        ]);

        $this->delete("/vacations/{$id}")->assertRedirect('/vacations');
        $this->assertDatabaseMissing('vacations', ['id' => $id]);
    }

    public function test_vacations_can_be_deleted_in_bulk_and_invalid_requests_are_rejected(): void
    {
        $employeeId = $this->insertEmployee('موظف طلبات');
        $vacationIds = [
            $this->insertVacation($employeeId),
            $this->insertVacation($employeeId),
        ];

        $this->delete('/vacations', ['ids' => $vacationIds])->assertRedirect('/vacations');
        foreach ($vacationIds as $id) {
            $this->assertDatabaseMissing('vacations', ['id' => $id]);
        }

        $this->from('/vacations/create')->post('/vacations', [
            'employee_id' => 999,
            'leave_type' => 'غير صالح',
            'duration_days' => 4,
            'start_date' => 'ليس تاريخًا',
            'status' => 'غير صالحة',
        ])->assertRedirect('/vacations/create')
            ->assertSessionHasErrors(['employee_id', 'leave_type', 'duration_days', 'start_date', 'status']);
    }

    private function insertEmployee(string $name): int
    {
        return DB::table('employee_models')->insertGetId([
            'name' => $name,
            'job_title' => 'محام',
            'country' => 'مصر',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function insertVacation(int $employeeId): int
    {
        return DB::table('vacations')->insertGetId([
            'employee_id' => $employeeId,
            'leave_type' => 'سنوية',
            'start_date' => '2026-12-01',
            'end_date' => '2026-12-01',
            'status' => 'معلقة',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
