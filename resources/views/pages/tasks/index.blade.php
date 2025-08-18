@extends('welcome')
@section('main-content')
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-extrabold text-gray-800">📝 Task List</h1>
                <a href="{{ route('tasks.create') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Task
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg shadow divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Image
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($tasks as $task)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    @if ($task->image == null)
                                        <img src="https://placehold.co/400" alt=""
                                            class="w-12 h-12 object-cover rounded-full border-2 border-indigo-200 shadow">
                                    @else
                                        <img src="{{ Storage::url($task->image) }}" alt="Task Image"
                                            class="w-12 h-12 object-cover rounded-full border-2 border-indigo-200 shadow">
                                    @endif

                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($task->status == 1)
                                        <span class="line-through text-gray-400">{{ $task->name }}</span>
                                    @else
                                        <span class="text-gray-800">{{ $task->name }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($task->date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('tasks.status', $task->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="0">
                                        <input name="status" type="checkbox" value="1"
                                            class="accent-indigo-600 w-5 h-5 rounded focus:ring-2 focus:ring-indigo-400"
                                            id="hs-checked-checkbox" @checked($task->status)
                                            onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-right flex gap-2 justify-end">
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                        class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-700 text-white text-sm font-semibold rounded-lg shadow transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400 text-lg">
                                    No tasks found. <a href="{{ route('tasks.create') }}"
                                        class="text-indigo-600 underline">Create one?</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
