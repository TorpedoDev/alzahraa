<?php

namespace App\Http\Controllers;

use App\Models\HomeExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseRequest;

class HomeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homeExpenses = HomeExpense::orderBy('created_at' , 'DESC')->paginate(16);
        return view('homeexpense.index' , compact('homeExpenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('homeexpense.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        HomeExpense::create($data);
        return redirect()->route('homeexpense.index')->with('success' , 'تم إضافة المصروف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeExpense $homeExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $homeExpense = HomeExpense::find($id);
        return view('homeexpense.edit' , compact('homeExpense'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request,  $id)
    {
        $homeExpense = HomeExpense::find($id);
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $homeExpense->update($data);
        return redirect()->route('homeexpense.index')->with('success' , 'تم تعديل المصروف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $homeExpense = HomeExpense::find($id);
        $homeExpense->delete();
        return redirect()->route('homeexpense.index')->with('success' , 'تم حذف المصروف بنجاح');
    }
}
