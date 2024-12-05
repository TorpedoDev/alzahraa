<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
class CustomerController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('admin' , ['edit' , 'update']),
        ];
    } 
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $customers = Customer::orderBy('line' , 'ASC')->orderBy('created_at' , 'ASC')->paginate(16);
        return view('customer.index' , compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("customer.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $data = $request->validated();
        if($data['cow_pont_price'] > 0 && $data['cow_kilo_price'] > 0){
            return redirect()->back()->with('error' , "يجب اﻻلتزام بنوع المعاملة في اللبن البقري");
        }

        if($data['buffalo_pont_price'] > 0 && $data['buffalo_kilo_price'] > 0){
            return redirect()->back()->with('error' , "يجب اﻻلتزام بنوع المعاملة في اللبن الجاموسي");
        }

        Customer::create($data);

         return redirect()->route('customer.index')->with('success' , "تم إضافة العميل بنجاح");

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit' , compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::find($id);
        $data = $request->validated();
        if($data['cow_pont_price'] > 0 && $data['cow_kilo_price'] > 0){
            return redirect()->back()->with('error' , "يجب اﻻلتزام بنوع المعاملة في اللبن البقري");
        }

        if($data['buffalo_pont_price'] > 0 && $data['buffalo_kilo_price'] > 0){
            return redirect()->back()->with('error' , "يجب اﻻلتزام بنوع المعاملة في اللبن الجاموسي");
        }
        $customer->update($data);
        return redirect()->route('customer.index')->with('success' , "تم تعديل بيانات العميل بنجاح");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('success' , "تم حذف بيانات العميل بنجاح");

    }


    public function search(Request $request)
    {
       $customers = Customer::where('name' , 'LIKE' , '%'.$request->search.'%')->orderBy('line' , 'ASC')->orderBy('created_at' , 'ASC')->paginate(16);
       return view('customer.search' , compact('customers'));
    }
}
