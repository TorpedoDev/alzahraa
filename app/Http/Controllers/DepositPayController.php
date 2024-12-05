<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Customer;
use App\Models\DepositPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DepositPayRequest;

class DepositPayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $depositPays = DepositPay::orderBy('date' , 'DESC')->paginate(16);
       return view('depositpay.index' , compact('depositPays'));
    }


    public function getPay($id)
    {
        
        $deposit = Deposit::find($id);
        return view('depositpay.getpay' , compact('deposit'));
    }


    public function Pay(DepositPayRequest $request , $id)
    {
        $deposit = Deposit::find($id);
        $data = $request->validated();

    if($deposit->rest < $data['value']){
        return redirect()->back()->with("error" , "المبلغ المدفوع أكبر من المبلغ المتبقي في الأرضية");
    }

    if($deposit->rest == $data['value']){
        $deposit->is_paid = 1;
        $deposit->save();
    }else{
        $deposit->is_paid = 0;
        $deposit->save();
    }

        $deposit->paid += $data['value'];
        $deposit->rest -= $data['value']; 
        $deposit->save();

        DepositPay::create([
            'deposit_id' => $id,
            'user_id' => Auth::user()->id,
            'value' => $data['value'],
            'date' => $data['date']
        ]);



        return redirect()->route('depositpay.index')->with('success' , 'تم إضافة مبلغ سداد الأرضية بنجاح');

    }



  

    /**
     * Display the specified resource.
     */
    public function show(DepositPay $depositPay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $depositPay = DepositPay::find($id);
        $deposits = Deposit::all();
        return view('depositpay.edit' , compact('deposits' , 'depositPay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepositPayRequest $request, $id)
    {
        $customerDepositPay = DepositPay::find($id);
        $data = $request->validated();

 
     

        if($data["value"] > ($customerDepositPay->deposit->rest + $customerDepositPay->value))
        {
           return redirect()->back()->with("error" , "المبلغ المدفوع أكبر من المبلغ المتبقي في الأرضية");
        }



        if($data["value"] == ($customerDepositPay->deposit->rest + $customerDepositPay->value))
        {
            $customerDepositPay->deposit->is_paid = 1;
            $customerDepositPay->deposit->save();        
        }else{
            $customerDepositPay->deposit->is_paid = 0;
            $customerDepositPay->deposit->save();    
        }



       $customerDepositPay->deposit->paid -= $customerDepositPay->value;
        $customerDepositPay->deposit->paid += $request->value;

        $customerDepositPay->deposit->rest += $customerDepositPay->value;
        $customerDepositPay->deposit->rest -= $request->value; 
        $customerDepositPay->deposit->save();

        $customerDepositPay->update([
            'user_id' => Auth::user()->id,
            'value' => $data['value'],
            'date' => $data['date']

        ]);
        return redirect()->route('depositpay.index')->with('success' , 'تم تعديل مبلغ سداد اﻻرضية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customerDepositPay = DepositPay::find($id);
        $customerDepositPay->deposit->paid -= $customerDepositPay->value;
        $customerDepositPay->deposit->rest += $customerDepositPay->value;
        $customerDepositPay->deposit->save();
        $customerDepositPay->delete();
        return redirect()->back()->with('success' , 'تم حذف  مبلغ سداد اﻻرضية بنجاح');
    }
}
