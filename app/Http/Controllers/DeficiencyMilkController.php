<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeficiencyMilk;
use Illuminate\Support\Facades\Auth;

class DeficiencyMilkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $deficiencyMilk = DeficiencyMilk::orderBy('date' , 'DESC')->paginate(16);
        return view('deficiencymilk.index' , compact('deficiencyMilk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('deficiencymilk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'driver' => 'required|string',
            'value' => 'required|numeric|gt:0',
            'type' => 'required',
            'date' => 'required|date',
        ] , [
            'driver.required' => 'يجب إدخال اسم السائق',
            'driver.string' => 'يجب إدخال اسم سائق صحيحاً',
            'value.required' => 'يجب إدخال قيمة العجز',
            'value.numeric' => 'يجب إدخال قيمة عجز صحيحة',
            'value.gt' => 'يجب إدخال قيمة عجز صحيحة',
            'type.required' => 'يجب تحديد نوع اللبن',
            'date.required' => 'يجب إدخال تاريخ العجز',
            'date.date' => 'يجب إدخال تاريخ عجز صالح',
        ]);
        $data = $request->all();
         unset($data['_token']);
        $data['user_id'] = Auth::user()->id;
        DeficiencyMilk::create($data);
        return redirect()->route('deficiencymilk.index')->with('success' , 'تم إضافة العجز بنجاح....إذا كنت ترغب بخصم العجز قم بإضافة خصم على الموظف المتسبب في العجز');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeficiencyMilk $deficiencyMilk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $deficiencyMilk = DeficiencyMilk::find($id);

        return view('deficiencymilk.edit' , compact('deficiencyMilk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $deficiencyMilk = DeficiencyMilk::find($id);
        $request->validate([
            'driver' => 'required|string',
            'value' => 'required|numeric|gt:0',
            'type' => 'required',
            'date' => 'required|date',
        ] , [
            'driver.required' => 'يجب إدخال اسم السائق',
            'driver.string' => 'يجب إدخال اسم سائق صحيحاً',
            'value.required' => 'يجب إدخال قيمة العجز',
            'value.numeric' => 'يجب إدخال قيمة عجز صحيحة',
            'value.gt' => 'يجب إدخال قيمة عجز صحيحة',
            'type.required' => 'يجب تحديد نوع اللبن',
            'date.required' => 'يجب إدخال تاريخ العجز',
            'date.date' => 'يجب إدخال تاريخ عجز صالح',
        ]);
         $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $deficiencyMilk->update($data);
        return redirect()->route('deficiencymilk.index')->with('success' , 'تم تعديل العجز بنجاح....قم بتعديل خصم العجز المضاف على الموظف المتسبب في العجز');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deficiencyMilk = DeficiencyMilk::find($id);
        $deficiencyMilk->delete();
        return redirect()->route('deficiencymilk.index')->with('success' , 'تم حذف العجز بنجاح....قم بحذف خصم العجز المضاف على الموظف المتسبب في العجز');
    }
}
