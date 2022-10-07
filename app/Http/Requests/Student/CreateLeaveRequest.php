<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class CreateLeaveRequest extends FormRequest
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
            'schedule_id' => 'numeric',
            'date_want' => 'date_format:Y-m-d|after_or_equal:'.date('Y-m-d'),
            'reason' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'schedule_id.numeric' => trans('validation.leave.schedule_id.numeric'),
            'date_want.date_format' => trans('validation.leave.date_want.date_format'),
            'date_want.after_or_equal' => trans('validation.leave.date_want.after_or_equal'),
            'reason.required' => trans('validation.leave.reason.required'),
            'reason.max' => trans('validation.leave.reason.max')
        ];
    }
}
