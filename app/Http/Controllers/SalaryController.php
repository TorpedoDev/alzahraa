<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\Employee;
use App\Models\Attendence;
use App\Models\Discount;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    
    public function salary()
    {
      
        return view('employees.salary');
    }



    public function getSalary(Request $request)
    {
         $request->validate(['month' => 'required']);
         $month = $request->month;
         $employees = Employee::all();
         return view('employees.salary' , compact('employees' , 'month'));
        
    }




    public function paySal($id , $month)
    {
        $attendences = Attendence::where('employee_id' , $id)->whereMonth('created_at' ,  $month)->where('is_paid' , 0)->get();
        $bonses = Bonus::where('employee_id' , $id)->whereMonth('created_at' ,  $month)->where('is_paid' , 0)->get();
        $discounts  =Discount::where('employee_id' , $id)->whereMonth('created_at' ,  $month)->where('is_paid' , 0)->get();
        foreach($attendences as $attendence)
        {
            $attendence->is_paid = 1;
            $attendence->save();
        }

        if(count($bonses) > 0){
            foreach($bonses as $bonus)
            {
                $bonus->is_paid = 1;
                $bonus->save();
            }
        }

        if(count($discounts) > 0){
            foreach($discounts as $discount)
            {
                $discount->is_paid = 1;
                $discount->save();
            }
        }

        return redirect()->route('emp.sal')->with('success' , 'تم سداد قبض الموظف بنجاح');
    }
}
