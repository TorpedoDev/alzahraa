<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerDebt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerDebtRequest;
use App\Models\CustomerDebtPay;

class CustomerDebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customerDebts = CustomerDebt::orderBy('created_at' , 'DESC')->paginate(16);
        return view('customerdebt.index' , compact('customerDebts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('line' , 'ASC')->orderBy('created_at' , 'ASC')->get();
        return view('customerdebt.create' , compact('customers'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerDebtRequest $request)
    {
        $data = $request->validated();
        CustomerDebt::create([
            'user_id' => Auth::user()->id,
            'customer_id' => $data['customer_id'],
            'value' => $data['value'],
            'date' => $data['date'],
            'rest' => $data['value']
        ]);
        return redirect()->route('customerdebt.index')->with('success' , 'تم إضافة سلفة العميل بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerDebt $customerDebt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $customerDebt = CustomerDebt::find($id);
        $customers = Customer::orderBy('line' , 'ASC')->orderBy('created_at' , 'ASC')->get();
        return view('customerdebt.edit' , compact('customers' , 'customerDebt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerDebtRequest $request,  $id)
    {
        $customerDebt = CustomerDebt::find($id);
        $customerDebtPays = CustomerDebtPay::where('debt_id' , $id)->sum('paid');
        $data = $request->validated();
        $customerDebt->update([
            'user_id' => Auth::user()->id,
            'customer_id' => $data['customer_id'],
            'value' => $data['value'],
            'date' => $data['date'],
            'rest' => $data['value'] - $customerDebtPays

        ]);
        return redirect()->route('customerdebt.index')->with('success' , 'تم تعديل سلفة العميل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $customerDebt = CustomerDebt::find($id);
        $customerDebtPays = CustomerDebtPay::where('debt_id' , $id )->get();
        foreach($customerDebtPays as $pay)
        {
            $pay->delete();
        }
        $customerDebt->delete();
        return redirect()->back()->with('success' , 'تم حذف  سلفة العميل والسداد الخاص بها بنجاح');
    }
}
