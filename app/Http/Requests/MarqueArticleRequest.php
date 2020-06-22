<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarqueArticleRequest extends FormRequest
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
        return \App\MarqueArticle::defaultRules();
    }

    public function messages()
    {
        return \App\MarqueArticle::validationMessages();
    }
}
