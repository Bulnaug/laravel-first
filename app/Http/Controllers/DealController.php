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
            'notes' => $request->notes,
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
        $min = request('min_amount');
        $max = request('max_amount');

        $query = Deal::with('contact')
            ->whereHas('contact', function ($q) {
                $q->where('user_id', auth()->id());
            });

        // 🔍 поиск
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        // 👤 фильтр по клиенту
        if ($contactId) {
            $query->where('contact_id', $contactId);
        }

        // 💰 фильтр по сумме
        if ($min !== null && $min !== '') {
            $query->where('amount', '>=', $min);
        }

        if ($max !== null && $max !== '') {
            $query->where('amount', '<=', $max);
        }

        $deals = $query->get();

        $grouped = $deals->groupBy('status');

        $contacts = Contact::where('user_id', auth()->id())->get();

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

    public function updateNotes(Request $request, Deal $deal)
    {
        if ($deal->contact->user_id !== auth()->id()) {
            abort(403);
        }

        $deal->update([
            'notes' => $request->notes
        ]);

        return back();
    }
}