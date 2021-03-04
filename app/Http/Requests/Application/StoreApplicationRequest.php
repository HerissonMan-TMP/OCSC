<?php

namespace App\Http\Requests\Application;

use App\Models\Recruitment;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
        $rules = [
            'discord_username' => [
                'required',
                'max:50',
            ],
            'email_address' => [
                'required',
                'email',
                'max:300'
            ]
        ];

        $questions = request()->route('recruitment')->questions;
        foreach($questions as $question) {
            $rules['question_' . $question->id] = [
                'required',
                "between:{$question->min_length},{$question->max_length}"
            ];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $messages = [
            'discord_username.required' => 'A Discord username is required.',
            'discord_username.max' => 'The Discord username must not be longer than :max characters.',
            'email_address.required' => 'An Email address is required.',
            'email_address.email' => 'The provided Email address is not valid.',
            'email_address.max' => 'The Email address must not be longer than :max characters.',
        ];

        $questions = request()->route('recruitment')->questions;
        foreach($questions as $question) {
            $messages['question_' . $question->id . '.required'] =
                'You must answer the question.';

            $messages['question_' . $question->id . '.between'] =
                'You must write between :min and :max characters for this question.';
        }

        return $messages;
    }
}
