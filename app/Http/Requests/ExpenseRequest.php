<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'reason' => ['required' , 'string'],
            'value' => ['required' , 'numeric' , "gt:0"],
        ];
    }


    public function messages()
    {
        return [
            'reason.required' => 'يجب إدخال بند المصروف',
            'reason.sting' => 'يرجى إدخال بند مصروف صحيح',
            'value.required' => 'يجب ادخال قيمة المصروف',
            'value.numeric' => 'يرجى إدخال قيمة مصروف صحيحة',
            'value.gt' => 'يرجى إدخال قيمة مصروف صحيحة',

        ];
    }
}
