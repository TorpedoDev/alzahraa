<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TraderRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            $nameValidation = ["required", "string", "max:200", "unique:traders,name,".$this->trader];
            $phoneValidation = ["nullable", "string", "min:6", "max:11", "unique:traders,phone,".$this->trader];
        } else {
            // dd($this->request);
            $nameValidation = ["required", "string", "max:200", "unique:traders,name"];  //
            $phoneValidation = ["nullable", "string", "min:6", "max:11", "unique:traders,phone"]; //
        }

        return [
            "name" => $nameValidation,
            "address" => ["nullable", "string", "max:230"],
            "phone" => $phoneValidation,
            "type" => ["required"],
            "cow_pont_price" => ["nullable", "numeric" , "gt:0"],
            "buffalo_pont_price" => ["nullable", "numeric" , "gt:0"],
            "cow_kilo_price" => ["nullable", "numeric" , "gt:0"],
            "buffalo_kilo_price" => ["nullable", "numeric" , "gt:0"],
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "يرجى إدخال اسم التاجر",
            "name.string" => "يرجى إدخال اسم صحيح",
            "name.max" => "يجب اﻻ يزيد اسم التاجر عن 200 حرف",
            "name.unique" => "هذا التاجر موجود بالفعل",
            "address.string" => "يرجى إدخال عنوان صحيح",
            "address.max" => "يجب اﻻ يزيد العنوان عن 230 حرف",
            "phone.string" => "يرحى إدخال رقم تليفون صحيح",
            "phone.max" => "يجب اﻻ يزيد رقم التليفون عن 11 رقم",
            "phone.unique" => "هذا الرقم مسجل لتاجر آخر",
            "type.required" => "يجب إدخال نوع التعامل مع التاجر",
            "cow_pont_price.numeric" => "يرجى إدخال سعر بنط صحيح",
            "cow_pont_price.gt" => "يرجى إدخال سعر بنط صحيح",
            "buffalo_pont_price.numeric" => "يرجى إدخال سعر بنط صحيح",
            "buffalo_pont_price.gt" => "يرجى إدخال سعر بنط صحيح",
            "cow_kilo_price.numeric" => "يرجى إدخال سعر كيلو صحيح",
            "cow_kilo_price.gt" => "يرجى إدخال سعر كيلو صحيح",
            "buffalo_kilo_price.numeric" => "يرجى إدخال سعر كيلو صحيح",
            "buffalo_kilo_price.gt" => "يرجى إدخال سعر كيلو صحيح",


        ];
    }
}
