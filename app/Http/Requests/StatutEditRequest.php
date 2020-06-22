<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatutEditRequest extends StatutRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(\App\Statut::canedit());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return \App\Statut::updateRules($this->statut);
    }
}
