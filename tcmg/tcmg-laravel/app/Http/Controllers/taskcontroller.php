<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Taskcontroller extends Controller
{
    private const COUNTRIES = ['مصر', 'السعودية', 'البحرين', 'قطر', 'عمان', 'الإمارات', 'الكويت'];

    private const CATEGORIES = ['قضايا', 'جلسات', 'عمل إداري', 'اجتماعات', 'أخرى'];

    private const STATUSES = ['قيد التنفيذ', 'مكتملة', 'متوقفة'];

    public function index(Request $request)
    {
        $tasks = DB::table('task_models')
            ->when($request->filled('q'), function ($query) use ($request): void {
                $search = $request->string('q')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('country', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->when(
                in_array($request->input('category'), self::CATEGORIES, true),
                fn ($query) => $query->where('category', $request->input('category'))
            )
            ->when(
                in_array($request->input('status'), self::STATUSES, true),
                fn ($query) => $query->where('status', $request->input('status'))
            )
            ->orderByDesc('id')
            ->paginate(8)
            ->withQueryString();

        $to = now();
        $from = $to->copy()->subDays(9)->startOfDay();
        $days = collect(range(0, 9))->map(fn (int $offset) => $from->copy()->addDays($offset));
        $dailyRows = DB::table('task_models')
            ->selectRaw('DATE(created_at) as day, status, COUNT(*) as total')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('day', 'status')
            ->get();
        $totalTasks = DB::table('task_models')->count();
        $completedTasks = DB::table('task_models')->where('status', 'مكتملة')->count();

        $charts = [
            'labels' => $days->map(fn ($day) => $day->format('j/n'))->all(),
            'active' => $days->map(fn ($day) => (int) $dailyRows
                ->filter(fn ($row) => $row->day === $day->toDateString()
                    && $row->status === 'قيد التنفيذ')
                ->sum('total'))->all(),
            'completed' => $days->map(fn ($day) => (int) $dailyRows
                ->filter(fn ($row) => $row->day === $day->toDateString()
                    && $row->status === 'مكتملة')
                ->sum('total'))->all(),
            'total' => $days->map(fn ($day) => (int) $dailyRows
                ->where('day', $day->toDateString())
                ->sum('total'))->all(),
            'completionRate' => $totalTasks === 0 ? 0 : (int) round(($completedTasks / $totalTasks) * 100),
        ];

        return view('tasks.index', [
            'tasks' => $tasks,
            'charts' => $charts,
            'categories' => self::CATEGORIES,
            'statuses' => self::STATUSES,
        ]);
    }

    public function create()
    {
        return view('tasks.form', $this->formData(null));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $now = now();

        DB::table('task_models')->insert($validated + [
            'status' => 'قيد التنفيذ',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->route('tasks.index')->with('success', 'تم حفظ المهمة بنجاح.');
    }

    public function edit(int $task)
    {
        $record = DB::table('task_models')->find($task);
        abort_if($record === null, 404);

        return view('tasks.form', $this->formData($record));
    }

    public function update(Request $request, int $task)
    {
        abort_unless(DB::table('task_models')->where('id', $task)->exists(), 404);
        $validated = $request->validate($this->rules(true));

        DB::table('task_models')->where('id', $task)->update($validated + [
            'updated_at' => now(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'تم تحديث المهمة بنجاح.');
    }

    public function destroy(int $task)
    {
        abort_unless(DB::table('task_models')->where('id', $task)->exists(), 404);
        DB::table('task_models')->where('id', $task)->delete();

        return redirect()->route('tasks.index')->with('success', 'تم حذف المهمة.');
    }

    public function destroyMany(Request $request)
    {
        $ids = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', Rule::exists('task_models', 'id')],
        ])['ids'];

        DB::table('task_models')->whereIn('id', $ids)->delete();

        return redirect()->route('tasks.index')->with('success', 'تم حذف المهام المحددة.');
    }

    private function formData(?object $task): array
    {
        return [
            'taskRecord' => $task,
            'countries' => self::COUNTRIES,
            'categories' => self::CATEGORIES,
            'statuses' => self::STATUSES,
        ];
    }

    private function rules(bool $updating = false): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', Rule::in(self::COUNTRIES)],
            'category' => ['required', 'string', Rule::in(self::CATEGORIES)],
            'due_date' => ['required', 'date'],
        ];

        if ($updating) {
            $rules['status'] = ['required', 'string', Rule::in(self::STATUSES)];
        }

        return $rules;
    }
}
