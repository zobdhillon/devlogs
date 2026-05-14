<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TopicController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $topics = auth()->user()->topics()->latest()->get();
        return view('topics.index', compact('topics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:60',
            'color'  => 'required|string',
            'icon'   => 'required|string',
            'status' => 'required|in:active,paused,completed',
            'progress' => 'required|integer|min:0|max:100',
        ]);

        auth()->user()->topics()->create($request->only('name', 'color', 'icon', 'status', 'progress'));

        return redirect()->route('topics.index')->with('success', 'Topic added');
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        return view('topics.edit', compact('topic'));
    }

    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $request->validate([
            'name'   => 'required|string|max:60',
            'color'  => 'required|string',
            'icon'   => 'required|string',
            'status' => 'required|in:active,paused,completed',
            'progress' => 'required|integer|min:0|max:100',
        ]);

        $topic->update($request->only('name', 'color', 'status'));

        return redirect()->route('topics.index')->with('success', 'Topic updated');
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);
        $topic->delete();
        return response()->json(['ok' => true]);
    }
}
