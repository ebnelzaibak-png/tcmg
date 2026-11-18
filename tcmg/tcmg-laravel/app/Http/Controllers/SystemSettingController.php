<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SystemSettingController extends Controller
{
    private const DEFAULTS = [
        'language' => 'ar',
        'table_style' => 'classic',
        'date_format' => 'd/m/Y',
        'currency' => 'EGP',
        'timezone' => 'Africa/Cairo',
    ];

    private const OPTIONS = [
        'language' => [
            'ar' => 'العربية',
            'en' => 'English',
        ],
        'table_style' => [
            'classic' => 'كلاسيكي',
            'striped' => 'مخطط',
            'compact' => 'مدمج',
        ],
        'date_format' => [
            'd/m/Y' => 'يوم / شهر / سنة (16/11/2026)',
            'Y-m-d' => 'سنة - شهر - يوم (2026-11-16)',
            'd-m-Y' => 'يوم - شهر - سنة (16-11-2026)',
        ],
        'currency' => [
            'EGP' => 'جنيه مصري (EGP)',
            'SAR' => 'ريال سعودي (SAR)',
            'AED' => 'درهم إماراتي (AED)',
            'USD' => 'دولار أمريكي (USD)',
        ],
        'timezone' => [
            'Africa/Cairo' => 'القاهرة (Africa/Cairo)',
            'Asia/Riyadh' => 'الرياض (Asia/Riyadh)',
            'Asia/Dubai' => 'دبي (Asia/Dubai)',
            'UTC' => 'التوقيت العالمي (UTC)',
        ],
    ];

    private const SECTIONS = [
        'language' => [
            'field' => 'language',
            'title' => 'اللغة',
        ],
        'table_style' => [
            'field' => 'table_style',
            'title' => 'مظهر الجدول',
        ],
        'date_format' => [
            'field' => 'date_format',
            'title' => 'تنسيق التاريخ',
        ],
        'currency' => [
            'field' => 'currency',
            'title' => 'العملة',
        ],
        'timezone' => [
            'field' => 'timezone',
            'title' => 'المنطقة الزمنية',
        ],
    ];

    public function index()
    {
        $settings = array_merge(
            self::DEFAULTS,
            DB::table('system_settings')->pluck('value', 'key')->all()
        );

        return view('settings.index', [
            'settings' => $settings,
            'options' => self::OPTIONS,
            'sections' => self::SECTIONS,
        ]);
    }

    public function update(Request $request)
    {
        $section = $request->validate([
            'section' => ['required', Rule::in(array_keys(self::SECTIONS))],
        ])['section'];
        $field = self::SECTIONS[$section]['field'];
        $value = $request->validate([
            $field => ['required', 'string', Rule::in(array_keys(self::OPTIONS[$field]))],
        ])[$field];

        DB::table('system_settings')->updateOrInsert(
            ['key' => $field],
            ['value' => $value, 'updated_at' => now(), 'created_at' => now()]
        );

        return redirect()->route('settings.index')
            ->with('success', 'تم حفظ إعداد ' . self::SECTIONS[$section]['title'] . ' بنجاح.');
    }
}
