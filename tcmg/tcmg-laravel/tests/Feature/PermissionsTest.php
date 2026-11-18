<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PermissionsTest extends TestCase
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

    public function test_permissions_list_and_employee_permission_form_are_available(): void
    {
        $this->get('/permissions')
            ->assertOk()
            ->assertSee('صلاحيات الدخول')
            ->assertSee('لا توجد صلاحيات مسجلة');

        $this->get('/permissions/create')
            ->assertOk()
            ->assertSee('إضافة موظف/محامي')
            ->assertSee('name="name"', false)
            ->assertSee('name="country"', false)
            ->assertSee('name="modules[]"', false)
            ->assertSee('الاستشارات القانونية');
    }

    public function test_employee_and_module_permissions_can_be_created_updated_and_revoked(): void
    {
        $this->post('/permissions', $this->employeeData([
            'العملاء',
            'القضايا',
        ]))->assertRedirect('/permissions');

        $employeeId = DB::table('employee_models')->value('id');
        $this->assertDatabaseHas('employee_models', [
            'id' => $employeeId,
            'name' => 'موظف صلاحيات',
            'country' => 'مصر',
            'job_title' => 'محامي',
        ]);
        $this->assertSame(11, DB::table('permissions')->where('employee_id', $employeeId)->count());
        $this->assertDatabaseHas('permissions', [
            'employee_id' => $employeeId,
            'module_name' => 'العملاء',
            'can_view' => true,
            'can_add' => true,
            'can_edit' => true,
            'can_delete' => true,
        ]);
        $this->assertDatabaseHas('permissions', [
            'employee_id' => $employeeId,
            'module_name' => 'المحكمة',
            'can_view' => false,
        ]);
        $this->get('/permissions')
            ->assertOk()
            ->assertSee('موظف صلاحيات')
            ->assertSee('العملاء')
            ->assertSee('القضايا');
        $this->get("/permissions/{$employeeId}/edit")
            ->assertOk()
            ->assertSee('تعديل موظف/محامي');

        $updated = $this->employeeData(['الموارد البشرية']);
        $updated['name'] = 'موظف معدل';
        $updated['country'] = 'السعودية';
        $updated['job_title'] = 'مدير';
        $this->put("/permissions/{$employeeId}", $updated)->assertRedirect('/permissions');

        $this->assertDatabaseHas('employee_models', [
            'id' => $employeeId,
            'name' => 'موظف معدل',
            'country' => 'السعودية',
            'job_title' => 'مدير',
        ]);
        $this->assertSame(1, DB::table('permissions')
            ->where('employee_id', $employeeId)
            ->where('can_view', true)
            ->count());
        $this->assertDatabaseHas('permissions', [
            'employee_id' => $employeeId,
            'module_name' => 'الموارد البشرية',
            'can_view' => true,
        ]);

        $this->delete("/permissions/{$employeeId}")->assertRedirect('/permissions');
        $this->assertDatabaseMissing('permissions', ['employee_id' => $employeeId]);
        $this->assertDatabaseHas('employee_models', ['id' => $employeeId]);
    }

    public function test_permission_profiles_can_be_bulk_revoked_and_fields_are_validated(): void
    {
        $ids = [];
        foreach (['موظف أول', 'موظف ثان'] as $name) {
            $data = $this->employeeData(['العملاء']);
            $data['name'] = $name;
            $this->post('/permissions', $data)->assertRedirect('/permissions');
            $ids[] = DB::table('employee_models')->where('name', $name)->value('id');
        }

        $this->delete('/permissions', ['ids' => $ids])->assertRedirect('/permissions');
        foreach ($ids as $id) {
            $this->assertDatabaseMissing('permissions', ['employee_id' => $id]);
            $this->assertDatabaseHas('employee_models', ['id' => $id]);
        }

        $invalid = $this->employeeData(['قسم غير صالح']);
        $invalid['name'] = '';
        $invalid['age'] = 12;
        $invalid['country'] = 'بلد غير صالح';
        $invalid['job_title'] = 'دور غير صالح';
        $invalid['hire_date'] = 'تاريخ غير صحيح';
        $invalid['email'] = 'بريد غير صالح';
        $this->from('/permissions/create')->post('/permissions', $invalid)
            ->assertRedirect('/permissions/create')
            ->assertSessionHasErrors(['name', 'age', 'country', 'job_title', 'hire_date', 'email', 'modules.0']);
    }

    private function employeeData(array $modules): array
    {
        return [
            'name' => 'موظف صلاحيات',
            'age' => 32,
            'email' => 'permissions@example.test',
            'phone' => '01012345678',
            'job_title' => 'محامي',
            'country' => 'مصر',
            'hire_date' => '2026-11-16',
            'modules' => $modules,
        ];
    }
}
