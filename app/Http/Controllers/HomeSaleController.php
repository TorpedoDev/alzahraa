<?php

namespace App\Http\Controllers;

use App\Models\HomeSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HomeSaleRequest;

class HomeSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homeSales = HomeSale::orderBy('date' , 'DESC')->paginate(16);
        return view('homesale.index' , compact('homeSales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('homesale.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HomeSaleRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $data['total_price'] = $data['quantity'] * $data['price'];
        HomeSale::create($data);
        return redirect()->route('homesale.index')->with('success' , 'تم إضافة مبيعات البيت بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeSale $homeSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $homeSale = HomeSale::find($id);
        return view('homesale.edit' , compact('homeSale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HomeSaleRequest $request, $id)
    {
        $homeSale = HomeSale::find($id);
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $data['total_price'] = $data['quantity'] * $data['price'];
        $homeSale->update($data);
        return redirect()->route('homesale.index')->with('success' , 'تم تعديل مبيعات البيت بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $homeSale = HomeSale::find($id);
        $homeSale->delete();
        return redirect()->route('homesale.index')->with('success' , 'تم حذف مبيعات البيت بنجاح');
    }
}
