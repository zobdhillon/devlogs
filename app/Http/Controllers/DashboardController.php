<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $hour = now()->hour;
        $greeting = $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening');

        $stats = [
            'topics'    => $user->topics()->where('status', 'active')->count(),
            'logs'      => $user->logs()->count(),
            'goals'     => $user->goals()->count(),
            'resources' => $user->resources()->count(),
        ];

        $topics       = $user->topics()->where('status', 'active')->latest()->take(4)->get();
        $logs         = $user->logs()->latest()->take(3)->get();
        $goals        = $user->goals()->latest()->take(5)->get();
        $resources        = $user->resources()->latest()->take(5)->get();
        $logsThisWeek = $user->logs()->whereBetween('created_at', [now()->startOfWeek(), now()])->count();

        return view('dashboard', compact('greeting', 'stats', 'topics', 'logs', 'goals', 'resources', 'logsThisWeek'));
    }
}
