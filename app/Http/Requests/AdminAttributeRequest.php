<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAttributeRequest extends FormRequest
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
            'atb_name' => 'required|max:190|min:1|unique:attributes,atb_name,' . $this->id,
            'atb_type' => 'required',
            'atb_category_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'atb_name.required' => 'Dữ Liệu không để trống',
            'atb_name.unique' => 'Dữ Liệu đã tồn tại',
            'atb_name.max' => 'dữ liệu không quá 190 ký tự',
            'atb_name.min' => 'dữ liệu phải nhiều hơn 3 ký tự',
            'atb_type.required' => 'Dữ Liệu không để trống',
            'atb_category_id.required' => 'Dữ Liệu không để trống',
        ];
    }
}
