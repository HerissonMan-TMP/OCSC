<?php

namespace App\Http\Requests\Convoy;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConvoyRequest extends FormRequest
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
            'title' => [
                'required',
                'max:50'
            ],
            'banner_url' => [
                'nullable',
                'url'
            ],
            'location' => [
                'required',
                'max:20'
            ],
            'distance' => [
                'nullable',
                'numeric'
            ],
            'destination' => [
                'required',
                'max:20'
            ],
            'server' => [
                'required',
                'max:20'
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

            'title.required' => 'A title is required.',
            'title.max' => 'The title must not exceed :max characters.',

            'banner_url.url' => 'The banner URL format is not valid.',

            'location.required' => 'A location is required.',
            'location.max' => 'The location must not exceed :max characters.',

            'distance.numeric' => 'The distance must be a number.',

            'destination.required' => 'A destination is required.',
            'destination.max' => 'The destination must not exceed :max characters.',

            'server.required' => 'A server is required.',
            'server.max' => 'The server must not exceed :max characters.',

            'meetup_date.required' => 'A meetup date is required.',
            'meetup_date.date' => 'The meetup date format is not valid.',
        ];
    }
}
