<?php

namespace App\Http\Requests\User;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRolesRequest extends FormRequest
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
            'roles' => [
                'required',
                'array',
                Rule::in(Role::all()->pluck('id')->toArray()),
            ]
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
            'roles.required' => 'The user must have at least one role.',
            'roles.array' => 'The roles must be sent in an array format.',
            'roles.in' => 'The roles are not valid.',
        ];
    }
}
