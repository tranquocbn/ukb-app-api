<?php

namespace App\Http\Requests\Teacher;

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
            'schedule_id' => 'required|numeric',
            'date_want' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d'),
            'date_change' => 'nullable|date_format:Y-m-d|after: 2 days',
            'reason' => 'required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'schedule_id.numeric' => trans('validation.leave.schedule_id.numeric'),
            'schedule_id.required' => trans('validation.leave.schedule_id.required'),
            'date_want.required' => trans('validation.leave.date_want.required'),
            'date_want.date_format' => trans('validation.leave.date_want.date_format'),
            'date_want.after_or_equal' => trans('validation.leave.date_want.after_or_equal'),
            'date_change.date_format' => trans('validation.leave.date_change.date_format'),
            'date_change.after' => trans('validation.leave.date_change.after'),
            'reason.required' => trans('validation.leave.reason.required'),
            'reason.max' => trans('validation.leave.reason.max')
        ];
    }
}
