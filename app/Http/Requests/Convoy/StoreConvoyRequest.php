<?php

namespace App\Http\Requests\Convoy;

use Illuminate\Foundation\Http\FormRequest;

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
            ],
            'distance' => [
                'nullable',
                'numeric'
            ],
            'meetup_date' => [
                'required',
                'date'
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
            'distance.numeric' => 'The distance must be a number.',
            'meetup_date.required' => 'A meetup date is required.',
            'meetup_date.date' => 'The meetup date format is not valid.',
        ];
    }
}
