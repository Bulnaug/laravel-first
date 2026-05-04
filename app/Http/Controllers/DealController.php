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

        return back();
    }

    public function board()
    {
        $deals = Deal::with('contact')->get();

        $grouped = $deals->groupBy('status');

        return view('deals.board', compact('grouped'));
    }
}