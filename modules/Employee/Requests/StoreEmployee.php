<?php

namespace Modules\Employee\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
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
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'username' => 'required|max:255',
            'designation' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'sometimes|required|max:255|confirmed|same:password_confirmation',
            'password_confirmation' => 'max:255'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'password.confirmed' => [
    //             ''
    //         ]
    //     ];
    // }
}