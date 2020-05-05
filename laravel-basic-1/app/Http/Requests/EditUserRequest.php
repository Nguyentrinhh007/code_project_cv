<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'email'=>'required|email|min:5|unique:users,email,'.$this->id_user.',id',
            'full'=>'required|min:3',
            'phone'=>'required|unique:users,phone,'.$this->id_user.',id',
            'address'=>'required|min:8',
           

        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Không được để trống email',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email không được trùng',
            'full.required'=>'Không được để trống Họ và tên',
            'full.min'=>'Họ tên không được nhỏ hơn 5 ký tự',
            'phone.required'=>'Số điện thoại không được để trống',
            'phone.unique'=>'Số điện thoại không được để trùng',
            'address.required'=>'Địa chỉ không được để trống',
            'address.min'=>'Địa chỉ không được nhỏ hơn 8 ký tự',
        ];
    }
}
