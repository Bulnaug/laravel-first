<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        return view('history.index', compact('activities'));
    }
}
