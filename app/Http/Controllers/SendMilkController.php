<?php

namespace App\Http\Controllers;

use App\Models\Trader;
use App\Models\SendMilk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SendMilkRequest;

class SendMilkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sendMilk = SendMilk::orderBy("date", "Desc")->orderBy("created_at", "ASC")->paginate(16);
        return view("sendmilk.index", compact("sendMilk"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $traders = Trader::all();
        return view("sendmilk.create", compact("traders"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SendMilkRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $trader = Trader::find($data['trader_id']);
        if (($trader->type == 'pont' || $trader->type == 'kilo_and_pont') && ($data['buffalo_pont'] == null && $data['cow_pont'] == null)) {
          return redirect()->back()->with("error", "يبدو أن هذا التاجر علي نظام الحساب بالنط أو البنط والكيلو معاً يجب إدخال قيمة البنط الخاصة باللبن المستلم");
        }
    
        if (($trader->type == 'kilo') && ($data['buffalo_milk_qty'] == null && $data['cow_milk_qty'] == null)) {
          return redirect()->back()->with("error", "يبدو أن هذا التاجر علي نظام الحساب بالكيلو يجب إدخال قيمة الكمية الخاصة باللبن المستلم");
        }
     
        if ($trader->type == "kilo") {
          $data["price"] = ($data["buffalo_milk_qty"] * $trader->buffalo_kilo_price) + ($data["cow_milk_qty"] * $trader->cow_kilo_price);
        } elseif ($trader->type == "pont") {
          $data["price"] = ($data["buffalo_pont"] * $trader->buffalo_pont_price * $data["buffalo_milk_qty"]) + ($data["cow_pont"] * $trader->cow_pont_price * $data["cow_milk_qty"]);
        } else {
          $data["price"] = (($data["buffalo_milk_qty"] * $trader->buffalo_kilo_price) + ($data["buffalo_pont"] * $trader->buffalo_pont_price * $data["buffalo_milk_qty"])) + (($data["cow_milk_qty"] * $trader->cow_kilo_price) + ($data["cow_pont"] * $trader->cow_pont_price * $data["cow_milk_qty"]));
        }

 /** new code */
       if((!$trader->buffalo_pont_price > 0 && !$trader->buffalo_kilo_price > 0) && $data['buffalo_milk_qty'] > 0 )
       {
        return redirect()->back()->with("error", "هذا التاجر لم يتم تحديد سعر كيلو اللبن الجاموسي أو سعر بنط اللبن الجاموسي بالنسبة له");
       }

       if((!$trader->cow_pont_price > 0 && !$trader->cow_kilo_price > 0) && $data['cow_milk_qty'] > 0 )
       {
        return redirect()->back()->with("error", "هذا التاجر لم يتم تحديد سعر كيلو اللبن البقري أو سعر بنط اللبن البقري بالنسبة له");
       }


    if($trader->buffalo_pont_price > 0 && !$data["buffalo_pont"]>0){
      return redirect()->back()->with("error", "يجب إدخال بنط اللبن الجاموسي");
    }

    if($trader->cow_pont_price > 0 && !$data["cow_pont"]>0){
      return redirect()->back()->with("error", "يجب إدخال بنط اللبن البقري");
    }


 /** new code */






        SendMilk::create($data);
        $trader->debt += $data["price"];
        $trader->save();
        return redirect()->route("sendmilk.index")->with("success", "تم تسليم اللبن بنجاح");
    }

    /**
     * Display the specified resource.
     */
    public function show(SendMilk $sendMilk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $traders = Trader::all();
        $sendMilk = SendMilk::find($id);
        return view("sendmilk.edit", compact("traders", "sendMilk"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SendMilkRequest $request,$id)
    {
    $send = SendMilk::find($id);
    $data = $request->validated();
    $data['user_id'] = Auth::user()->id;
    $trader = Trader::find($data['trader_id']);
    if (($trader->type == 'pont' || $trader->type == 'kilo_and_pont') && ($data['buffalo_pont'] == null && $data['cow_pont'] == null)) {
      return redirect()->back()->with("error", "يبدو أن هذا التاجر علي نظام الحساب بالنط او البنط والكيلو معاً يجب إدخال قيمة البنط الخاصة باللبن المستلم");
    }
    if (($trader->type == 'kilo') && ($data['buffalo_milk_qty'] == null && $data['cow_milk_qty'] == null)) {
      return redirect()->back()->with("error", "يبدو أن هذا التاجر علي نظام الحساب بالكيلو يجب إدخال قيمة الكمية الخاصة باللبن المستلم");
    }

    if ($trader->type == "kilo") {
      $data["price"] = ($data["buffalo_milk_qty"] * $trader->buffalo_kilo_price) + ($data["cow_milk_qty"] * $trader->cow_kilo_price);
    } elseif ($trader->type == "pont") {
      $data["price"] = ($data["buffalo_pont"] * $trader->buffalo_pont_price * $data["buffalo_milk_qty"]) + ($data["cow_pont"] * $trader->cow_pont_price * $data["cow_milk_qty"]);
    } else {
      $data["price"] = (($data["buffalo_milk_qty"] * $trader->buffalo_kilo_price) + ($data["buffalo_pont"] * $trader->buffalo_pont_price * $data["buffalo_milk_qty"])) + (($data["cow_milk_qty"] * $trader->cow_kilo_price) + ($data["cow_pont"] * $trader->cow_pont_price * $data["cow_milk_qty"]));
    }




 /** new code */
 if((!$trader->buffalo_pont_price > 0 && !$trader->buffalo_kilo_price > 0) && $data['buffalo_milk_qty'] > 0 )
 {
  return redirect()->back()->with("error", "هذا التاجر لم يتم تحديد سعر كيلو اللبن الجاموسي أو سعر بنط اللبن الجاموسي بالنسبة له");
 }

 if((!$trader->cow_pont_price > 0 && !$trader->cow_kilo_price > 0) && $data['cow_milk_qty'] > 0 )
 {
  return redirect()->back()->with("error", "هذا التاجر لم يتم تحديد سعر كيلو اللبن البقري أو سعر بنط اللبن البقري بالنسبة له");
 }


if($trader->buffalo_pont_price > 0 && !$data["buffalo_pont"]>0){
return redirect()->back()->with("error", "يجب إدخال بنط اللبن الجاموسي");
}

if($trader->cow_pont_price > 0 && !$data["cow_pont"]>0){
return redirect()->back()->with("error", "يجب إدخال بنط اللبن البقري");
}


/** new code */









    if(($trader->debt - $send->price) > 0 ){
      $trader->debt -= $send->price;
      $trader->save();
    }else{
      $trader->debt = 0;
      $trader->save();
    }

    $send->update($data);
    $trader->debt += $data["price"];
    $trader->save();
    return redirect()->route("sendmilk.index")->with("success", "تم تعديل تسليم اللبن بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $send = sendMilk::find($id);
        $trader = Trader::find($send->trader_id);
        if(($trader->debt - $send->price) > 0 ){
          $trader->debt -= $send->price;
          $trader->save();
        }else{
          $trader->debt = 0;
          $trader->save();
        }
        $send->delete();
        return redirect()->route("sendmilk.index")->with("success", "تم حذف تسليم اللبن بنجاح");
    }


    public function getSalary()
    {
      $traders = Trader::all();
      return view('sendmilk.salary' , compact('traders'));
    }

    public function getSalaryShow(Request $request)
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

       return view('sendmilk.getsal' , compact('milks' , 'trader' , 'salary' , 'from' , 'to' , 'total_buff' , 'total_cow'));
    }
}
