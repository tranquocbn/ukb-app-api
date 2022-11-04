<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveRequest extends FormRequest
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
            'reason' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'reason.required' => trans('validation.leave.reason.required'),
            'reason.max' => trans('validation.leave.reason.max')
        ];
    }
}
