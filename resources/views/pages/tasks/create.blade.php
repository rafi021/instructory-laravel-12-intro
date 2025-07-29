@extends('welcome')
@section('main-content')
    <div class="container mx-auto space-y-12 space-x-5">
        <h1 class="text-2xl font-bold pt-12">Task Create</h1>
        <div class="border px-4 rounded-2xl border-gray-900/10 pb-12">
            <form action={{ route('tasks.store') }} method="POST">
                @csrf
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-6">

                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Task Name</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600 @error('name') border border-red-500
                                    @enderror">
                                <input id="name" type="text" name="name" placeholder="task name"
                                    class="min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 " />
                            </div>
                            @error('name')
                                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="date" class="block text-sm/6 font-medium text-gray-900">Task Date</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600 @error('name') border border-red-500
                                    @enderror">
                                <input id="date" type="date" name="date" placeholder="task date"
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                            </div>
                            @error('date')
                                <span class="mt-2 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="mt-6 flex items-center justify-start gap-x-6">
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
