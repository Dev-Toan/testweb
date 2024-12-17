<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSlideRequest extends FormRequest
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
            'sd_title'              => 'required|max:190|min:3|unique:slides,sd_title,' . $this->id,
            'sd_link'               => 'required',
        ];
    }
    public function messages()
    {
        return [
            'sd_title.required' => 'Dữ Liệu không để trống',
            'sd_title.unique' => 'Dữ Liệu đã tồn tại',
            'sd_title.max' => 'dữ liệu không quá 190 ký tự',
            'sd_title.min' => 'dữ liệu phải nhiều hơn 3 ký tự',
        ];
    }
}
