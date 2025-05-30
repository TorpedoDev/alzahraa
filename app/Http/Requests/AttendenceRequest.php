<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendenceRequest extends FormRequest
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
            'period' => ['required'],
            'date' => ['required' , 'date']
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'يجب إدخال اسم الموظف',
            'period.required' => 'يجب إدخال الفترة',
            'date.required' => 'يجب إدخال التاريخ',
            'date.date' => 'يجب إدخال تاريخ صالح',
        ];
    }
}
