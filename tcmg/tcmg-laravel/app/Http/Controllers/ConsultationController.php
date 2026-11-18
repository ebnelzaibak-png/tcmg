<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ConsultationController extends Controller
{
    private const TYPES = ['مكتبية', 'هاتفية', 'عبر واتس آب', 'شكوى'];

    private const SPECIALIZATIONS = ['مدني', 'تجاري', 'جنائي', 'إداري', 'أحوال شخصية', 'عمالي', 'عقاري', 'شركات', 'أخرى'];

    private const STATUSES = ['قيد الدراسة', 'تم الرد', 'مغلقة'];

    private const COUNTRIES = ['مصر', 'السعودية', 'البحرين', 'قطر', 'عمان', 'الإمارات', 'الكويت'];

    public function index(Request $request)
    {
        $consultations = DB::table('consultations')
            ->leftJoin('clints', 'consultations.clint_id', '=', 'clints.id')
            ->when($request->filled('q'), function ($query) use ($request): void {
                $search = $request->string('q')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('clints.name', 'like', "%{$search}%")
                        ->orWhere('clints.phone', 'like', "%{$search}%")
                        ->orWhere('consultations.lawyer_name', 'like', "%{$search}%")
                        ->orWhere('consultations.specialization', 'like', "%{$search}%")
                        ->orWhere('consultations.subject', 'like', "%{$search}%")
                        ->orWhere('consultations.country', 'like', "%{$search}%");
                });
            })
            ->when(
                in_array($request->input('type'), self::TYPES, true),
                fn ($query) => $query->where('consultations.consultation_type', $request->input('type'))
            )
            ->when(
                in_array($request->input('status'), self::STATUSES, true),
                fn ($query) => $query->where('consultations.status', $request->input('status'))
            )
            ->select(
                'consultations.*',
                'clints.name as client_name',
                'clints.phone as client_phone',
                'clints.email as client_email',
                'clints.nationality as client_country'
            )
            ->orderByDesc('consultations.id')
            ->paginate(8)
            ->withQueryString();

        $to = now();
        $from = $to->copy()->subDays(9)->startOfDay();
        $days = collect(range(0, 9))->map(
            fn (int $offset) => $from->copy()->addDays($offset)
        );
        $dailyRows = DB::table('consultations')
            ->selectRaw('DATE(consultation_date) as day, COUNT(*) as total')
            ->whereBetween('consultation_date', [$from->toDateString(), $to->toDateString()])
            ->groupBy('day')
            ->pluck('total', 'day');
        $typeRows = DB::table('consultations')
            ->select('consultation_type')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('consultation_type')
            ->pluck('total', 'consultation_type');

        return view('consultations.index', [
            'consultations' => $consultations,
            'types' => self::TYPES,
            'statuses' => self::STATUSES,
            'charts' => [
                'labels' => $days->map(fn ($day) => $day->format('j/n'))->all(),
                'daily' => $days->map(
                    fn ($day) => (int) ($dailyRows[$day->toDateString()] ?? 0)
                )->all(),
                'typeLabels' => self::TYPES,
                'typeValues' => array_map(
                    fn (string $type) => (int) ($typeRows[$type] ?? 0),
                    self::TYPES
                ),
            ],
        ]);
    }

    public function create()
    {
        return view('consultations.form', $this->formData(null));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $now = now();

        DB::table('consultations')->insert([
            'clint_id' => $validated['clint_id'],
            'subject' => $validated['specialization'],
            'details' => $validated['details'],
            'legal_opinion' => null,
            'consultation_type' => $validated['consultation_type'],
            'specialization' => $validated['specialization'],
            'lawyer_name' => $validated['lawyer_name'],
            'consultation_date' => $validated['consultation_date'],
            'consultation_time' => $validated['consultation_time'],
            'price' => $validated['price'],
            'country' => $validated['country'],
            'status' => 'قيد الدراسة',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->route('consultations.index')->with('success', 'تم حفظ الاستشارة القانونية بنجاح.');
    }

    public function edit(int $consultation)
    {
        $record = DB::table('consultations')->find($consultation);
        abort_if($record === null, 404);

        return view('consultations.form', $this->formData($record));
    }

    public function update(Request $request, int $consultation)
    {
        abort_unless(DB::table('consultations')->where('id', $consultation)->exists(), 404);
        $validated = $request->validate($this->rules(true));

        DB::table('consultations')->where('id', $consultation)->update([
            'clint_id' => $validated['clint_id'],
            'subject' => $validated['specialization'],
            'details' => $validated['details'],
            'consultation_type' => $validated['consultation_type'],
            'specialization' => $validated['specialization'],
            'lawyer_name' => $validated['lawyer_name'],
            'consultation_date' => $validated['consultation_date'],
            'consultation_time' => $validated['consultation_time'],
            'price' => $validated['price'],
            'country' => $validated['country'],
            'status' => $validated['status'],
            'updated_at' => now(),
        ]);

        return redirect()->route('consultations.index')->with('success', 'تم تحديث الاستشارة القانونية بنجاح.');
    }

    public function destroy(int $consultation)
    {
        abort_unless(DB::table('consultations')->where('id', $consultation)->exists(), 404);
        DB::table('consultations')->where('id', $consultation)->delete();

        return redirect()->route('consultations.index')->with('success', 'تم حذف الاستشارة القانونية.');
    }

    public function destroyMany(Request $request)
    {
        $ids = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', Rule::exists('consultations', 'id')],
        ])['ids'];

        DB::table('consultations')->whereIn('id', $ids)->delete();

        return redirect()->route('consultations.index')->with('success', 'تم حذف الاستشارات المحددة.');
    }

    private function formData(?object $consultation): array
    {
        $client = $consultation === null
            ? null
            : DB::table('clints')->find($consultation->clint_id);

        return [
            'consultationRecord' => $consultation,
            'clients' => DB::table('clints')
                ->select('id', 'name', 'phone', 'email', 'nationality')
                ->orderBy('name')
                ->get(),
            'selectedClient' => $client,
            'types' => self::TYPES,
            'specializations' => self::SPECIALIZATIONS,
            'statuses' => self::STATUSES,
            'countries' => self::COUNTRIES,
        ];
    }

    private function rules(bool $updating = false): array
    {
        $rules = [
            'clint_id' => ['required', 'integer', Rule::exists('clints', 'id')],
            'consultation_type' => ['required', 'string', Rule::in(self::TYPES)],
            'specialization' => ['required', 'string', Rule::in(self::SPECIALIZATIONS)],
            'lawyer_name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', Rule::in(self::COUNTRIES)],
            'consultation_date' => ['required', 'date'],
            'consultation_time' => ['required', 'date_format:H:i'],
            'price' => ['required', 'numeric', 'min:0', 'max:9999999999'],
            'details' => ['required', 'string', 'max:10000'],
        ];

        if ($updating) {
            $rules['status'] = ['required', 'string', Rule::in(self::STATUSES)];
        }

        return $rules;
    }
}
