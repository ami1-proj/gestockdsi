<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatutCreateRequest extends StatutRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(\App\Statut::cancreate());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return \App\Statut::createRules();
    }
}
