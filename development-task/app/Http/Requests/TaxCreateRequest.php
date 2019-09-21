<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxCreateRequest extends FormRequest
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
            "county_id" => "required|exists:counties,id",
            "amount" => "required",
            "taxrate_id" => "required|exists:taxrates,id"
        ];
    }
}
