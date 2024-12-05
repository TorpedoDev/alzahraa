<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerDebtPayRequest;
use App\Models\Customer;
use App\Models\CustomerDebt;
use Illuminate\Http\Request;
use App\Models\CustomerDebtPay;
use Illuminate\Support\Facades\Auth;

class CustomerDebtPayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customerDebtPays = CustomerDebtPay::orderBy('date' , 'DESC')->paginate(16);
       return view('customerdebtpay.index' , compact('customerDebtPays'));
    }



    public function getPay($id)
    {
        
        $debt = CustomerDebt::find($id);
        return view('customerdebtpay.getpay' , compact('debt'));
    }



    public function Pay(CustomerDebtPayRequest $request , $id)
    {
        $debt = CustomerDebt::find($id);
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

        CustomerDebtPay::create([
            'debt_id' => $id,
            'user_id' => Auth::user()->id,
            'value' => $data['value'],
            'date' => $data['date']
        ]);



        return redirect()->route('customerdebtpay.index')->with('success' , 'تم إضافة مبلغ سداد السلفة بنجاح');

    }



    public function edit($id)
    {
        $customerDebtPay = CustomerDebtPay::find($id);
        $customers = Customer::whereHas('debts')->get();
        return view('customerdebtpay.edit' , compact('customers' , 'customerDebtPay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerDebtPayRequest $request,  $id)
    {
        $customerDebtPay = CustomerDebtPay::find($id);
        $data = $request->validated();

 
     

        if($data["value"] > ($customerDebtPay->debt->rest + $customerDebtPay->value))
        {
           return redirect()->back()->with("error" , "المبلغ المدفوع أكبر من المبلغ المتبقي في السلف");
        }



        if($data["value"] == ($customerDebtPay->debt->rest + $customerDebtPay->value))
        {
            $customerDebtPay->debt->is_paid = 1;
            $customerDebtPay->debt->save();        
        }else{
            $customerDebtPay->debt->is_paid = 0;
            $customerDebtPay->debt->save();    
        }



       $customerDebtPay->debt->paid -= $customerDebtPay->value;
        $customerDebtPay->debt->paid += $request->value;

        $customerDebtPay->debt->rest += $customerDebtPay->value;
        $customerDebtPay->debt->rest -= $request->value; 
        $customerDebtPay->debt->save();

        $customerDebtPay->update([
            'user_id' => Auth::user()->id,
            'value' => $data['value'],
            'date' => $data['date']

        ]);
        return redirect()->route('customerdebtpay.index')->with('success' , 'تم تعديل مبلغ سداد السلفة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customerDebtPay = CustomerDebtPay::find($id);
        $customerDebtPay->debt->paid -= $customerDebtPay->value;
        $customerDebtPay->debt->rest += $customerDebtPay->value;
        $customerDebtPay->debt->save();
        $customerDebtPay->delete();
        return redirect()->back()->with('success' , 'تم حذف  مبلغ سداد السلفة بنجاح');
    }


  
}
