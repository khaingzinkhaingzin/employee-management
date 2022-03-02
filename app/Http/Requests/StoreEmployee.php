<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please fill first name.',
            'last_name.required' => 'Please fill last name.'
        ];
    }
}
