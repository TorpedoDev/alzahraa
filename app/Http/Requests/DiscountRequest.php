<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'employee_id' => ['required' , 'numeric'],
            'reason' => ['required' , 'string'],
            'value' => ['required' , 'numeric' , "gt:0"],
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'يجب إدخال اسم الموظف',
            'reason.required' => 'يجب إدخال سبب الخصم',
            'reason.sting' => 'يرجى إدخال سبب خصم صحيح',
            'value.required' => 'يجب ادخال قيمة الخصم',
            'value.numeric' => 'يرجى إدخال قيمة خصم صحيحة',
            'value.gt' => 'يرجى إدخال قيمة خصم صحيحة',

        ];
    }
}
