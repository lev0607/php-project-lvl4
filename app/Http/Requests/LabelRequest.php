<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|unique:labels',
        ];

        if ($label = $this->route('label')) {
            $rules['name'] = 'required|unique:labels,name,' . $label->id;
        }

        return $rules;
    }
}
