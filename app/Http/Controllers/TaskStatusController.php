<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatusRequest;
use App\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskStatuses = TaskStatus::paginate();

        return view('taskStatus.index', compact('taskStatuses'));
    }

    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('taskStatus.create', compact('taskStatus'));
    }

    public function store(TaskStatusRequest $request)
    {
        $data = $request->validated();

        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();

        flash('Task status was created!')->success();

        return redirect()
            ->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('taskStatus.edit', compact('taskStatus'));
    }

    public function update(TaskStatusRequest $request, TaskStatus $taskStatus)
    {
        $data = $request->validated();

        $taskStatus->fill($data);
        $taskStatus->save();

        flash('Task was updated!')->success();

        return redirect()
            ->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus) {
            try {
                $taskStatus->delete();
            } catch (\Illuminate\Database\QueryException $e) {
                Log::info($e->getMessage());
                flash('This status can’t be deleted. It is used in other tasks!')->error();

                return back();
            }
        }

        flash('Task status was deleted!')->success();

        return redirect()->route('task_statuses.index');
    }
}
