<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'            => 'required',
            'name'          => 'required|max:255',
            'instagram'     => 'nullable|max:255',
            'date_of_birth' => 'nullable|date',
            'facebook'      => 'nullable|max:255',
            'position'      => 'nullable|max:255',
            'address'       => 'nullable|max:255',
            'phone'         => 'nullable|max:255',
            'email'         => 'email:rfc,dns',
            'image'         => 'nullable|image'
        ];
    }
}
