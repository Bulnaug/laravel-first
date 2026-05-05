<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $hasDeals = $request->input('has_deals');

        $contacts = Contact::where('user_id', auth()->id())

            // 🔍 поиск
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                });
            })

            // 🔥 фильтр по сделкам
            ->when($hasDeals === 'yes', function ($q) {
                $q->has('deals');
            })

            ->when($hasDeals === 'no', function ($q) {
                $q->doesntHave('deals');
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_id' => auth()->id(),
        ]);
        return redirect('/contacts');
    }

    public function edit($id)
    {
        $contact = Contact::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        $contact->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect('/contacts');
    }
    public function destroy($id)
    {
        $contact = Contact::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        $contact->delete();

        return redirect('/contacts');
    }
    public function show($id)
    {
        $contact = Contact::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('contacts.show', compact('contact'));
    }
}
