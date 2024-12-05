<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DepositRequest;
use App\Models\DepositPay;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deposits = Deposit::orderBy('date' , 'DESC')->paginate(16);
        return view('deposit.index' , compact('deposits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('line' , 'ASC')->orderBy('created_at' , 'ASC')->get();
        return view('deposit.create' , compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepositRequest $request)
    {
        $data = $request->validated();
        Deposit::create([
            'user_id' => Auth::user()->id,
            'customer_id' => $data['customer_id'],
            'value' => $data['value'],
            'date' => $data['date'],
            'rest' => $data['value']
        ]);
        return redirect()->route('deposit.index')->with('success' , 'تم إضافة أرضية العميل بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deposit $deposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $deposit = Deposit::find($id);
        $customers = Customer::orderBy('line' , 'ASC')->orderBy('created_at' , 'ASC')->get();
        return view('deposit.edit' , compact('customers' , 'deposit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepositRequest $request, $id)
    {
        $deposit = Deposit::find($id);
        $depositPays = DepositPay::where('deposit_id' , $id)->sum('value');
        $data = $request->validated();
        $deposit->update([
            'user_id' => Auth::user()->id,
            'customer_id' => $data['customer_id'],
            'value' => $data['value'],
            'date' => $data['date'],
            'rest' => $data['value'] - $depositPays
        ]);
        return redirect()->route('deposit.index')->with('success' , 'تم تعديل أرضية العميل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deposit = Deposit::find($id);
        $depositPays = DepositPay::where('deposit_id' , $id )->get();
        foreach($depositPays as $pay)
        {
            $pay->delete();
        }
        $deposit->delete();
        return redirect()->back()->with('success' , 'تم حذف  أرضية العميل والسداد الخاص بها بنجاح');
    }
}
