<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        $settings = DB::table('settings')->first();

        if (!$settings) {
            DB::table('settings')->insert([
                'language' => 'ar',
                'date_format' => 'Y-m-d',
                'currency' => 'EGP',
                'timezone' => 'Africa/Cairo',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $settings = DB::table('settings')->first();
        }

        return view('settings', compact('settings'));
    }

    public function update(Request $request)
    {
        DB::table('settings')->where('id', 1)->update([
            'language' => $request->language,
            'date_format' => $request->date_format,
            'currency' => $request->currency,
            'timezone' => $request->timezone,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تم حفظ إعدادات النظام بنجاح!');
    }
}