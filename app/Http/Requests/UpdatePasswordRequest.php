<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
        return [
            'old_password' => ['required'],
            'new_password' => ['required' , 'min:6'],
            'new_password_confirmation' => ['required' , 'same:new_password']
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'يجب إدخال كلمة المرور الحالية',
            'new_password.required' => 'يجب إدخال كلمة المرور الجديدة',
            'new_password.min' => 'يجب أن تكون كلمة المرور أكثر من 6 أحرف أو أرقام',
            'new_password_confirmation.required' => 'يجب إدخال تأكيد كلمة المرور الجديدة',
            'new_password_confirmation.min' => 'يجب إدخال كلمة المرور الحالية',
            'new_password_confirmation.same' => 'كلمة المرور الجديدة وتأكيد كلمة المرور الجديدة غير متطابقان',


        ];
    }
}
