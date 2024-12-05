<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'name' => ['required' , 'string' , Rule::unique('users')->ignore(Auth::user()->id)],
            'email' => ['required' , 'email' , Rule::unique('users')->ignore(Auth::user()->id)],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يجب إدخال اسم المسنخدم',
            'name.string' => 'يجب إدخال اسم مستخدم صالح',
            'name.unique' => 'اسم المستخدم الذي أدخلته مأخوذ من قبل',
            'name.required' => 'يجب إدخال البريد الالكتروني',
            'name.email' => 'يجب إدخال بريد الكتروني صالح',
            'name.unique' => 'البريد الالكتروني الذي أدخلته مأخوذ من قبل',
        ];
    }
}
