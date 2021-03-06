<?php

namespace App\Http\Requests\Permission;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
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
            'permissions.*' => [
                Rule::in(Permission::pluck('id')->toArray()),
                Auth::user()->hasPermission('has-admin-rights') ? null :
                Rule::notIn(Permission::where('slug', 'has-admin-rights')->pluck('id')->toArray())
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
            'permissions.*.in' => 'The permissions are not valid.',
            'permissions.*.not_in' => 'You cannot assign Admin rights.',
        ];
    }
}
