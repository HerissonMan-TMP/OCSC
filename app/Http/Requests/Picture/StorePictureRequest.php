<?php

namespace App\Http\Requests\Picture;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StorePictureRequest extends FormRequest
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
            'picture_file' => [
                'bail',
                'required',
                'mimes:jpeg,png',
                'dimensions:width=1920,height=1080',
                'max:10240',
            ],
            'name' => [
                'required',
                'max:50',
            ],
            'description' => [
                'required',
                'max:100',
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
            'picture_file.required' => 'A picture is required.',
            'picture_file.mimes' => 'The picture extension must be .png, .jpg, .jpeg or .jpe.',
            'picture_file.dimensions' => 'The picture dimensions must be :widthx:height pixels.',
            'picture_file.max' => 'The picture cannot be greater than 10MB.',

            'name.required' => 'A name is required.',
            'name.max' => 'The name cannot be longer than :max characters.',

            'description.required' => 'A description is required.',
            'description.max' => 'The description cannot be longer than :max characters.',
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
