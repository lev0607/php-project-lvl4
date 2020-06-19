<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use App\Task;
use App\TaskStatus;
use App\User;
use App\Label;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    private TaskService $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

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

        $this->service->create($data, $user);

        flash(__('flash.task_create'))->success();

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

        $this->service->update($data, $task);

        flash(__('flash.task_update'))->success();

        return redirect()
            ->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $this->service->delete($task);

        flash(__('flash.task_delete'))->success();

        return back();
    }
}
