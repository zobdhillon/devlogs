<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GoalController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $goals = auth()->user()->goals()
            ->with('topic')
            ->orderBy('is_completed')
            ->orderBy('deadline')
            ->get();

        return view('goals.index', compact('goals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'deadline' => 'nullable|date',
            'topic_id' => 'nullable|exists:topics,id',
        ]);

        auth()->user()->goals()->create($request->only('title', 'deadline', 'topic_id'));

        return redirect()->route('goals.index')->with('success', 'Goal saved');
    }

    public function edit(Goal $goal)
    {
        $this->authorize('update', $goal);
        $topics = auth()->user()->topics()->orderBy('name')->get();
        return view('goals.edit', compact('goal', 'topics'));
    }

    public function update(Request $request, Goal $goal)
    {
        $this->authorize('update', $goal);

        // Toggle complete via checkbox
        if ($request->has('toggle_complete')) {
            $goal->update([
                'is_completed' => !$goal->is_completed,
                'completed_at' => !$goal->is_completed ? now() : null,
            ]);
            return response()->json(['ok' => true, 'completed' => $goal->fresh()->is_completed]);
        }

        $request->validate([
            'title'    => 'required|string|max:255',
            'deadline' => 'nullable|date',
            'topic_id' => 'nullable|exists:topics,id',
        ]);

        $goal->update($request->only('title', 'deadline', 'topic_id'));

        return redirect()->route('goals.index')->with('success', 'Goal updated');
    }

    public function destroy(Goal $goal)
    {
        $this->authorize('delete', $goal);
        $goal->delete();
        return response()->json(['ok' => true]);
    }
}
