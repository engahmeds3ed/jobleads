<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxrateUpdateRequest extends FormRequest
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
        $item_id = $this->route()->parameter('taxrate');
        return [
            'name' => 'required',
            'code' => 'required|unique:taxrates,code,'.$item_id
        ];
    }
}
