<?php

namespace App\Http\Requests\Subscriber;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriberRequest extends FormRequest
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
                'unique:subscribers',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'An email address is required.',
            'email.email' => 'The provided email address is not valid.',
            'email.unique' => 'You are already a subscriber.',
        ];
    }
}
