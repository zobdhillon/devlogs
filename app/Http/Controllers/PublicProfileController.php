<?php

namespace App\Http\Controllers;

use App\Models\User;

class PublicProfileController extends Controller
{
    public function show(string $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $topics = $user->topics()
            ->orderBy('status')
            ->orderBy('name')
            ->get();

        $logs = $user->logs()
            ->with('topic')
            ->latest()
            ->take(5)
            ->get();

        $completedGoals = $user->goals()
            ->where('is_completed', true)
            ->with('topic')
            ->latest('completed_at')
            ->take(5)
            ->get();

        $stats = [
            'logs'            => $user->logs()->count(),
            'active_topics'   => $user->topics()->where('status', 'active')->count(),
            'completed_goals' => $user->goals()->where('is_completed', true)->count(),
        ];

        return view('profile.show', compact('user', 'topics', 'logs', 'completedGoals', 'stats'));
    }
}
