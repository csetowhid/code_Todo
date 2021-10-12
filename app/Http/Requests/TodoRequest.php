<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TodoRequest extends FormRequest
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
            'task' => [
                'required',
                Rule::unique('todos')->ignore($this->route('todo')),
                'min:5',
                'max:255',
            ],
            'description' => [
                'min:5',
                'max:255',
            ],
            'image' =>[
                'image:jpg, jpeg, png',
                'max: 2048',
            ],
        ];
    }

    public function messages()
    {
        return [
            'task.unique' => 'The Task Must Be Unique',
            'task.unique' => array(
                'messege' => 'Successfully Subject Add !!!',
                'alert-type' => 'success'
            )
        ];
    }
}
