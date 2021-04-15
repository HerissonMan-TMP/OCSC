<?php

namespace App\Http\Requests\Role;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateRoleColorsRequest extends FormRequest
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
            'color' => [
                'required',
                'regex:/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/i',
            ],
            'contrast_color' => [
                'required',
                'regex:/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/i',
            ],
        ];
    }

    public function messages()
    {
        return [
            'color.required' => 'A color is required.',
            'color.regex' => 'The color format must be in hexadecimal format.',

            'contrast_color.required' => 'A contrast color is required.',
            'contrast_color.regex' => 'The contrast color format must be in hexadecimal format.',
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
