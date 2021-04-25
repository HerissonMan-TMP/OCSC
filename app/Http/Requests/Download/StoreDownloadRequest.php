<?php

namespace App\Http\Requests\Download;

use App\Models\Role;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreDownloadRequest extends FormRequest
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
                'max:100',
            ],
            'file' => [
                'required',
                'file',
                'max:15000',
            ],
            'roles' => [
                'required',
                'array',
                Rule::in(Role::all()->pluck('id')->toArray()),
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

            'file.required' => 'A link is required.',
            'file.file' => 'The file is not valid.',
            'file.max' => 'The file size cannot be greater than :max KB.',

            'roles.required' => 'At least one role must be able to see a download.',
            'roles.array' => 'The roles must be sent in an array format.',
            'roles.in' => 'The roles are not valid.',
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
