<?php

namespace App\Http\Requests\Guides;

use App\Models\Role;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreGuideRequest extends FormRequest
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
            'title' => [
                'required',
                'max:50',
            ],
            'banner_url' => [
                'required',
                'url',
            ],
            'content' => [
                'required',
                'max:10000',
            ],
            'roles' => [
                'required',
                'array',
                Rule::in(Role::all()->pluck('id')->toArray())
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
            'title.required' => 'A title is required.',
            'title.max' => 'The title cannot be longer than :max characters.',

            'banner_url.required' => 'A banner URL is required.',
            'banner_url.url' => 'The banner URL format is not valid.',

            'content.required' => 'A content is required.',
            'content.max' => 'The content cannot be longer than :max characters.',

            'roles.required' => 'At least one role must be able to see a guide.',
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
