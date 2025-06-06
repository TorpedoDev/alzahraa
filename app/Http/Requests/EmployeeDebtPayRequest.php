<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeDebtPayRequest extends FormRequest
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
            'value' => ['required' , 'numeric' , "gt:0"],  
            'date' => ['required' , 'date']
      
        ];
    }

    public function messages()
    {
        return [
            'value.required' => 'يجب ادخال قيمة السداد',
            'value.numeric' => 'يرجى إدخال قيمة سداد صحيحة',
            'value.gt' => 'يرجى إدخال قيمة سداد صحيحة',
            'date.required' => 'يجب إدخال التاريخ',
            'date.date' => 'يجب إدخال تاريخ صحيح' ,
        ];
    }
}
