<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone' => 'nullable|numeric|digits:10',
            'birthday' => 'nullable|date_format:Y-m-d',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.account.email.required'),
            'email.email' => trans('validation.account.email.email'),
            'email.unique' => trans('validation.account.email.unique'),
            'phone.numeric' => trans('validation.account.phone.numeric'),
            'phone.digits' => trans('validation.account.phone.digits'),
            'birthday.date_format' => trans('validation.account.birthday.date_format')
        ];
    }
}
