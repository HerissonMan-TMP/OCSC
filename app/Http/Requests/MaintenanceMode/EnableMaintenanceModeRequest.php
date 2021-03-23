<?php

namespace App\Http\Requests\MaintenanceMode;

use Illuminate\Foundation\Http\FormRequest;

class EnableMaintenanceModeRequest extends FormRequest
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
            'secret' => [
                'required',
                'between:5,50'
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
            'secret.required' => 'A bypass token is required.',
            'secret.between' => 'The bypass token must have between :min and :max characters.'
        ];
    }
}
