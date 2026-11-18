<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\{Lawyer, Branch, Contact, Employee, LegalCase, Task, Client, Consultation};
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    const DAYS = 10; // عدد الأيام المعروضة في الرسوم

    public function index()
    {
        $stats = [
            $this->stat('مجموع المحامين',        'user',  'المحامين',        Lawyer::query()),
            $this->stat('مجموع الوحدات التابعة', 'pin',   'الوحدات التابعة', Branch::query()),
            $this->stat('مجموع جهات الاتصال',    'phone', 'جهات الاتصال',    Contact::query()),
            $this->stat('مجموع الموظفون',        'clock', 'الموظفون',        Employee::query()),
            $this->stat('مجموع حالات الانتظار',  'clock', 'حالات الانتظار',  LegalCase::where('status', 'waiting')),
            $this->stat('مجموع القضايا المغلقة', 'clock', 'القضايا المغلقة', LegalCase::where('status', 'closed')),
            $this->stat('مجموع المهام المغلقة',  'clock', 'المهام المغلقة',  Task::where('status', 'closed')),
        ];

        $charts = [
            'labels' => collect(range(self::DAYS - 1, 0))
                ->map(fn ($i) => now()->subDays($i)->format('d/m'))->values(),

            'cases' => [
                'active' => $this->daily(LegalCase::where('status', 'active')),
                'closed' => $this->daily(LegalCase::where('status', 'closed')),
            ],

            'categories' => collect(['commercial', 'civil', 'administrative', 'criminal'])
                ->map(fn ($t) => LegalCase::where('category', $t)->count())->values(),

            'clients' => [
                'companies'   => $this->daily(Client::where('type', 'company')),
                'individuals' => $this->daily(Client::where('type', 'individual')),
            ],

            'consultations' => [
                'office'    => $this->daily(Consultation::where('type', 'office')),
                'phone'     => $this->daily(Consultation::where('type', 'phone')),
                'whatsapp'  => $this->daily(Consultation::where('type', 'whatsapp')),
                'complaint' => $this->daily(Consultation::where('type', 'complaint')),
            ],
        ];

        return view('dashboard', [
            'stats'  => $stats,
            'charts' => $charts,
            'from'   => now()->subDays(self::DAYS - 1),
            'to'     => now(),
        ]);
    }

    /** إجمالي + نسبة التغير عن الشهر الماضي */
    private function stat(string $title, string $icon, string $link, Builder $q): array
    {
        $now  = (clone $q)->count();
        $prev = (clone $q)->where('created_at', '<', now()->startOfMonth())->count();
        $pct  = $prev > 0 ? round((($now - $prev) / $prev) * 100, 1) : 0;

        return [
            'title' => $title, 'icon' => $icon, 'link' => $link, 'value' => $now,
            'note'  => $pct == 0 ? 'العدد ثابت'
                      : ($pct > 0 ? "+{$pct}% زيادة عن الشهر الماضي" : "{$pct}% عن الشهر الماضي"),
            'class' => $pct > 0 ? 'up' : ($pct < 0 ? 'down' : ''),
        ];
    }

    /** عدد السجلات في كل يوم من آخر DAYS يوم (الأيام الفاضية = 0) */
    private function daily(Builder $q): array
    {
        $start = now()->subDays(self::DAYS - 1)->startOfDay();

        $rows = $q->where('created_at', '>=', $start)
            ->selectRaw('DATE(created_at) as d, COUNT(*) as c')
            ->groupBy('d')->pluck('c', 'd');

        return collect(range(0, self::DAYS - 1))
            ->map(fn ($i) => (int) ($rows[$start->copy()->addDays($i)->toDateString()] ?? 0))
            ->all();
    }
}