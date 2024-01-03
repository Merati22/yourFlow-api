<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'username'=> ['required', 'string', Rule::unique('users')->ignore($this->route('user'))],
            'phone'=>'required',
            'email'=>'required',
            'password'=>'required',
            'access_level'=>'required|in:manager,employee,warehouse',

        ];
    }
}
