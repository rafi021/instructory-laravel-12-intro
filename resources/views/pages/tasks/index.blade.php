@extends('welcome')
@section('main-content')
    <div class="container mx-auto space-y-12 space-x-5">
        <div class="-m-1.5 overflow-x-auto pt-50">
            <h1 class="text-2xl font-bold pt-12">Task List</h1>

            <div class="flex justify-end mb-4">
                <a href="{{ route('tasks.create') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded">Task Create</a>
            </div>

            <div class="p-1.5 min-w-full inline-block align-middle border rounded-lg">
                <div class="overflow-hidden">
                    <table class="min-w-full table-auto divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    #</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Task Name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Date</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Status</th>
                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($tasks as $task)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                        {{ $loop->index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        @if ($task->status == 1)
                                            <span class="line-through">{{ $task->name }}</span>
                                        @else
                                            {{ $task->name }}
                                        @endif

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $task->date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        <div class="flex">

                                            <form action="{{ route('tasks.status', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="0">
                                                <input name="status" type="checkbox" value="1"
                                                    class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                    id="hs-checked-checkbox" @checked($task->status)
                                                    onchange="this.form.submit()">
                                            </form>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                            class="px-4 py-2 bg-blue-400 text-white inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent  hover:text-blue-800 focus:outline-hidden focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">
                                            Edit
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 bg-red-400 text-white inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent  hover:text-red-800 focus:outline-hidden focus:text-red-800 disabled:opacity-50 disabled:pointer-events-none">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                            @empty
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
