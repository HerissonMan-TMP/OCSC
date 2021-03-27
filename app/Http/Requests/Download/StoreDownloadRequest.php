<?php

namespace App\Http\Requests\Download;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                'max:100'
            ],
            'link' => [
                'required',
                'url'
            ],
            'roles' => [
                'required',
                'array',
                Rule::in(Role::all()->pluck('id')->toArray())
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
            'name.required' => 'A name is required.',
            'name.max' => 'The name cannot be longer than :max characters.',

            'link.required' => 'A link is required.',
            'link.url' => 'The link format is not valid. It must be an URL.',

            'roles.required' => 'At least one role must be able to see a download.',
            'roles.array' => 'The roles must be sent in an array format.',
            'roles.in' => 'The roles are not valid.',
        ];
    }
}
