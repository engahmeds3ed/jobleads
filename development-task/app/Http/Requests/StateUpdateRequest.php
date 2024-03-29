<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateUpdateRequest extends FormRequest
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
        $item_id = $this->route()->parameter('state');
        return [
            "country_id" => "required|exists:countries,id",
            "name" => "required",
            "code" => "required|unique:states,code,".$item_id
        ];
    }
}
