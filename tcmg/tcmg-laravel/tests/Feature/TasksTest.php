<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TasksTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('task_models', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('clint_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('priority')->default('عادية');
            $table->string('status')->default('قيد التنفيذ');
            $table->date('due_date')->nullable();
            $table->string('country')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    public function test_task_list_and_create_form_are_available(): void
    {
        $this->get('/tasks')->assertOk()->assertSee('المهام و الأعمال');
        $this->get('/tasks/create')
            ->assertOk()
            ->assertSee('إضافة مهمة/عمل')
            ->assertSee('name="title"', false)
            ->assertSee('name="country"', false)
            ->assertSee('name="category"', false)
            ->assertSee('name="due_date"', false);
    }

    public function test_task_can_be_created_updated_and_deleted(): void
    {
        $this->post('/tasks', [
            'title' => 'إعداد مذكرة',
            'country' => 'مصر',
            'category' => 'قضايا',
            'due_date' => '2026-11-25',
        ])->assertRedirect('/tasks');

        $id = DB::table('task_models')->value('id');
        $this->assertDatabaseHas('task_models', [
            'id' => $id,
            'title' => 'إعداد مذكرة',
            'country' => 'مصر',
            'category' => 'قضايا',
            'status' => 'قيد التنفيذ',
        ]);
        $this->get('/tasks')->assertOk()->assertSee('إعداد مذكرة');

        $this->put("/tasks/{$id}", [
            'title' => 'مراجعة المذكرة',
            'country' => 'السعودية',
            'category' => 'عمل إداري',
            'due_date' => '2026-11-28',
            'status' => 'مكتملة',
        ])->assertRedirect('/tasks');

        $this->assertDatabaseHas('task_models', [
            'id' => $id,
            'title' => 'مراجعة المذكرة',
            'country' => 'السعودية',
            'category' => 'عمل إداري',
            'status' => 'مكتملة',
        ]);

        $this->delete("/tasks/{$id}")->assertRedirect('/tasks');
        $this->assertDatabaseMissing('task_models', ['id' => $id]);
    }

    public function test_task_fields_are_validated_and_tasks_can_be_bulk_deleted(): void
    {
        $this->from('/tasks/create')->post('/tasks', [
            'title' => '',
            'country' => 'بلد غير صالح',
            'category' => 'فئة غير صالحة',
            'due_date' => 'ليس تاريخاً',
        ])->assertRedirect('/tasks/create')
            ->assertSessionHasErrors(['title', 'country', 'category', 'due_date']);

        $ids = [];
        foreach (['مهمة أولى', 'مهمة ثانية'] as $title) {
            $ids[] = DB::table('task_models')->insertGetId([
                'title' => $title,
                'country' => 'مصر',
                'category' => 'جلسات',
                'status' => 'قيد التنفيذ',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->delete('/tasks', ['ids' => $ids])->assertRedirect('/tasks');
        $this->assertDatabaseMissing('task_models', ['id' => $ids[0]]);
        $this->assertDatabaseMissing('task_models', ['id' => $ids[1]]);
    }
}
