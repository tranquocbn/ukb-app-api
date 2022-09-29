<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'phone' => 'numeric|digits:10',
            'birthday' => 'nullable|date',
            'email' => 'bail|required|email'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.custom.email.required'),
            'email.email' => trans('validation.custom.email.email'),
            'phone.numeric' => trans('validation.custom.phone.numeric'),
            'birthday.date' => trans('validation.custom.birthday.date')
        ];
    }
}
