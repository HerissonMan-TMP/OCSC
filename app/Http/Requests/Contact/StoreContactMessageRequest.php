<?php

namespace App\Http\Requests\Contact;

use App\Models\ContactCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactMessageRequest extends FormRequest
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
            'truckersmp_id' => [
                'required',
                'numeric',
                'digits_between:1,8',
            ],
            'vtc' => [
                'nullable',
                'max:30'
            ],
            'category_id' => [
                Rule::in(ContactCategory::pluck('id')->toArray())
            ],
            'discord' => [
                'required_without:email',
                'max:50',
            ],
            'email' => [
                'required_without:discord',
                'max:300'
            ],
            'message' => [
                'required',
                'max:5000'
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
            'truckersmp_id.required' => 'The TruckersMP ID is required.',
            'truckersmp_id.numeric' => 'The TruckersMP ID must be a number.',
            'truckersmp_id.digits_between' => 'The TruckersMP ID must not exceed :max numbers.',
            'vtc.max' => 'The VTC name must not exceed :max characters.',
            'category_id.in' => 'The category is not valid.',
            'discord.required_without' => 'The Discord username is required if the Email address is not filled.',
            'discord.max' => 'The Discord username must not exceed :max characters.',
            'email.required_without' => 'The Email address is required if the Discord username is not filled.',
            'email.max' => 'The Email address must not exceed :max characters.',
            'message.required' => 'A message is required.',
            'message.max' => 'The message must not exceed :max characters.',
        ];
    }
}
