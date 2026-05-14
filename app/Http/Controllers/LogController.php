<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LogController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $logs = auth()->user()->logs()
            ->with('topic')
            ->latest()
            ->paginate(15);

        return view('logs.index', compact('logs'));
    }

    public function create()
    {
        $topics = auth()->user()->topics()->orderBy('name')->get();
        return view('logs.create', compact('topics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'body'     => 'required|string',
            'mood'     => 'required|integer|min:1|max:5',
            'topic_id' => 'nullable|exists:topics,id',
        ]);

        auth()->user()->logs()->create($request->only('title', 'body', 'mood', 'topic_id'));

        return redirect()->route('logs.index')->with('success', 'Log saved');
    }

    public function show(Log $log)
    {
        $this->authorize('update', $log);
        return view('logs.show', compact('log'));
    }

    public function edit(Log $log)
    {
        $this->authorize('update', $log);
        $topics = auth()->user()->topics()->orderBy('name')->get();
        return view('logs.edit', compact('log', 'topics'));
    }

    public function update(Request $request, Log $log)
    {
        $this->authorize('update', $log);

        $request->validate([
            'title'    => 'required|string|max:255',
            'body'     => 'required|string',
            'mood'     => 'required|integer|min:1|max:5',
            'topic_id' => 'nullable|exists:topics,id',
        ]);

        $log->update($request->only('title', 'body', 'mood', 'topic_id'));

        return redirect()->route('logs.index')->with('success', 'Log updated');
    }

    public function destroy(Log $log)
    {
        $this->authorize('delete', $log);
        $log->delete();
        return response()->json(['ok' => true]);
    }
}
