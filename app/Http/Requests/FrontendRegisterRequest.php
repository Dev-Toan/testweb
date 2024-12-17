<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontendRegisterRequest extends FormRequest
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
            'email'     => 'required|min:7|unique:users,email,' . $this->id,
            'name'      => 'required',
            'phone'     => 'required|unique:users,phone',
            'password'  => 'required'
        ];
    }
    public function messages()
    {
        return [
            'email.required'        => 'Dữ liệu không để trống',
            'email.unique'          => 'Email đã tồn tại',
            'email.min'             => 'Dữ liệu quá ngắn',
            'name.required'         => 'Dữ liệu không để trống',
            'phone.unique'          => 'Số Điện Thoại đã tồn tại',
            'phone.required'        => 'Dữ liệu không để trống',
            'password.required'     => 'Dữ liệu không để trống',
        ];
    }
}
