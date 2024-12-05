<?php

namespace App\Http\Controllers;

use App\Models\Trader;
use App\Models\TraderPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TraderPayRequest;

class TraderPayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pays = TraderPay::orderBy('created_at' , 'DESC')->paginate(16);
        return view('traderpay.index', compact('pays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $traders = Trader::all();
        return view('traderpay.create', compact('traders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TraderPayRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $trader = Trader::find($data['trader_id']);
        if ($trader->debt < $data['value']) {
            return redirect()->back()->with('error', 'المبلغ المدفوع أكبر من قيمة الدين المسجلة على التاجر');
        }
        TraderPay::create($data);
        $trader->debt -= $data['value'];
        $trader->save();
        return redirect()->route('traderpay.index')->with('success', 'تم إضافة المبلغ المدفوع وخصمه من ديون التاجر بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(TraderPay $traderPay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $traderPay = TraderPay::find($id);
        $traders = Trader::all();
        return view('traderpay.edit', compact('traders', 'traderPay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TraderPayRequest $request, $id)
    {
        $traderpay = TraderPay::find($id);
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $trader = Trader::find($data['trader_id']);
        if (($trader->debt + $traderpay->value)  < $data['value']) {
            return redirect()->back()->with('error', 'المبلغ المدفوع أكبر من قيمة الدين المسجلة على التاجر');
        }
        $trader->debt += $traderpay->value;
        $trader->save();
        $traderpay->update($data);
        $trader->debt -= $data['value'];
        $trader->save();
        return redirect()->route('traderpay.index')->with('success', 'تم تعديل المبلغ المدفوع وتعديل خصمه من ديون التاجر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $traderPay = TraderPay::find($id);
        $trader = Trader::find($traderPay->trader_id);
        $trader->debt += $traderPay->value;
        $trader->save();
        $traderPay->delete();
        return redirect()->back()->with('success', 'تم حذف المبلغ المدفوع وإلغاء خصمه من ديون التاجر بنجاح');
    }
}
