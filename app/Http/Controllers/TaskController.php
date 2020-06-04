<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use App\Label;
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
        $labels = Label::all();
        return view('task.create', compact('task', 'taskStatuses', 'users', 'labels'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status_id' => 'required',
            'assigned_to_id' => '',
            'label_id' => '',
        ]);

        $task = new Task();
        $task->fill($data);
        $task->user()->associate($user);
        $task->save();

        if (!empty($data['label_id'])) {
            $label = Label::find($data['label_id']);
            $task->labels()->attach($label);
        }

        flash('Task was created!')->success();

        return redirect()
            ->route('tasks.index');
    }

    public function show(Task $task)
    {
        $labels = $task->labels()->get();
//        dd($labels);

        return view('task.show', compact('task', 'labels'));
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
            'label_id' => '',
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
