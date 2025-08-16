<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Str;
use RealRashid\SweetAlert\Facades\Alert;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('date', 'desc')->get();
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
        $newFilename = Str::after($request->input('image'), 'tmp/');
        Storage::disk('public')->move($request->input('image'), "images/$newFilename");

        Task::create([
            'name' => $request->validated('name'),
            'date' => $request->validated('date'),
            'image' => "images/$newFilename"
        ]);
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
        return view('pages.tasks.edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, string $id)
    {
        $task = Task::find($id);
        if (str()->afterLast($request->input('image'), '/') !== str()->afterLast($task->image, '/')) {
            Storage::disk('public')->delete($task->image);
            $newFilename = Str::after($request->input('image'), 'tmp/');
            Storage::disk('public')->move($request->input('image'), "images/$newFilename");
        }
        $task->update([
            'name' => $request->validated('name'),
            'date' => $request->validated('date'),
            'image' => isset($newFilename) ? "images/$newFilename" : $task->image
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
            Storage::disk('public')->delete($task->image);
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
        if ($request->file('image')) {
            $path = $request->file('image')->store('tmp', 'public');
        }
        return $path;
    }
    public function revert(Request $request)
    {
        Storage::disk('public')->delete($request->getContent());
    }
}
