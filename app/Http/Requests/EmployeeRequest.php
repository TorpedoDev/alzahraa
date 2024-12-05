<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        if($this->method() == 'PUT'){
            $nameValidation = ["required" , "string" , "max:200" , "unique:employees,name,".$this->employee];
            $phoneValidation = ["nullable" , "string" , "min:6" ,"max:11" ,"unique:employees,phone,".$this->employee];
        }else{
            $nameValidation = ["required" , "string" , "max:200" , "unique:employees,name"];
            $phoneValidation = ["nullable" , "string" , "min:6" ,"max:11" ,"unique:employees,phone"];
        }
        return [
            "name" => $nameValidation,
            "address" => ["nullable" , "string" , "max:230"],
            "phone" => $phoneValidation,
            "sheft_sal" => ["required" , "numeric" , "gt:0"],
        ];
    }

    public function messages()
    {
        return [
          "name.required" => "يرجى إدخال اسم الموظف",
          "name.string" => "يرجى إدخال اسم صحيح",
          "name.max" => "يجب اﻻ يزيد اسم الموظف عن 200 حرف",
          "name.unique" => "هذا الموظف موجود بالفعل",
          "address.string" => "يرجى إدخال عنوان صحيح" ,
          "address.max" => "يجب اﻻ يزيد العنوان عن 230 حرف",
          "phone.string" => "يرحى إدخال رقم تليفون صحيح",
          "phone.max" => "يجب اﻻ يزيد رقم التليفون عن 11 رقم",
          "phone.unique" => "هذا الرقم مسجل لموظف آخر",
          "sheft_sal.required" => "يرجى إدخال سعر الشيفت الخاص بالموظف",
          "sheft_sal.numeric" => "يرجى إدخال سعر صحيح",
          "sheft_sal.gt" => "يرجى إدخال سعر صحيح",

        ];
    }
}
