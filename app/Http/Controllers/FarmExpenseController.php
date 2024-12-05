<?php

namespace App\Http\Controllers;

use App\Models\FarmExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseRequest;

class FarmExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farmExpenses = FarmExpense::orderBy('created_at' , 'DESC')->paginate(16);
        return view('farmexpense.index' , compact('farmExpenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('farmexpense.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        FarmExpense::create($data);
        return redirect()->route('farmexpense.index')->with('success' , 'تم إضافة المصروف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(FarmExpense $farmExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $farmExpense = FarmExpense::find($id);
        return view('farmexpense.edit' , compact('farmExpense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, $id)
    {
        $farmExpense = FarmExpense::find($id);
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $farmExpense->update($data);
        return redirect()->route('farmexpense.index')->with('success' , 'تم تعديل المصروف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $farmExpense = FarmExpense::find($id);
        $farmExpense->delete();
        return redirect()->route('farmexpense.index')->with('success' , 'تم حذف المصروف بنجاح');
    }
}
