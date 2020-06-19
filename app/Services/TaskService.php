<?php

namespace App\Services;

use App\Label;
use App\Task;
use App\User;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function create(array $data, User $user)
    {
            $task = new Task();
            $task->fill($data);
            $task->user()->associate($user);

        DB::transaction(function () use ($task, $data) {
            $task->save();

            if (!empty($data['label_id'])) {
                $label = Label::find($data['label_id']);
                $task->labels()->attach($label);
            }
        });
    }
    public function update(array $data, Task $task)
    {
        DB::transaction(function () use ($task, $data) {
            if (isset($data['label_id'])) {
                $task->labels()->sync($data['label_id']);
            } else {
                $task->labels()->detach();
            }

            $task->fill($data);
            $task->save();
        });
    }
    public function delete(Task $task)
    {
        DB::transaction(function () use ($task) {
            if ($task) {
                $task->labels()->detach();
                $task->delete();
            }
        });
    }
}
