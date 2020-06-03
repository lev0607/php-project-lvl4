<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::paginate();

        return view('task.index', compact('tasks'));
    }

    public function create()
    {
        $task = new Task();
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        return view('task.create', compact('task', 'taskStatuses', 'users'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status_id' => 'required',
            'assigned_to_id' => '',
        ]);
        $task = new Task();
        $task->fill($data);
        $task->user()->associate($user);

        $task->save();
        flash('Task was created!')->success();

        return redirect()
            ->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        return view('task.edit', compact('task', 'taskStatuses', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $user = auth()->user();
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status_id' => 'required',
            'assigned_to_id' => '',
        ]);

        $task->fill($data);
        $task->user()->associate($user);

        $task->save();
        flash('Task was updated!')->success();

        return redirect()
            ->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if ($task) {
            $task->delete();
        }
        flash('Task was deleted!')->success();

        return back();
    }
}
