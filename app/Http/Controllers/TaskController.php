<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('images')->orderBy('date', 'desc')->get();
        return view('pages.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        // dd($request->all());

        $newFiles = [];

        // if ($request->input('image')) {
        //     foreach ($request->input('image') as $file) {
        //         $newFilename = Str::after($file, 'tmp/');
        //         Storage::disk('public')->move($file, "images/$newFilename");
        //         $newFiles[] = ['image' => "images/$newFilename"];
        //     }
        // }


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = (new FileUploadService)->fileUpload($request->file('image'));
            $newFiles = ["image" => $image];
        }

        // dd($newFiles);

        $task = Task::create([
            'name' => $request->validated('name'),
            'date' => $request->validated('date'),
            'image' => $newFiles['image'] ?? null,
        ]);

        // $task->images()->createMany($newFiles);


        Alert::success('Success', 'Task Store Successfully!!');
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::find($id);
        $images = $task->images->map(function ($image) {
            return [
                'source' => Storage::url($image->image),
                'options' => [
                    'type' => 'local'
                ]
            ];
        })->toArray();
        return view('pages.tasks.edit', [
            'task' => $task,
            'images' => $images
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, string $id)
    {
        $task = Task::find($id);

        $task->images->filter(function ($value) use ($request) {
            return ! in_array($value->image, $request->input('image'));
        })->each(function ($image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        });

        $files = [];

        $newImages = array_diff($request->input('image'), $task->images->pluck('image')->toArray());

        foreach ($newImages as $file) {
            $newFilename = Str::after($file, 'tmp/');
            Storage::disk('public')->move($file, "images/$newFilename");

            $files[] = ['image' => "images/$newFilename"];
        }

        foreach ($files as $file) {
            $task->images()->updateOrCreate(['image' => $file['image']]);
        }


        $task->update([
            'name' => $request->validated('name'),
            'date' => $request->validated('date'),
        ]);

        Alert::success('Success', 'Task Updated Successfully!!');
        return redirect()->route('tasks.index');
    }
    public function statusUpdate(UpdateTaskRequest $request, string $id)
    {
        $task = Task::find($id);
        $task->update([
            'status' => $request->validated('status'),
        ]);
        Alert::success('Success', 'Task Status Updated Successfully!!');
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->images()->delete();
            $task->delete();
            Alert::success('Success', 'Task Deleted Successfully!!');
            return redirect()->route('tasks.index');
        } else {
            Alert::error('Error', 'Task Not Found!!');
            return redirect()->route('tasks.index');
        }
    }


    public function upload(Request $request)
    {
        $path = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $path = $file->store('tmp', 'public');
            }
        }
        return $path;
    }

    public function revert(Request $request)
    {
        Storage::disk('public')->delete(($request->getContent()));
    }
}
