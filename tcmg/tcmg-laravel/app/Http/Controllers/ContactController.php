<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    private const COUNTRIES = ['مصر', 'السعودية', 'الإمارات'];

    private const CATEGORIES = ['عميل', 'محامي'];

    public function index(Request $request)
    {
        $contacts = DB::table('contact_models')
            ->when($request->filled('q'), function ($query) use ($request): void {
                $search = $request->string('q')->trim()->toString();
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when(
                in_array($request->input('category'), self::CATEGORIES, true),
                fn ($query) => $query->where('category', $request->input('category'))
            )
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $promotions = DB::table('promotion_contacts')->orderByDesc('id')->get();
        $meetings = DB::table('meetings')->orderBy('meeting_at')->get();

        return view('contacts', compact('contacts', 'promotions', 'meetings'));
    }

    public function create()
    {
        return view('contacts.form', [
            'contact' => null,
            'countries' => self::COUNTRIES,
            'categories' => self::CATEGORIES,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());
        $now = now();

        DB::table('contact_models')->insert($validated + [
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->route('contacts.index')->with('success', 'تمت إضافة جهة الاتصال بنجاح.');
    }

    public function edit(int $contact)
    {
        $record = DB::table('contact_models')->find($contact);
        abort_if($record === null, 404);

        return view('contacts.form', [
            'contact' => $record,
            'countries' => self::COUNTRIES,
            'categories' => self::CATEGORIES,
        ]);
    }

    public function update(Request $request, int $contact)
    {
        abort_unless(DB::table('contact_models')->where('id', $contact)->exists(), 404);

        DB::table('contact_models')->where('id', $contact)->update(
            $request->validate($this->rules()) + ['updated_at' => now()]
        );

        return redirect()->route('contacts.index')->with('success', 'تم تحديث جهة الاتصال بنجاح.');
    }

    public function destroy(int $contact)
    {
        abort_unless(DB::table('contact_models')->where('id', $contact)->exists(), 404);

        DB::table('contact_models')->where('id', $contact)->delete();

        return redirect()->route('contacts.index')->with('success', 'تم حذف جهة الاتصال.');
    }

    public function storePromotion(Request $request)
    {
        $validated = $request->validateWithBag('promotion', [
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', Rule::in(self::COUNTRIES)],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);
        $now = now();

        DB::table('promotion_contacts')->insert($validated + [
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->route('contacts.index')->with('success', 'تمت الإضافة إلى قائمة الترويج.');
    }

    public function updatePromotion(Request $request, int $promotionContact)
    {
        abort_unless(DB::table('promotion_contacts')->where('id', $promotionContact)->exists(), 404);

        DB::table('promotion_contacts')->where('id', $promotionContact)->update(
            $request->validateWithBag('promotion', [
                'name' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', Rule::in(self::COUNTRIES)],
                'phone' => ['required', 'string', 'max:50'],
                'email' => ['nullable', 'email', 'max:255'],
            ]) + ['updated_at' => now()]
        );

        return redirect()->route('contacts.index')->with('success', 'تم تحديث بيانات قائمة الترويج.');
    }

    public function destroyPromotion(int $promotionContact)
    {
        abort_unless(DB::table('promotion_contacts')->where('id', $promotionContact)->exists(), 404);

        DB::table('promotion_contacts')->where('id', $promotionContact)->delete();

        return redirect()->route('contacts.index')->with('success', 'تم الحذف من قائمة الترويج.');
    }

    public function destroyPromotions(Request $request)
    {
        $ids = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', Rule::exists('promotion_contacts', 'id')],
        ])['ids'];

        DB::table('promotion_contacts')->whereIn('id', $ids)->delete();

        return redirect()->route('contacts.index')->with('success', 'تم حذف العناصر المحددة من قائمة الترويج.');
    }

    public function storeMeeting(Request $request)
    {
        $validated = $request->validateWithBag('meeting', [
            'title' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', Rule::in(self::COUNTRIES)],
            'meeting_at' => ['required', 'date_format:Y-m-d\TH:i'],
        ]);
        $now = now();

        DB::table('meetings')->insert([
            'title' => $validated['title'],
            'country' => $validated['country'],
            'meeting_at' => Carbon::createFromFormat('Y-m-d\TH:i', $validated['meeting_at'])->format('Y-m-d H:i:s'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->route('contacts.index')->with('success', 'تمت إضافة الاجتماع بنجاح.');
    }

    public function updateMeeting(Request $request, int $meeting)
    {
        abort_unless(DB::table('meetings')->where('id', $meeting)->exists(), 404);

        $validated = $request->validateWithBag('meeting', [
            'title' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', Rule::in(self::COUNTRIES)],
            'meeting_at' => ['required', 'date_format:Y-m-d\TH:i'],
        ]);

        DB::table('meetings')->where('id', $meeting)->update([
            'title' => $validated['title'],
            'country' => $validated['country'],
            'meeting_at' => Carbon::createFromFormat('Y-m-d\TH:i', $validated['meeting_at'])->format('Y-m-d H:i:s'),
            'updated_at' => now(),
        ]);

        return redirect()->route('contacts.index')->with('success', 'تم تحديث الاجتماع بنجاح.');
    }

    public function destroyMeeting(int $meeting)
    {
        abort_unless(DB::table('meetings')->where('id', $meeting)->exists(), 404);

        DB::table('meetings')->where('id', $meeting)->delete();

        return redirect()->route('contacts.index')->with('success', 'تم حذف الاجتماع.');
    }

    public function destroyMeetings(Request $request)
    {
        $ids = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', Rule::exists('meetings', 'id')],
        ])['ids'];

        DB::table('meetings')->whereIn('id', $ids)->delete();

        return redirect()->route('contacts.index')->with('success', 'تم حذف الاجتماعات المحددة.');
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', Rule::in(self::COUNTRIES)],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'category' => ['required', 'string', Rule::in(self::CATEGORIES)],
        ];
    }
}