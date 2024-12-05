<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Bonus;
use App\Models\Trader;
use App\Models\Customer;
use App\Models\DeficiencyMilk;
use App\Models\Discount;
use App\Models\Expense;
use App\Models\FarmExpense;
use App\Models\HomeExpense;
use App\Models\HomeSale;
use App\Models\SendMilk;
use App\Models\ReceiveMilk;
use Illuminate\Http\Request;

class RebortController extends Controller
{

    public function getMilkRebort()
    {
        $customers = Customer::orderBy('line' , 'ASC')->orderBy('created_at' , 'ASC')->get();
        return view('rebort.getmilk', compact('customers'));
    }

    public function milkRebort(Request $request)
    {
        $request->validate([
            "customer_id" => 'required',
            "from" => "required|before:to",
            "to" => "required|after:from"
        ], [
            "customer_id.required" => "يجب إدخال اسم العميل",
            "from.required" => "يجب تحديد تاريخ بداية المدة",
            "from.before" => "يجب أن يكون تاريخ بداية المدة قبل تاريخ نهاية المدة",
            "to.required" => "يجب تحديد تاريخ نهاية المدة",
            "to.after" => "يجب أن يكون تاريخ نهاية المدة بعد تاريخ بداية المدة",
        ]);

        if (!is_null($request->customer_id) && !is_null($request->from) && !is_null($request->to)) {
            $all = [];
            $from = $request->from;
            $to = $request->to;
            $customer = Customer::find($request->customer_id);
            $salary = ReceiveMilk::where("customer_id", $request->customer_id)->whereBetween("date", [$request->from, $request->to])->sum("price");
            $total_buff = ReceiveMilk::where("customer_id", $request->customer_id)->whereBetween("date", [$request->from, $request->to])->sum("buffalo_milk_qty");
            $total_cow = ReceiveMilk::where("customer_id", $request->customer_id)->whereBetween("date", [$request->from, $request->to])->sum("cow_milk_qty");

            $receivedMilk = ReceiveMilk::where("customer_id", $request->customer_id)->whereBetween("date", [$request->from, $request->to])->get()->toArray();
            for ($i = 0; $i < count($receivedMilk); $i++) {
                for ($x = 1; $x < count($receivedMilk); $x++) {
                    if ($receivedMilk[$i]["date"] == $receivedMilk[$x]["date"]) {
                        $all[$receivedMilk[$i]["date"]][$receivedMilk[$i]["period"]] = $receivedMilk[$i];
                        $all[$receivedMilk[$i]["date"]][$receivedMilk[$x]["period"]] =  $receivedMilk[$x];
                    }
                }
            }
            return view("rebort.milkrebort", compact("customer", "all", "salary", "from", "to" , "total_buff" , "total_cow"));
        }
    }

    public function getTraderRebort()
    {
        $traders = Trader::all();
        return view('rebort.gettrader', compact('traders'));
    }

    public function traderRebort(Request $request)
    {
        $request->validate([
            "trader_id" => 'required',
            "from" => "required|before:to",
            "to" => "required|after:from"
          ], [
            "trader_id.required" => "يجب إدخال اسم التاجر",
            "from.required" => "يجب تحديد تاريخ بداية المدة",
            "from.before" => "يجب أن يكون تاريخ بداية المدة قبل تاريخ نهاية المدة",
            "to.required" => "يجب تحديد تاريخ نهاية المدة",
            "to.after" => "يجب أن يكون تاريخ نهاية المدة بعد تاريخ بداية المدة",
          ]);
          $from = $request->from;
          $to = $request->to;
           $milks = SendMilk::with('trader')->where('trader_id' , $request->trader_id)->whereBetween("date", [$from, $to])->orderBy('date' , 'ASC')->get();  
           $trader = Trader::find($request->trader_id);
           $salary =  SendMilk::with('trader')->where('trader_id' , $request->trader_id)->whereBetween("date", [$from, $to])->sum("price");  
           $total_buff =  SendMilk::with('trader')->where('trader_id' , $request->trader_id)->whereBetween("date", [$from, $to])->sum("buffalo_milk_qty");  
           $total_cow =  SendMilk::with('trader')->where('trader_id' , $request->trader_id)->whereBetween("date", [$from, $to])->sum("cow_milk_qty");  

           return view("rebort.traderrebort" , compact('milks' , 'trader' , 'salary' , 'from' , 'to' , 'total_buff' , 'total_cow'));
    }

   public function generalRebortGet()
    {
        return view('rebort.generalrebort');
    }


    public function generalRebort(Request $request)
    {
        $request->validate([
            "from" => "required|before:to",
            "to" => "required|after:from"
          ], [
            "from.required" => "يجب تحديد تاريخ بداية المدة",
            "from.before" => "يجب أن يكون تاريخ بداية المدة قبل تاريخ نهاية المدة",
            "to.required" => "يجب تحديد تاريخ نهاية المدة",
            "to.after" => "يجب أن يكون تاريخ نهاية المدة بعد تاريخ بداية المدة",
          ]);

          $from = $request->from;
          $to = $request->to;
        $buffaloQuantity = ReceiveMilk::whereBetween("date", [$from, $to])->sum('buffalo_milk_qty');
        $cowQuantity = ReceiveMilk::whereBetween("date", [$from, $to])->sum('cow_milk_qty');
        $receiveMoney = ReceiveMilk::whereBetween("date", [$from, $to])->sum('price');

        $buffaloSales = SendMilk::whereBetween("date", [$from, $to])->sum('buffalo_milk_qty');
        $cowSales = SendMilk::whereBetween("date", [$from, $to])->sum('cow_milk_qty');
        $salesMoney = SendMilk::whereBetween("date", [$from, $to])->sum('price');
        $homeSales = HomeSale::whereBetween("created_at", [$from, $to])->sum('total_price');
        $buffaloHomeSale = HomeSale::whereBetween("created_at", [$from, $to])->where('product' , 'buff_milk')->sum('quantity');        
        $cowHomeSale = HomeSale::whereBetween("created_at", [$from, $to])->where('product' , 'cow_milk')->sum('quantity');        

        $expenses = Expense::whereBetween("created_at", [$from, $to])->sum('value');

        $attendencesPrice = Attendence::whereBetween("created_at", [$from, $to])->sum('price');
        $bonusPrice = Bonus::whereBetween("created_at", [$from, $to])->sum('value');
        $discountPrice = Discount::whereBetween("created_at", [$from, $to])->sum('value');

        $employeesSalary = round(($attendencesPrice + $bonusPrice) - $discountPrice);


        $buffaloDeficiencyMilks = DeficiencyMilk::whereBetween("date", [$from, $to])->where('type' , 'buff')->sum('value');
        $cowDeficiencyMilks = DeficiencyMilk::whereBetween("date", [$from, $to])->where('type' , 'cow')->sum('value');

        $homeExpense = HomeExpense::whereBetween("created_at", [$from, $to])->sum('value');
        $farmExpense = FarmExpense::whereBetween("created_at", [$from, $to])->sum('value');

          return view('rebort.getgeneralrebort' , get_defined_vars());
 
    }
}
