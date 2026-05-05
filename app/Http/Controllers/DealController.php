<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Contact;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function store(Request $request, Contact $contact)
    {
        $contact->deals()->create([
            'title' => $request->title,
            'amount' => $request->amount,
        ]);

        return back();
    }

    public function updateStatus(Request $request, Deal $deal)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,won,lost'
        ]);

        $deal->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => true]);
    }

    public function board()
    {
        $search = request('search');
        $contactId = request('contact_id');

        $query = Deal::with('contact');

        // 🔍 поиск
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        // 👤 фильтр по клиенту
        if ($contactId) {
            $query->where('contact_id', $contactId);
        }

        $deals = $query->get();

        $grouped = $deals->groupBy('status');

        $totalDeals = $deals->count();

        // для select
        $contacts = Contact::all();

        return view('deals.board', compact('grouped', 'contacts'));
    }

    public function move(Request $request, Deal $deal)
    {

        $request->validate([
            'status' => 'required|in:new,in_progress,won,lost',
        ]);

        $deal->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => true]);
    }
}