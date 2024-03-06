<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'year_id' => 'required|integer',
            'semester_id' => 'required|integer',
            'group_id' => 'required|integer',
            'class_id' => 'required|integer',
            'module_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'classroom_id' => 'required|integer',
            'day_of_week' => [
                'required',
                Rule::in(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']),
            ],
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s|after:start_time',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'day_of_week.in' => 'The :attribute must be a valid day of the week.',
            'start_time.date_format' => 'The :attribute must be in the format HH:MM:SS.',
            'end_time.date_format' => 'The :attribute must be in the format HH:MM:SS.',
            'end_time.after' => 'The :attribute must be after the start time.',
            'year_id.integer' => 'The :attribute must be an integer.',
            'semester_id.integer' => 'The :attribute must be an integer.',
            'group_id.integer' => 'The :attribute must be an integer.',
            'class_id.integer' => 'The :attribute must be an integer.',
            'module_id.integer' => 'The :attribute must be an integer.',
            'teacher_id.integer' => 'The :attribute must be an integer.',
            'classroom_id.integer' => 'The :attribute must be an integer.',
        ];
    }
}
