<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() {
        $tasks = auth()->user()->tasks()->orderBy('due_date', 'asc')->get();
        return view('tasks.index', compact('tasks'));
    }
    
    public function create() {
        return view('tasks.create');
    }
    
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);
    
        auth()->user()->tasks()->create($request->all());
    
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
    
    public function edit(Task $task) {
        return view('tasks.edit', compact('task'));
    }
    
    public function update(Request $request, Task $task) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);
    
        $task->update($request->all());
    
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    
    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
    
    public function toggleCompletion(Task $task) {
        $task->update(['completed' => !$task->completed]);
        return redirect()->route('tasks.index')->with('success', 'Task status updated.');
    }    
}
