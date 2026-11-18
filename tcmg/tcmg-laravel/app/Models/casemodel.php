<?php

namespace App\Http\Controllers;

use App\Models\casemodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseController extends Controller
{
    public function index()
    {
        // جلب جميع العملاء والقضايا
        $clients = DB::table('clints')->get();
        $cases = DB::table('casemodels')
            ->join('clints', 'casemodels.clint_id', '=', 'clints.id')
            ->select('casemodels.*', 'clints.name as client_name')
            ->get();

        return view('cases', compact('clients', 'cases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'clint_id' => 'required',
            'case_number' => 'required',
            'court_name' => 'required',
        ]);

        DB::table('casemodels')->insert([
            'clint_id' => $request->clint_id,
            'case_number' => $request->case_number,
            'court_name' => $request->court_name,
            'case_type' => $request->case_type,
            'session_date' => $request->session_date,
            'details' => $request->details,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تم حفظ القضية بنجاح!');
    }
}
