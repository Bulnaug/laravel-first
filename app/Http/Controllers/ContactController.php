<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $contacts = Contact::when($query, function ($q) use ($query) {
                $q->where(function ($sub) use ($query) {
                    $sub->where('name', 'like', "%$query%")
                        ->orWhere('email', 'like', "%$query%")
                        ->orWhere('phone', 'like', "%$query%");
                });
            })
            ->get();

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
        $contact->update($request->all());

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
