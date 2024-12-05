<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendenceRequest;
use App\Models\Employee;
use App\Models\Attendence;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    
    public function index()
    {
        $attendences = Attendence::orderBy("date", "Desc")->orderBy("created_at", "ASC")->paginate(16);
        return view('attendence.index' , compact('attendences'));
    }

   
    public function create()
    {
        $employees = Employee::all();
        return view('attendence.create' , compact('employees'));
    }

    
    public function store(AttendenceRequest $request)
    {
        $data = $request->validated();
        $employee = Employee::find($data['employee_id']);
        $check = Attendence::where("employee_id", $data["employee_id"])->where("date", $data["date"])->where("period", $data["period"])->get();
        if (count($check) > 0) {
            return redirect()->back()->with("error", "تم تسجيل حضور هذا الموظف في هذا اليوم وهذه الفترة قم بالتحقق من البوم والفترة من فضلك");
          }
        $data['price'] = $employee->sheft_sal;
        Attendence::create($data);
        return redirect()->route('attendence.index')->with('success' , "تم تسجيل الحضور بنجاح");
    }

   
  
    public function edit(Attendence $attendence)
    {
        $employees = Employee::all();
        return view('attendence.edit' , compact('employees' , 'attendence'));
    }

   
    public function update(AttendenceRequest $request, Attendence $attendence)
    {
        $data = $request->validated();
        $employee = Employee::find($data['employee_id']);
        $check = Attendence::where("employee_id", $data["employee_id"])->where("date", $data["date"])->where("period", $data["period"])->get();
        if (count($check) > 0) {
            return redirect()->back()->with("error", "تم تسجيل حضور هذا الموظف في هذا اليوم وهذه الفترة قم بالتحقق من البوم والفترة من فضلك");
          }
        $data['price'] = $employee->sheft_sal;
        $attendence->update($data);
        return redirect()->route('attendence.index')->with('success' , "تم تعديل الحضور بنجاح");

    }

    
    public function destroy(Attendence $attendence)
    {
        $attendence->delete();
        return redirect()->back()->with('success' , "تم حذف الحضور بنجاح");
    }
}
