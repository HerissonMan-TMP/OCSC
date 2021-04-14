<?php

namespace App\Http\Requests\PrivacyPolicy;

use Illuminate\Foundation\Http\FormRequest;

class StorePrivacyPolicyRequest extends FormRequest
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
            'privacy_policy_content' => [
                'required',
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
            'privacy_policy_content.required' => 'A content is required.',
        ];
    }
}
