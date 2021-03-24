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
            'start_at' => [
                'required',
                'date',
                'before:end_at'
            ],
            'end_at' => [
                'required',
                'date',
                'after:start_at'
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
            'start_at.required' => 'A start datetime is required.',
            'start_at.date' => 'The start datetime format is not valid.',
            'start_at.before' => 'The start datetime must be before the end datetime.',
            'start_at.after' => 'The start datetime must be in the future.',
            'end_at.required' => 'A end datetime is required.',
            'end_at.date' => 'The end datetime format is not valid.',
            'end_at.before' => 'The end datetime must be after the start datetime.',
            'note.max' => 'The note must not have more than :max characters.',
        ];
    }
}
