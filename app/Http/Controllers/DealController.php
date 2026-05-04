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
}