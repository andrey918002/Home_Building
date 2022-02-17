<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'todo_time' => 'required|date_format:Y-m-d H:i',
        ];
    }
}
