<?php

namespace App\Http\Requests\Application;

use App\Models\Recruitment;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

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
            'truckersmp_id' => [
                'nullable',
                'numeric',
                'digits_between:1,8',
            ],
            'discord' => [
                'required',
                'max:50',
            ],
            'email' => [
                'required',
                'email',
                'max:300'
            ],
            'steam_profile' => [
                'required',
                'url',
            ],
            'trucksbook_profile' => [
                'required',
                'url',
            ],
            'age' => [
                'required',
                'numeric',
                'between:16,99',
            ],
            'pc_configuration' => [
                'required',
                'max:100',
            ],
            'questions' => [
                'array',
            ],
            'consent' => [
                'accepted',
            ],
        ];

        $questions = request()->route('recruitment')->questions;
        $counter = 0;

        foreach($questions as $question) {
            $rules["questions.{$counter}"] = [
                'required',
                "between:{$question->min_length},{$question->max_length}"
            ];

            $counter++;
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
            'truckersmp_id.numeric' => 'The TruckersMP ID must be a number.',
            'truckersmp_id.digits_between' => 'The TruckersMP ID must not exceed :max numbers.',

            'discord.required' => 'A Discord username is required.',
            'discord.max' => 'The Discord username must not be longer than :max characters.',

            'email.required' => 'An Email address is required.',
            'email.email' => 'The provided Email address is not valid.',
            'email.max' => 'The Email address must not be longer than :max characters.',

            'steam_profile.required' => 'A Steam profile is required.',
            'steam_profile.url' => 'The Steam profile must be a link.',

            'trucksbook_profile.required' => 'A Trucksbook is required.',
            'trucksbook_profile.url' => 'The Trucksbook profile must be a link.',

            'age.required' => 'Your age is required.',
            'age.numeric' => 'The age must be a numeric value.',
            'age.between' => 'You must be between :min and :max years old.',

            'pc_configuration.max' => 'The PC Configuration must not be longer than :max characters.',

            'consent.accepted' => 'You must accept the condition above.',
        ];

        $questions = request()->route('recruitment')->questions;
        $counter = 0;

        foreach($questions as $question) {
            $messages["questions.{$counter}" . '.required'] =
                'You must answer the question.';

            $messages["questions.{$counter}" . '.between'] =
                'You must write between :min and :max characters for this question.';

            $counter++;
        }

        return $messages;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator)
    {
        flash($validator->errors()->first())->error()->important();

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
