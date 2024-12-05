<?php

namespace App\Http\Controllers;

use App\Http\Requests\TraderRequest;
use App\Models\Trader;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
class TraderController extends Controller implements HasMiddleware
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
        $traders = Trader::orderBy('created_at' , 'DESC')->paginate(16);
        return view('trader.index' , compact('traders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("trader.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TraderRequest $request)
    {
        $data = $request->validated();
        if($data['cow_pont_price'] > 0 && $data['cow_kilo_price'] > 0){
            return redirect()->back()->with('error' , "يجب اﻻلتزام بنوع المعاملة في اللبن البقري");
        }

        if($data['buffalo_pont_price'] > 0 && $data['buffalo_kilo_price'] > 0){
            return redirect()->back()->with('error' , "يجب اﻻلتزام بنوع المعاملة في اللبن الجاموسي");
        }

        Trader::create($data);

         return redirect()->route('trader.index')->with('success' , "تم إضافة التاجر بنجاح");
    }

    /**
     * Display the specified resource.
     */
    public function show(Trader $trader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trader $trader)
    {
        return view('trader.edit' , compact('trader'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TraderRequest $request, $id)
    {
        $trader = Trader::find($id);
        $data = $request->validated();
        if($data['cow_pont_price'] > 0 && $data['cow_kilo_price'] > 0){
            return redirect()->back()->with('error' , "يجب اﻻلتزام بنوع المعاملة في اللبن البقري");
        }

        if($data['buffalo_pont_price'] > 0 && $data['buffalo_kilo_price'] > 0){
            return redirect()->back()->with('error' , "يجب اﻻلتزام بنوع المعاملة في اللبن الجاموسي");
        }
        $trader->update($data);
        return redirect()->route('trader.index')->with('success' , "تم تعديل بيانات التاجر بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trader $trader)
    {
        $trader->delete();
        return redirect()->route('trader.index')->with('success' , "تم حذف بيانات التاجر بنجاح");
    }

    public function search(Request $request)
    {
        $traders = Trader::where('name' , 'LIKE' , '%'.$request->search.'%')->paginate(16);
        return view('trader.search' , compact('traders'));
    }
}
