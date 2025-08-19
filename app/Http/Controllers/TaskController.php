<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::latest()->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:tasks,title',
        ],
        [
            'title.required' => 'Task name is required',
            'title.unique' => 'The task has already been taken',
        ]);

        Task::create([
            'title' => $request->title,
            'is_completed' => false,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with([
                'success' => 'Task created successfully',
                'icon' => 'check',
        ]);
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
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tasks', 'title')->ignore($task->id),
            ],
        ],
        [
            'title.required' => 'Task name is required',
            'title.unique' => 'The task has already been taken',
        ]);

        $task->update([
            'title' => $request->title,
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()
            ->route('tasks.index')
            ->with([
                'success' => 'Task updated successfully',
                'icon' => 'check',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with([
                'success' => 'Task deleted successfully',
                'icon' => 'check',
        ]);
    }

    public function toggle(Task $task)
    {
        $task->is_completed = !$task->is_completed;
        $task->save();
        
        if ($task->is_completed) {
            return redirect()
                ->route('tasks.index')
                ->with([
                    'success' => 'Task marked as completed',
                    'status' => 'completed'
                ]);
        } else {
            return redirect()
                ->route('tasks.index')
                ->with([
                    'success' => 'Task marked as incomplete',
                    'status' => 'active'
                ]);
        }
    }
}
