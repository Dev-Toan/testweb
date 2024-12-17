<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProductRequest extends FormRequest
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
            'pro_name' => 'required|max:190|min:3|unique:products,pro_name,' . $this->id,
            'pro_price' => 'required',
            'pro_sale' => 'between:0,2',
            'pro_avatar' => 'image',
            'pro_description' => 'required',
            'pro_content' => 'required',
            'pro_category_id' => 'required',
            'pro_country' => 'required',
            'pro_number' => 'required',
            'pro_type_product_id' => 'required',
            'file.*' => 'image',
        ];
    }
    public function messages()
    {
        return [
            'pro_name.required' => 'Dữ Liệu không để trống',
            'pro_name.unique' => 'Dữ Liệu đã tồn tại',
            'pro_name.max' => 'dữ liệu không quá 190 ký tự',
            'pro_name.min' => 'dữ liệu phải nhiều hơn 3 ký tự',
            'pro_price.required' => 'Dữ Liệu không để trống',
            'pro_description.required' => 'Dữ Liệu không để trống',
            'pro_content.required' => 'Dữ Liệu không để trống',
            'pro_category_id.required' => 'Dữ Liệu không để trống',
            'pro_country.required' => 'Dữ Liệu không để trống',
            'pro_number.required' => 'Dữ Liệu không để trống',
            'pro_type_product_id.required' => 'Dữ Liệu không để trống',
            'pro_avatar.image' => 'Định dạng hình ảnh sai !',
            'file.*.image' => 'Định dạng hình ảnh sai !',
            'pro_sale.between' => 'Giá trị phải nằm trong khoảng 0-99 !',
        ];
    }
}
