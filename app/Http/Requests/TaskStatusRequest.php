<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|unique:task_statuses',
        ];

        if ($taskStatus = $this->route('task_status')) {
            $rules['name'] = 'required|unique:task_statuses,name,' . $taskStatus->id;
        }

        return $rules;
    }
}
