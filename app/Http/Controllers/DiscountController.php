<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DiscountRequest;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::orderBy('created_at' , 'DESC')->paginate(16);
        return view('discount.index' , compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('discount.create' , compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountRequest $request)
    {
        $data = $request->validated();
        Discount::create([
            'user_id' => Auth::user()->id,
            'employee_id' => $data['employee_id'],
            'reason' => $data['reason'],
            'value' => $data['value'],
        ]);
        return redirect()->route('discount.index')->with('success' , 'تم إضافة خصم الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $discount = Discount::find($id);
        $employees = Employee::all();
        return view('discount.edit' , compact('employees' , 'discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountRequest $request, $id)
    {
        $discount = Discount::find($id);
        $data = $request->validated();
        $discount->update([
            'user_id' => Auth::user()->id,
            'employee_id' => $data['employee_id'],
            'reason' => $data['reason'],
            'value' => $data['value'],
        ]);
        return redirect()->route('discount.index')->with('success' , 'تم تعديل خصم الموظف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);
        $discount->delete();
        return redirect()->back()->with('success' , 'تم حذف  خصم الموظف بنجاح');
    }
}
