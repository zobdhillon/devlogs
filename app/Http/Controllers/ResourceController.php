<?php

namespace App\Http\Controllers;

use App\Models\Resource as UserResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $resources = Auth::user()
            ->resources()
            ->with('topic')
            ->latest()
            ->paginate(15);

        return view('resources.index', compact('resources'));
    }

    public function create()
    {
        $topics = Auth::user()->topics()->orderBy('name')->get();
        return view('resources.create', compact('topics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'url'      => 'required|url|max:500',
            'type'     => 'required|in:video,article,course,docs',
            'topic_id' => 'nullable|exists:topics,id',
        ]);

        Auth::user()->resources()->create($validated);

        return redirect()->route('resources.index')
            ->with('success', 'Resource saved');
    }

    public function edit(UserResource $resource)
    {
        $this->authorize('update', $resource);

        $topics = Auth::user()->topics()->orderBy('name')->get();
        return view('resources.edit', compact('resource', 'topics'));
    }

    public function update(Request $request, UserResource $resource)
    {
        $this->authorize('update', $resource);

        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'url'      => 'required|url|max:500',
            'type'     => 'required|in:video,article,course,docs',
            'topic_id' => 'nullable|exists:topics,id',
        ]);

        $resource->update($validated);

        return redirect()->route('resources.index')
            ->with('success', 'Resource updated');
    }

    public function destroy(UserResource $resource)
    {
        $this->authorize('delete', $resource);

        $resource->delete();

        return response()->json(['ok' => true]);
    }
}
