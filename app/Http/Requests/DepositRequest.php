<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
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
            'customer_id' => ['required' , 'numeric'],
            'value' => ['required' , 'numeric' , "gt:0"],
            'date' => ['required' , 'date']
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'يجب إدخال اسم العميل',
            'value.required' => 'يجب ادخال قيمة الأرضية',
            'value.numeric' => 'يرجى إدخال قيمة أرضية صحيحة',
            'value.gt' => 'يرجى إدخال قيمة أرضية صحيحة',
            'date.required' => 'يجب إدخال التاريخ',
            'date.date' => 'يجب إدخال تاريخ صحيح' ,
        ];
    }
}
