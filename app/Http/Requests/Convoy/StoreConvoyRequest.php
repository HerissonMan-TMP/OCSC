<?php

namespace App\Http\Requests\Convoy;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreConvoyRequest extends FormRequest
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
            'truckersmp_event_id' => [
                'required',
                'numeric',
                'digits_between:1,8',
                'unique:convoys',
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
            'truckersmp_event_id.required' => 'The TruckersMP Event ID is required.',
            'truckersmp_event_id.numeric' => 'The TruckersMP Event ID must be a number.',
            'truckersmp_event_id.digits_between' => 'The TruckersMP Event ID must not exceed :max numbers.',
            'truckersmp_event_id.unique' => 'A convoy with that TruckersMP Event ID is already added on the website.',
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
