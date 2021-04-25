<?php

namespace App\Http\Requests\Role;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateRoleRequest extends FormRequest
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
            'name' => [
                'required',
                'max:30',
            ],
            'icon_name' => [
                'required',
            ],
            'color' => [
                'required',
                'regex:/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/i',
            ],
            'contrast_color' => [
                'required',
                'regex:/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/i',
            ],
            'description' => [
                'required',
                'max:100',
            ],
            'recruitment_enabled' => [
                'boolean',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A name is required.',
            'name.max' => 'The name cannot be longer than :max characters.',

            'icon_name.required' => 'A icon name is required.',

            'color.required' => 'A color is required.',
            'color.regex' => 'The color format must be in hexadecimal format.',

            'contrast_color.required' => 'A contrast color is required.',
            'contrast_color.regex' => 'The contrast color format must be in hexadecimal format.',

            'description.required' => 'A description is required.',
            'description.max' => 'The description cannot be longer than :max characters.',

            'recruitment_enabled.boolean' => 'The value for the "recruitment enabled" checkbox is not valid.',
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
