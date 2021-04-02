<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title' => [
                'required',
                'max:50'
            ],
            'banner_url' => [
                'nullable',
                'url'
            ],
            'content' =>[
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
            'title.required' => 'A title is required.',
            'title.max' => 'The title must not exceed :max characters.',

            'banner_url.url' => 'The banner URL format is not valid.',

            'content.required' => 'A content is required.',
            'content.max' => 'The content must not exceed :max characters.',
        ];
    }
}
