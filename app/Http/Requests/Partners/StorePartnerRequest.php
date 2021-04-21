<?php

namespace App\Http\Requests\Partners;

use App\Models\PartnerCategory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StorePartnerRequest extends FormRequest
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
                'max:30',
            ],
            'logo' => [
                'required',
                'url',
            ],
            'category_id' => [
                'required',
                Rule::in(PartnerCategory::all()->pluck('id')->toArray()),
            ],
            'truckersmp_link' => [
                'nullable',
                'regex:#^https:\/\/(www\.)?truckersmp\.com/.*$#i',
            ],
            'trucksbook_link' => [
                'nullable',
                'regex:#^https:\/\/(www\.)?trucksbook\.eu/.*$#i',
            ],
            'website_link' => [
                'nullable',
                'url',
            ],
            'twitter_link' => [
                'nullable',
                'regex:#^https:\/\/(www\.)?twitter\.com/.*$#i',
            ],
            'instagram_link' => [
                'nullable',
                'regex:#^https:\/\/(www\.)?instagram\.com/.*$#i',
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
            'name.required' => 'A name is required.',
            'name.max' => 'The name cannot be longer than :max characters.',

            'logo.required' => 'A logo link is required.',
            'logo.url' => 'The link format is not valid.',

            'category_id.required' => 'A category is required.',
            'category_id.in' => 'The selected category is not valid.',

            'truckersmp_link.regex' => 'The TruckersMP link format is not valid or is not a link leading to TruckersMP.',

            'trucksbook_link.regex' => 'The Trucksbook link format is not valid or is not a link leading to Trucksbook.',

            'website_link.url' => 'The website link format is not valid.',

            'twitter_link.regex' => 'The Twitter link format is not valid or is not a link leading to Twitter.',

            'instagram_link.regex' => 'The Instagram link format is not valid or is not a link leading to Instagram.',
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
