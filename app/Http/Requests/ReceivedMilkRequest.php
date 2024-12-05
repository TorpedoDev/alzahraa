<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceivedMilkRequest extends FormRequest
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
            "customer_id" => ["required" , "numeric"],
            "buffalo_milk_qty" => ["nullable" , "numeric" , "gt:0"],
            "cow_milk_qty" => ["nullable" , "numeric" , "gt:0"],
            "buffalo_pont" => ["nullable" , "numeric" , "gt:0"],
            "cow_pont" => ["nullable" , "numeric" , "gt:0"],
            "date" => ["required" , "date"],
            "period" => ["required"],
            "notes" => ["nullable" , "string"],
        ];
    }

    public function messages()
    {
        return [
            "customer_id.required" => "يجب اختيار اسم العميل" ,
            "customer_id.numeric" => "يجب اختيار اسم العميل بشكل صحيح" ,
            "buffalo_milk_qty.numeric" => "يجب إدخال كمية اللبن الجاموسي بشكل صحيح" ,
            "buffalo_milk_qty.gt" => "يجب إدخال كمية اللبن الجاموسي بشكل صحيح" ,
            "cow_milk_qty.numeric" => "يجب إدخال كمية اللبن البقري بشكل صحيح" ,
            "cow_milk_qty.gt" => "يجب إدخال كمية اللبن البقري بشكل صحيح" ,
            "buffalo_pont.numeric" => "يجب إدخال بنط اللبن الجاموسي بشكل صحيح" ,
            "buffalo_pont.gt" => "يجب إدخال بنط اللبن الجاموسي بشكل صحيح" ,
            "cow_pont.numeric" => "يجب إدخال بنط اللبن البقري بشكل صحيح" ,
            "cow_pont.gt" => "يجب إدخال بنط اللبن البقري بشكل صحيح" ,
            "date.required" => "يجب إدخال تاريخ استلام اللبن" ,
            "date.date" => "يجب إدخال تاريخ استلام اللبن بشكل صحيح" ,
            "period.required" => "يجب اختيار فترة استلام اللبن صباحية أم مسائية" ,
            "notes.string" => "يجب كتابة ملاحظات استلام اللبن بشكل صحيح" ,
        ];
    }
}
