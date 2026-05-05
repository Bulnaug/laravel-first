<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Contact;

class AnalyticsController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $dealsQuery = Deal::whereHas('contact', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });

        $totalDeals = $dealsQuery->count();
        $totalAmount = (clone $dealsQuery)->sum('amount');

        $wonAmount = (clone $dealsQuery)
            ->where('status', 'won')
            ->sum('amount');

        $pipelineAmount = (clone $dealsQuery)
            ->whereIn('status', ['new', 'in_progress'])
            ->sum('amount');

        $dealsByStatus = (clone $dealsQuery)
            ->selectRaw('status, count(*) as count, sum(amount) as total')
            ->groupBy('status')
            ->get();

        $topContacts = Contact::where('user_id', $userId)
            ->withSum('deals', 'amount')
            ->orderByDesc('deals_sum_amount')
            ->take(5)
            ->get();

        return view('analytics.index', compact(
            'totalDeals',
            'totalAmount',
            'wonAmount',
            'pipelineAmount',
            'dealsByStatus',
            'topContacts'
        ));
    }
}