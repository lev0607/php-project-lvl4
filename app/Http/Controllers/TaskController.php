<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
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

    public function store(TaskRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

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
        $taskStatusName = $task->status->name;
        $taskAssigned = $task->assigned->name ?? '';
        $taskCreator = $task->user->name;

        return view('task.show', compact('task', 'taskStatusName', 'taskAssigned', 'taskCreator', 'labels'));
    }

    public function edit(Task $task)
    {
        $labels = Label::all();
        $taskStatuses = TaskStatus::all();
        $users = User::all();

        return view('task.edit', compact('task', 'taskStatuses', 'users', 'labels'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();

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
            $task->labels()->detach();
            $task->delete();
        }
        flash('Task was deleted!')->success();

        return back();
    }
}
