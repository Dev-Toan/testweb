<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminTypeProductRequest extends FormRequest
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
            'tp_name' => 'required|max:190|min:3|unique:type_products,tp_name,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'tp_name.required' => 'Dữ Liệu không để trống',
            'tp_name.unique' => 'Dữ Liệu đã tồn tại',
            'tp_name.max' => 'dữ liệu không quá 190 ký tự',
            'tp_name.min' => 'dữ liệu phải nhiều hơn 3 ký tự',
        ];
    }
}
