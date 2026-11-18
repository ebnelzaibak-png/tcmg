<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_dashboard_renders_without_optional_data_tables(): void
    {
        $this->get('/dashboard')
            ->assertOk()
            ->assertSee('القضايا والجلسات')
            ->assertSee('لا توجد بيانات');
    }

    public function test_dashboard_uses_existing_case_client_and_consultation_data(): void
    {
        Schema::create('casemodels', function (Blueprint $table): void {
            $table->id();
            $table->string('case_type')->nullable();
            $table->date('session_date')->nullable();
            $table->timestamps();
        });
        Schema::create('clints', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->timestamps();
        });
        Schema::create('consultations', function (Blueprint $table): void {
            $table->id();
            $table->string('status')->default('قيد الدراسة');
            $table->timestamps();
        });

        $now = now();
        DB::table('casemodels')->insert([
            'case_type' => 'تجارية',
            'session_date' => $now->toDateString(),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('clints')->insert([
            'name' => 'عميل اختبار',
            'phone' => '01000000000',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('consultations')->insert([
            'status' => 'مغلقة',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->get('/dashboard')
            ->assertOk()
            ->assertSee('تجارية')
            ->assertSee('مغلقة')
            ->assertDontSee('لا توجد بيانات');
    }
}
