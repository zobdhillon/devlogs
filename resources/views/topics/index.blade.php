<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Topics
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Add Topic Form --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Add New Topic</h3>
                <form method="POST" action="{{ route('topics.store') }}">
                    @csrf
                    <div class="flex gap-4 flex-wrap">
                        <input type="text" name="name" placeholder="Topic name e.g. React"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm flex-1"
                            value="{{ old('name') }}" required />

                        <input type="color" name="color" value="{{ old('color', '#6366f1') }}"
                            class="rounded-md border border-gray-300 dark:border-gray-700 h-10 w-12 cursor-pointer" />

                        <select name="status"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            <option value="active">Active</option>
                            <option value="paused">Paused</option>
                            <option value="completed">Completed</option>
                        </select>

                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                            Add Topic
                        </button>
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </form>
            </div>

            {{-- Topics List --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Your Topics</h3>
                @forelse ($topics as $topic)
                    <div class="flex items-center gap-3 py-2 border-b dark:border-gray-700">
                        <span class="w-3 h-3 rounded-full" style="background-color: {{ $topic->color }}"></span>
                        <span class="text-gray-900 dark:text-gray-100 flex-1">{{ $topic->name }}</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $topic->status }}</span>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">No topics yet. Add one above!</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
