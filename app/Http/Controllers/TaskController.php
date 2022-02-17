<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller{
    public function showList() {
        $tasks = Task::paginate(5);

        return view('admin/tasks')->with([
            'tasks' => $tasks
        ]);
    }

    public function showAdd(Request $request) {
        return view('admin/task-form');
    }

    public function save(TaskRequest $request) {
        Task::create([
            'title' => (string)$request->input('title'),
            'description' => (string)$request->input('description'),
            'todo_time' => $request->input('todo_time'),
        ]);

        return redirect(route('tasks'));
    }
}
