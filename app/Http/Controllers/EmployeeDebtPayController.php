<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeDebt;
use Illuminate\Http\Request;
use App\Models\EmployeeDebtPay;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EmployeeDebtPayRequest;

class EmployeeDebtPayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeDebtPays = EmployeeDebtPay::orderBy('date' , 'DESC')->paginate(16);
       return view('employeedebtpay.index' , compact('employeeDebtPays'));
    }

  


    public function getPay($id)
    {
        
        $debt = EmployeeDebt::find($id);
        return view('employeedebtpay.getpay' , compact('debt'));
    }

    public function Pay(EmployeeDebtPayRequest $request , $id)
    {
        $debt = EmployeeDebt::find($id);
        $data = $request->validated();

    if($debt->rest < $data['value']){

        return redirect()->back()->with("error" , "المبلغ المدفوع أكبر من المبلغ المتبقي في السلفة");
    }

    if($debt->rest == $data['value']){
        $debt->is_paid = 1;
        $debt->save();
    }else{
        $debt->is_paid = 0;
        $debt->save();
    }

        $debt->paid += $data['value'];
        $debt->rest -= $data['value']; 
        $debt->save();

        EmployeeDebtPay::create([
            'debt_id' => $id,
            'user_id' => Auth::user()->id,
            'value' => $data['value'],
            'date' => $data['date']
        ]);



        return redirect()->route('employeedebtpay.index')->with('success' , 'تم إضافة مبلغ سداد السلفة بنجاح');

    }



    public function edit($id)
    {
        $employeeDebtPay = EmployeeDebtPay::find($id);
        $employees = Employee::whereHas('debts')->get();
        return view('employeedebtpay.edit' , compact('employees' , 'employeeDebtPay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeDebtPayRequest $request, $id)
    {
        $employeeDebtPay = EmployeeDebtPay::find($id);
        $data = $request->validated();


     
        if($data["value"] > ($employeeDebtPay->debt->rest + $employeeDebtPay->value))
        {
           return redirect()->back()->with("error" , "المبلغ المدفوع أكبر من المبلغ المتبقي في السلف");
        }



        if($data["value"] == ($employeeDebtPay->debt->rest + $employeeDebtPay->value))
        {
            $employeeDebtPay->debt->is_paid = 1;
            $employeeDebtPay->debt->save();        
        }else{
            $employeeDebtPay->debt->is_paid = 0;
            $employeeDebtPay->debt->save(); 
        }


       $employeeDebtPay->debt->paid -= $employeeDebtPay->value;
       $employeeDebtPay->debt->paid += $request->value;

       $employeeDebtPay->debt->rest += $employeeDebtPay->value;
       $employeeDebtPay->debt->rest -= $request->value; 
       $employeeDebtPay->debt->save();


        $employeeDebtPay->update([
            'user_id' => Auth::user()->id,
            'value' => $data['value'],
            'date' => $data['date'],

        ]);
        return redirect()->route('employeedebtpay.index')->with('success' , 'تم تعديل مبلغ سداد السلفة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employeeDebtPay = EmployeeDebtPay::find($id);
        $employeeDebtPay->debt->paid -= $employeeDebtPay->value;
        $employeeDebtPay->debt->rest += $employeeDebtPay->value;
        $employeeDebtPay->debt->save();
        $employeeDebtPay->delete();
        return redirect()->back()->with('success' , 'تم حذف  مبلغ سداد السلفة بنجاح');
    }
}
