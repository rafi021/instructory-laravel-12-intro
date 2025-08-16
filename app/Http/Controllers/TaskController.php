<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
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

        $file_exists = $request->hasFile('image');
        if ($file_exists) {
            $file  = $request->file('image');
            $file_ext = $file->getClientOriginalExtension();
            $file_location = Storage::disk('public')->putFileAs('image', $file, 'profile_image' . '.' . $file_ext);
        }

        Task::create([
            'name' => $request->validated('name'),
            'date' => $request->validated('date'),
            'image' => $file_location ?? null
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
            $task->delete();
            Alert::success('Success', 'Task Deleted Successfully!!');
            return redirect()->route('tasks.index');
        } else {
            Alert::error('Error', 'Task Not Found!!');
            return redirect()->route('tasks.index');
        }
    }
}
