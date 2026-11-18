<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EmployeesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('employee_models', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('job_title');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->date('hire_date')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->string('country')->nullable();
            $table->string('salary_type')->nullable();
            $table->timestamps();
        });
        Schema::create('employee_attendances', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('attendance_date');
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->string('status')->default('حاضر');
            $table->timestamps();
        });
        Schema::create('permissions', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('module_name');
            $table->boolean('can_view')->default(true);
            $table->boolean('can_add')->default(false);
            $table->boolean('can_edit')->default(false);
            $table->boolean('can_delete')->default(false);
            $table->timestamps();
        });
    }

    public function test_employee_page_and_form_are_available(): void
    {
        $this->get('/employees')->assertOk()->assertSee('قائمة الموارد البشرية')->assertSee('تسجيل الحضور والانصراف');
        $this->get('/employees/create')
            ->assertOk()
            ->assertSee('إضافة موظف/محامي')
            ->assertSee('name="age"', false)
            ->assertSee('name="country"', false)
            ->assertSee('name="job_title"', false)
            ->assertSee('name="salary_type"', false);
    }

    public function test_employee_can_be_created_updated_and_deleted(): void
    {
        $this->post('/employees', [
            'name' => 'موظف اختبار',
            'age' => '32',
            'email' => 'employee@example.test',
            'phone' => '01000000000',
            'job_title' => 'محامي',
            'country' => 'مصر',
            'hire_date' => '2026-10-01',
            'salary' => '12500',
            'salary_type' => 'شهريًا',
        ])->assertRedirect('/employees');

        $id = DB::table('employee_models')->value('id');
        $this->assertDatabaseHas('employee_models', [
            'id' => $id,
            'name' => 'موظف اختبار',
            'job_title' => 'محامي',
            'country' => 'مصر',
            'salary_type' => 'شهريًا',
        ]);
        $this->get('/employees')->assertOk()->assertSee('موظف اختبار');

        $this->put("/employees/{$id}", [
            'name' => 'موظف معدل',
            'age' => '33',
            'email' => '',
            'phone' => '01111111111',
            'job_title' => 'مدير',
            'country' => 'السعودية',
            'hire_date' => '2026-10-02',
            'salary' => '15000',
            'salary_type' => 'سنويًا',
        ])->assertRedirect('/employees');

        $this->assertDatabaseHas('employee_models', [
            'id' => $id,
            'name' => 'موظف معدل',
            'job_title' => 'مدير',
            'country' => 'السعودية',
            'salary_type' => 'سنويًا',
        ]);

        $this->insertPermission($id);
        $this->delete("/employees/{$id}")->assertRedirect('/employees');
        $this->assertDatabaseMissing('employee_models', ['id' => $id]);
        $this->assertDatabaseMissing('permissions', ['employee_id' => $id]);

        $bulkId = $this->insertEmployee('موظف للحذف الجماعي');
        $this->insertPermission($bulkId);
        $this->delete('/employees', ['ids' => [$bulkId]])->assertRedirect('/employees');
        $this->assertDatabaseMissing('employee_models', ['id' => $bulkId]);
        $this->assertDatabaseMissing('permissions', ['employee_id' => $bulkId]);
    }

    public function test_attendance_records_support_create_update_delete_and_bulk_delete(): void
    {
        $employeeId = $this->insertEmployee('موظف حضور');

        $this->post('/employee-attendances', [
            'employee_id' => $employeeId,
            'attendance_date' => '2026-11-16',
            'check_in' => '08:30',
            'check_out' => '16:30',
            'status' => 'حاضر',
        ])->assertRedirect('/employees');

        $id = DB::table('employee_attendances')->value('id');
        $this->assertDatabaseHas('employee_attendances', [
            'id' => $id,
            'employee_id' => $employeeId,
            'status' => 'حاضر',
        ]);
        $this->get('/employees')->assertOk()->assertSee('موظف حضور');

        $this->put("/employee-attendances/{$id}", [
            'employee_id' => $employeeId,
            'attendance_date' => '2026-11-16',
            'check_in' => '09:00',
            'check_out' => '17:00',
            'status' => 'متأخر',
        ])->assertRedirect('/employees');
        $this->assertDatabaseHas('employee_attendances', [
            'id' => $id,
            'check_in' => '09:00',
            'status' => 'متأخر',
        ]);

        $this->delete("/employee-attendances/{$id}")->assertRedirect('/employees');
        $this->assertDatabaseMissing('employee_attendances', ['id' => $id]);

        $bulkId = DB::table('employee_attendances')->insertGetId([
            'employee_id' => $employeeId,
            'attendance_date' => '2026-11-17',
            'status' => 'حاضر',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->delete('/employee-attendances', ['ids' => [$bulkId]])->assertRedirect('/employees');
        $this->assertDatabaseMissing('employee_attendances', ['id' => $bulkId]);
    }

    public function test_employee_and_attendance_fields_are_validated(): void
    {
        $this->from('/employees/create')->post('/employees', [
            'name' => '',
            'age' => '12',
            'email' => 'not-an-email',
            'phone' => '',
            'job_title' => 'دور غير صالح',
            'country' => 'بلد غير صالح',
            'hire_date' => 'ليس تاريخًا',
            'salary' => '-1',
            'salary_type' => 'نظام غير صالح',
        ])->assertRedirect('/employees/create')
            ->assertSessionHasErrors(['name', 'age', 'email', 'phone', 'job_title', 'country', 'hire_date', 'salary', 'salary_type']);

        $this->post('/employee-attendances', [
            'employee_id' => 999,
            'attendance_date' => 'not-a-date',
            'check_in' => 'not-a-time',
            'status' => 'حالة غير صالحة',
        ])->assertSessionHasErrors(['employee_id', 'attendance_date', 'check_in', 'status']);
    }

    private function insertEmployee(string $name): int
    {
        return DB::table('employee_models')->insertGetId([
            'name' => $name,
            'job_title' => 'موظف',
            'phone' => '01000000000',
            'country' => 'مصر',
            'hire_date' => '2026-01-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function insertPermission(int $employeeId): void
    {
        DB::table('permissions')->insert([
            'employee_id' => $employeeId,
            'module_name' => 'العملاء',
            'can_view' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
