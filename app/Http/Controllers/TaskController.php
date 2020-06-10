<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use App\Label;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{

    public function index()
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        $tasks = QueryBuilder::for(Task::class)
            ->allowedIncludes(['labels'])
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
                'labels.name'
            ])
            ->get();

        return view('task.index', compact('tasks', 'taskStatuses', 'users', 'labels'));
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
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
            'label_id' => 'nullable|exists:labels,id',
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

        return view('task.show', compact('task', 'labels'));
    }

    public function edit(Task $task)
    {
        $labels = Label::all();
        $taskStatuses = TaskStatus::all();
        $users = User::all();

        return view('task.edit', compact('task', 'taskStatuses', 'users', 'labels'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
            'label_id' => 'nullable|exists:labels,id',
        ]);

        if (isset($data['label_id'])) {
            $task->labels()->sync($data['label_id']);
        } else {
            $task->labels()->detach();
        }

        $task->fill($data);
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
