<?php

namespace App\Http\Requests\User;

use App\Models\Role;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreUserRequest extends FormRequest
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
                'unique:users',
                'max:300'
            ],
            'name' => [
                'required',
                'string',
                'between:2,15'
            ],
            'temporary_password' => [
                'required',
                'size:8',
                'alpha_num'
            ],
            'role_id' => [
                Rule::in(Role::pluck('id')->toArray())
            ]
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'An Email address is required.',
            'email.email' => 'The provided Email address is not valid.',
            'email.unique' => 'The provided Email address is already used by someone else.',
            'email.max' => 'The Email address must not be longer than :max characters.',
            'name.required' => 'A name is required.',
            'name.string' => 'The name must be a string.',
            'name.between' => 'The name length must be between :min and :max characters.',
            'temporary_password.required' => 'A temporary password is required.',
            'temporary_password.size' => 'The temporary password must have :size characters.',
            'temporary_password.alpha_num' => 'The temporary password must only have alphanumeric characters.',
            'role_id.in' => 'This role does not exist.'
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
