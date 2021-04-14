<?php

namespace App\Http\Requests\Subscriber;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreSubscriberRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                'unique:subscribers',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'An email address is required.',
            'email.email' => 'The provided email address is not valid.',
            'email.unique' => 'You are already a subscriber.',
        ];
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
