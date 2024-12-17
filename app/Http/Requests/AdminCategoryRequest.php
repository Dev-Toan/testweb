<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCategoryRequest extends FormRequest
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
            'c_name' => 'required|max:190|min:3|unique:categories,c_name,' . $this->id,
        ];
    }
    public function messages()
    {
        return [
            'c_name.required' => 'Dữ Liệu không để trống',
            'c_name.unique' => 'Dữ Liệu đã tồn tại',
            'c_name.max' => 'dữ liệu không quá 190 ký tự',
            'c_name.min' => 'dữ liệu phải nhiều hơn 3 ký tự',
        ];
    }
}
