<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TraderPayRequest extends FormRequest
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
            'trader_id' => ['required' , 'numeric'],
            'value' => ['required' , 'numeric' , "gt:0"],
        ];
    }


    public function messages()
    {
        return [
            'trader_id.required' => 'يجب إدخال اسم التاجر',
            'value.required' => 'يجب ادخال المبلغ المدفوع',
            'value.numeric' => 'يرجى إدخال قيمة دفع صحيحة',
            'value.gt' => 'يرجى إدخال قيمة دفع صحيحة',

        ];
    }
}
