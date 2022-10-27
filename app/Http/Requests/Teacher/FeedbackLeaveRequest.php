<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackLeaveRequest extends FormRequest
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
                'reason_deny' => 'max:255|required_if:options,==,'.DENY_LEAVES
            ];
        }
    
        public function messages()
        {
            return [
                'reason_deny.required_if' => trans('validation.leave.reason_deny.required_if'),
                'reason_deny.max' => trans('validation.leave.reason_deny.max')
            ];
        }
}
