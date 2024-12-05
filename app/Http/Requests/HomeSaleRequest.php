<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeSaleRequest extends FormRequest
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
            'product' => ['required' , 'string'],
            'quantity' => ['required' , 'numeric' , 'gt:0'],
            'price' => ['required' , 'numeric' , 'gt:0'],
            'date' => ['required' , 'date']
        ];
    }

    public function messages()
    {
        return [
            'product.required' => 'من فضلك أدخل اسم المنتج',
            'product.string' => 'من فضلك أدخل اسم منتج صحيح',
            'quantity.required' => 'من فضلك أدخل الكمية',
            'quantity.numeric' => 'من فضلك أدخل كمية صحيحة',
            'quantity.gt' => 'من فضلك أدخل كمية صحيحة',
            'price.required' => 'من فضلك أدخل السعر',
            'price.numeric' => 'من فضلك أدخل سعر صحيح',
            'price.gt' => 'من فضلك أدخل سعر صحيح',
            'date.required' => 'يجب إدحال التاريخ',
            'date.date' => 'يجب إدخال تاريخ صالح',
        ];
    }
}
