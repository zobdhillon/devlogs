<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $topics = $user->topics()->latest()->get();;
        return view('topics.index', compact('topics'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'color' => 'required',
            'status' => 'required|in:active,paused,completed',
        ]);

        auth()->user()->topics()->create($request->all());

        return redirect()->route('topics.index')->with('success', 'Topic added!');
    }

    public function show(Topic $topic)
    {
        //
    }

    public function edit(Topic $topic)
    {
        //
    }

    public function update(Request $request, Topic $topic)
    {
        //
    }

    public function destroy(Topic $topic)
    {
        //
    }
}
