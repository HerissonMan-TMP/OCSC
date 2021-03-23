<?php

namespace App\Http\Requests\Recruitment;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRecruitmentRequest extends FormRequest
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
            'start_datetime' => [
                'required',
                'date',
                'before:end_datetime'
            ],
            'end_datetime' => [
                'required',
                'date',
                'after:start_datetime'
            ],
            'note' => [
                'nullable',
                'max:5000'
            ],
            'specific_requirements' => [
                'nullable'
            ]
        ];
    }

    public function messages()
    {
        return [
            'start_datetime.required' => 'A start datetime is required.',
            'start_datetime.date' => 'The start datetime format is not valid.',
            'start_datetime.before' => 'The start datetime must be before the end datetime.',
            'start_datetime.after' => 'The start datetime must be in the future.',
            'end_datetime.required' => 'A end datetime is required.',
            'end_datetime.date' => 'The end datetime format is not valid.',
            'end_datetime.before' => 'The end datetime must be after the start datetime.',
            'note.max' => 'The note must not have more than :max characters.',
        ];
    }
}
