<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'Email required',
            'email.string' => 'Email string',
            'email.email' => 'Email email',
            'password.required' => 'Password required',
            'password.string' => 'Password string',
            'password.min' => 'Password min'
        ];
    }
}
