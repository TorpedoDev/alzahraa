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
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $nameRule = 'nullable|string|unique:users,name,'.$this->user;
            $emailRule = 'nullable|email|unique:users,email,'.$this->user;
            $passwordRule = 'nullable|min:6';
            $password_confirmationRule = 'required_with:password|same:password';
            $roleRule = 'nullable';
        } else {
            $nameRule = 'required|string|unique:users,name';
            $emailRule = 'required|email|unique:users,email';
            $passwordRule = 'required|min:6';
            $password_confirmationRule = 'required|same:password';
            $roleRule = 'required';

        }
        
        return [
            'name' => $nameRule,
            'email' => $emailRule,
            'password' => $passwordRule,
            'password_confirmation' => $password_confirmationRule,
            'role' => $roleRule,

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب إدخال اسم المستخدم',
            'name.string' => 'برجاء إدخال اسم مستخدم صالح',
            'name.unique' => 'هذا الاسم موجود بالفعل لمستخدم آخر',
            'email.required' => 'يجب إدخال البريد الالكتروني',
            'email.email' => 'برجاء إدخال بريد إلكتروني صالح',
            'email.unique' => 'هذا البريد موجود بالفعل لمستخدم آخر',
            'password.required' => 'يجب إدخال كلمة المرور',
            'password.min' => 'يجب ألا تقل كلمة المرور عن 6 أحرف أو أرقام',
            'password_confirmation.required' => 'يجب تأكيد كلمة المرور',
            'password_confirmation.required_with' => 'يجب تأكيد كلمة المرور',
            'password_confirmation.same' => 'كلمة المرور وتأكيد كلمة المرور غير متطابقان',
            'role.required' => 'يجب إدخال نوع المستخدم',

        ];
    }
}
