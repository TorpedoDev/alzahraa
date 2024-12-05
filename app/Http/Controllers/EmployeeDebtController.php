<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeDebt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EmployeeDebtRequest;
use App\Models\EmployeeDebtPay;

class EmployeeDebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeDebts = EmployeeDebt::orderBy('date' , 'DESC')->paginate(16);
        return view('employeedebt.index' , compact('employeeDebts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $employees = Employee::all();
        return view('employeedebt.create' , compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeDebtRequest $request)
    {
        $data = $request->validated();
        
        EmployeeDebt::create([
            'user_id' => Auth::user()->id,
            'employee_id' => $data['employee_id'],
            'value' => $data['value'],
            'date' => $data['date'],
            'rest' => $data['value']
        ]);
        return redirect()->route('employeedebt.index')->with('success' , 'تم إضافة سلفة الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeDebt $employeeDebt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employeeDebt = EmployeeDebt::find($id);
        $employees = Employee::all();
        return view('employeedebt.edit' , compact('employees' , 'employeeDebt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeDebtRequest $request, $id)
    {
        
        $employeeDebt = EmployeeDebt::find($id);
        $employeeDebtPays = EmployeeDebtPay::where('debt_id' , $id)->sum('paid');
        $data = $request->validated();
        $employeeDebt->update([
            'user_id' => Auth::user()->id,
            'employee_id' => $data['employee_id'],
            'value' => $data['value'],
            'date' => $data['date'],
            'rest' => $data['value'] - $employeeDebtPays

        ]);
        return redirect()->route('employeedebt.index')->with('success' , 'تم تعديل سلفة الموظف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $employeeDebt = EmployeeDebt::find($id);
        $employeeDebtPays = EmployeeDebtPay::where('debt_id' , $id )->get();
        foreach($employeeDebtPays as $pay)
        {
            $pay->delete();
        }
        $employeeDebt->delete();

        return redirect()->back()->with('success' , 'تم حذف  سلفة الموظف والسداد الخاص بها بنجاح');
    }
}
