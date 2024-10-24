<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'min:4', 'max:50'],
            'email' =>  ['email'],
            'password' => ['max:30'],
        ];
        if ($this->method() === 'POST') {
            array_push($rules['email'], 'required', 'unique:users,email');
            array_push($rules['password'], 'required', 'min:8');
        }
        return $rules;
    }

    function messages()
    {
        return [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'name.required' => 'Tên hiển thị không được để trống',
            'name.min' => 'Tên hiển thị phải có ít nhất 4 ký tự',
            'name.max' => 'Tên hiển thị phải có tối đa 50 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.max' => 'Mật khẩu phải có tối đa 30 ký tư'
        ];
    }
}
