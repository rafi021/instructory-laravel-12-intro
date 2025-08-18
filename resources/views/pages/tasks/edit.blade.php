@extends('welcome')
@push('styles')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endpush
@section('main-content')
    <div class="container mx-auto max-w-2xl py-12 px-4">
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <h1 class="text-3xl font-extrabold text-indigo-700 mb-8 flex items-center gap-2">
                <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Update Task
            </h1>
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @method('PUT')
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-900 mb-1">Task Name</label>
                    <input id="name" type="text" name="name" placeholder="Enter task name"
                        class="w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 py-2 px-3 text-base text-gray-900 placeholder-gray-400 @error('name') border-red-500 ring-red-100 @enderror"
                        value="{{ old('name', $task->name) }}" />
                    @error('name')
                        <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-900 mb-1">Task Date</label>
                    <input id="date" type="date" name="date"
                        class="w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 py-2 px-3 text-base text-gray-900 placeholder-gray-400 @error('date') border-red-500 ring-red-100 @enderror"
                        value="{{ old('date', $task->date) }}" />
                    @error('date')
                        <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-900 mb-1">Task Image</label>
                    @if ($task->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($task->image) }}" alt="Current Image"
                                class="w-16 h-16 object-cover rounded-full border-2 border-indigo-200 shadow">
                        </div>
                    @endif
                    <input id="image" type="file" name="image"
                        class="w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 py-2 px-3 text-base text-gray-900 placeholder-gray-400 @error('image') border-red-500 ring-red-100 @enderror" />
                    @error('image')
                        <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-x-4 mt-8">
                    <a href="{{ route('tasks.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg shadow transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        const inputElement = document.querySelector('#image');
        const pond = FilePond.create(inputElement, {
            acceptedFileTypes: ['image/*'],
            server: {
                load: (source, load, error, progress, abort, headers) => {
                    const myRequest = new Request(source);
                    fetch(myRequest).then((res) => {
                        return res.blob();
                    }).then(load);
                },
                process: '{{ route('upload') }}',
                revert: '{{ route('revert') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            @if ($task->image)
                files: [{
                    source: '{{ Storage::url($task->image) }}',
                    options: {
                        type: 'local',
                    },
                }],
            @endif
        });
    </script>
@endpush
