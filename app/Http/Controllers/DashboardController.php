<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Deal;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'contactsCount' => Contact::count(),
            'dealsCount' => Deal::count(),
            'wonAmount' => Deal::where('status', 'won')->sum('amount'),
            'pipelineAmount' => Deal::whereIn('status', ['new', 'in_progress'])->sum('amount'),
            'latestContacts' => Contact::latest()->take(5)->get(),
            'latestDeals' => Deal::with('contact')->latest()->take(5)->get(),
        ]);
    }
}