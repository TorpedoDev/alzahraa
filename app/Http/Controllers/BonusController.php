<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\BonusRequest;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bonuses = Bonus::orderBy("created_at", "DESC")->paginate(16);
        return view('bonus.index' , compact('bonuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('bonus.create' , compact('employees'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BonusRequest $request)
    {
        $data = $request->validated();
        Bonus::create([
            'user_id' => Auth::user()->id,
            'employee_id' => $data['employee_id'],
            'reason' => $data['reason'],
            'value' => $data['value'],
        ]);
        return redirect()->route('bonus.index')->with('success' , 'تم إضافة حافز الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bonus $bonus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bonus = Bonus::find($id);
        $employees = Employee::all();
        return view('bonus.edit' , compact('employees' , 'bonus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BonusRequest $request,  $id)
    {
        $bonus = Bonus::find($id);
        $data = $request->validated();
        $bonus->update([
            'user_id' => Auth::user()->id,
            'employee_id' => $data['employee_id'],
            'reason' => $data['reason'],
            'value' => $data['value'],
        ]);
        return redirect()->route('bonus.index')->with('success' , 'تم تعديل حافز الموظف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bonus = Bonus::find($id);
        $bonus->delete();
        return redirect()->back()->with('success' , 'تم حذف حافز الموظف بنجاح');
    }
}
