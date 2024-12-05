<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ReceiveMilk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReceivedMilkRequest;

class ReceiveMilkController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $receivedMilk = ReceiveMilk::orderBy("date", "Desc")->orderBy("created_at", "ASC")->paginate(16);
    return view("receivedmilk.index", compact("receivedMilk"));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $customers = Customer::orderBy('line' , 'ASC')->orderBy('created_at' , 'ASC')->get();
    return view("receivedmilk.create", compact("customers"));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ReceivedMilkRequest $request)
  {
    $data = $request->validated();
    $data['user_id'] = Auth::user()->id;
    $check = ReceiveMilk::where("customer_id", $data["customer_id"])->where("date", $data["date"])->where("period", $data["period"])->get();
    $customer = Customer::find($data['customer_id']);
    if (($customer->type == 'pont' || $customer->type == 'kilo_and_pont') && ($data['buffalo_pont'] == null && $data['cow_pont'] == null)) {
      return redirect()->back()->with("error", "يبدو أن هذا العميل علي نظام الحساب بالنط أو البنط والكيلو معاً يجب إدخال قيمة البنط الخاصة باللبن المستلم");
    }

    if (($customer->type == 'kilo') && ($data['buffalo_milk_qty'] == null && $data['cow_milk_qty'] == null)) {
      return redirect()->back()->with("error", "يبدو أن هذا العميل علي نظام الحساب بالكيلو يجب إدخال قيمة الكمية الخاصة باللبن المستلم");
    }

    if (count($check) > 0) {
      return redirect()->back()->with("error", "تم استلام اللبن من هذا العميل في هذا اليوم وهذه الفترة قم بالتحقق من البوم والفترة من فضلك");
    }

    if ($customer->type == "kilo") {
      $data["price"] = ($data["buffalo_milk_qty"] * $customer->buffalo_kilo_price) + ($data["cow_milk_qty"] * $customer->cow_kilo_price);
    } elseif ($customer->type == "pont") {
      $data["price"] = ($data["buffalo_pont"] * $customer->buffalo_pont_price * $data["buffalo_milk_qty"]) + ($data["cow_pont"] * $customer->cow_pont_price * $data["cow_milk_qty"]);
    } else {
      $data["price"] = (($data["buffalo_milk_qty"] * $customer->buffalo_kilo_price) + ($data["buffalo_pont"] * $customer->buffalo_pont_price * $data["buffalo_milk_qty"])) + (($data["cow_milk_qty"] * $customer->cow_kilo_price) + ($data["cow_pont"] * $customer->cow_pont_price * $data["cow_milk_qty"]));
    }



 /** new code */
 if((!$customer->buffalo_pont_price > 0 && !$customer->buffalo_kilo_price > 0) && $data['buffalo_milk_qty'] > 0 )
 {
  return redirect()->back()->with("error", "هذا العميل لم يتم تحديد سعر كيلو اللبن الجاموسي أو سعر بنط اللبن الجاموسي بالنسبة له");
 }

 if((!$customer->cow_pont_price > 0 && !$customer->cow_kilo_price > 0) && $data['cow_milk_qty'] > 0 )
 {
  return redirect()->back()->with("error", "هذا العميل لم يتم تحديد سعر كيلو اللبن البقري أو سعر بنط اللبن البقري بالنسبة له");
 }


if($customer->buffalo_pont_price > 0 && !$data["buffalo_pont"]>0){
return redirect()->back()->with("error", "يجب إدخال بنط اللبن الجاموسي");
}

if($customer->cow_pont_price > 0 && !$data["cow_pont"]>0){
return redirect()->back()->with("error", "يجب إدخال بنط اللبن البقري");
}


/** new code */




    ReceiveMilk::create($data);
    return redirect()->route("receivemilk.index")->with("success", "تم استلام اللبن بنجاح");
  }

  /**
   * Display the specified resource.
   */
  public function show(ReceiveMilk $receiveMilk)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    $customers = Customer::orderBy('line' , 'ASC')->orderBy('created_at' , 'ASC')->get();
    $receivemilk = ReceiveMilk::find($id);
    return view("receivedmilk.edit", compact("customers", "receivemilk"));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ReceivedMilkRequest $request,  $id)
  {
    $receive = ReceiveMilk::find($id);
    $data = $request->validated();
    $data['user_id'] = Auth::user()->id;
    $customer = Customer::find($data['customer_id']);
    if (($customer->type == 'pont' || $customer->type == 'kilo_and_pont') && ($data['buffalo_pont'] == null && $data['cow_pont'] == null)) {
      return redirect()->back()->with("error", "يبدو أن هذا العميل علي نظام الحساب بالنط او البنط والكيلو معاً يجب إدخال قيمة البنط الخاصة باللبن المستلم");
    }
    if (($customer->type == 'kilo') && ($data['buffalo_milk_qty'] == null && $data['cow_milk_qty'] == null)) {
      return redirect()->back()->with("error", "يبدو أن هذا العميل علي نظام الحساب بالكيلو يجب إدخال قيمة الكمية الخاصة باللبن المستلم");
    }

    if ($customer->type == "kilo") {
      $data["price"] = ($data["buffalo_milk_qty"] * $customer->buffalo_kilo_price) + ($data["cow_milk_qty"] * $customer->cow_kilo_price);
    } elseif ($customer->type == "pont") {
      $data["price"] = ($data["buffalo_pont"] * $customer->buffalo_pont_price * $data["buffalo_milk_qty"]) + ($data["cow_pont"] * $customer->cow_pont_price * $data["cow_milk_qty"]);
    } else {
      $data["price"] = (($data["buffalo_milk_qty"] * $customer->buffalo_kilo_price) + ($data["buffalo_pont"] * $customer->buffalo_pont_price * $data["buffalo_milk_qty"])) + (($data["cow_milk_qty"] * $customer->cow_kilo_price) + ($data["cow_pont"] * $customer->cow_pont_price * $data["cow_milk_qty"]));
    }



/** new code */
if((!$customer->buffalo_pont_price > 0 && !$customer->buffalo_kilo_price > 0) && $data['buffalo_milk_qty'] > 0 )
{
 return redirect()->back()->with("error", "هذا العميل لم يتم تحديد سعر كيلو اللبن الجاموسي أو سعر بنط اللبن الجاموسي بالنسبة له");
}

if((!$customer->cow_pont_price > 0 && !$customer->cow_kilo_price > 0) && $data['cow_milk_qty'] > 0 )
{
 return redirect()->back()->with("error", "هذا العميل لم يتم تحديد سعر كيلو اللبن البقري أو سعر بنط اللبن البقري بالنسبة له");
}


if($customer->buffalo_pont_price > 0 && !$data["buffalo_pont"]>0){
return redirect()->back()->with("error", "يجب إدخال بنط اللبن الجاموسي");
}

if($customer->cow_pont_price > 0 && !$data["cow_pont"]>0){
return redirect()->back()->with("error", "يجب إدخال بنط اللبن البقري");
}

/** new code */





    $receive->update($data);
    return redirect()->route("receivemilk.index")->with("success", "تم تعديل استلام اللبن بنجاح");
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    $receive = ReceiveMilk::find($id);
    $receive->delete();
    return redirect()->route("receivemilk.index")->with("success", "تم حذف استلام اللبن بنجاح");
  }



  public function getsalary()
  {
    $customers = Customer::orderBy('line' , 'ASC')->orderBy('created_at' , 'ASC')->get();
    return view("receivedmilk.salary", compact("customers"));
  }



  public function salary(Request $request)
  {

    if (!is_null($request->customer_id) && !is_null($request->from) && !is_null($request->to)) {
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
      $all = [];
      $from = $request->from;
      $to = $request->to;
      $customer = Customer::find($request->customer_id);
      $salary = ReceiveMilk::where("customer_id", $request->customer_id)->where("is_paid", 0)->whereBetween("date", [$request->from, $request->to])->sum("price");
      $total_buff =ReceiveMilk::where("customer_id", $request->customer_id)->where("is_paid", 0)->whereBetween("date", [$request->from, $request->to])->sum("buffalo_milk_qty");
      $total_cow =ReceiveMilk::where("customer_id", $request->customer_id)->where("is_paid", 0)->whereBetween("date", [$request->from, $request->to])->sum("cow_milk_qty");

      $receivedMilk = ReceiveMilk::where("customer_id", $request->customer_id)->where("is_paid", 0)->whereBetween("date", [$request->from, $request->to])->get()->toArray();
      for ($i = 0; $i < count($receivedMilk); $i++) {

        for ($x = 1; $x < count($receivedMilk); $x++) {
          if ($receivedMilk[$i]["date"] == $receivedMilk[$x]["date"]) {
            $all[$receivedMilk[$i]["date"]][$receivedMilk[$i]["period"]] = $receivedMilk[$i];
            $all[$receivedMilk[$i]["date"]][$receivedMilk[$x]["period"]] =  $receivedMilk[$x];
          }
        }
      }
      return view("receivedmilk.getsal", compact("customer", "all", "salary" , "from" , "to" , "total_buff" , "total_cow"));
    } elseif (!is_null($request->customer_id) && is_null($request->from) && is_null($request->to)) {
      $all = [];
      $customer = Customer::find($request->customer_id);

      $salary = ReceiveMilk::where("customer_id", $request->customer_id)->where("is_paid", 0)->sum("price");
      $total_buff = ReceiveMilk::where("customer_id", $request->customer_id)->where("is_paid", 0)->sum("buffalo_milk_qty");
      $total_cow = ReceiveMilk::where("customer_id", $request->customer_id)->where("is_paid", 0)->sum("cow_milk_qty");

      $receivedMilk = ReceiveMilk::where("customer_id", $request->customer_id)->where("is_paid", 0)->get()->toArray();

      for ($i = 0; $i < count($receivedMilk); $i++) {
        for ($x = 1; $x < count($receivedMilk); $x++) {
          if ($receivedMilk[$i]["date"] == $receivedMilk[$x]["date"]) {
            $all[$receivedMilk[$i]["date"]][$receivedMilk[$i]["period"]] = $receivedMilk[$i];
            $all[$receivedMilk[$i]["date"]][$receivedMilk[$x]["period"]] =  $receivedMilk[$x];
          }
        }
      }
      return view("receivedmilk.getsal", compact("all", "salary", "customer" , "total_buff" , "total_cow"));
    }
  }


  public function paySalary($id , $from="" , $to = "")
  {
      if(!empty($from) && !empty($to)){
        $receivedMilk = ReceiveMilk::where("customer_id", $id)->where("is_paid", 0)->whereBetween("date", [$from, $to])->get();
        foreach($receivedMilk as $milk){
          $milk->is_paid = 1;
          $milk->save();
        }
        return redirect()->back()->with("success" , "تم تسديد فاتورة المدة ينجاح");
      }else{
        $receivedMilk = ReceiveMilk::where("customer_id", $id)->where("is_paid", 0)->get();
        foreach($receivedMilk as $milk){
          $milk->is_paid = 1;
          $milk->save();
        }
        return redirect()->back()->with("success" , "تم تسديد فاتورة المدة ينجاح");

      }
  }
}
