<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::orderBy('created_at' , 'DESC')->paginate(16);
        return view('expense.index' , compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expense.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();
        Expense::create([
            'user_id' => Auth::user()->id,
            'reason' => $data['reason'],
            'value' => $data['value'],
        ]);
        return redirect()->route('expense.index')->with('success' , 'تم إضافة المصروف بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $expense = Expense::find($id);
        return view('expense.edit' , compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, $id)
    {
        $expense = Expense::find($id);
        $data = $request->validated();
        $expense->update([
            'user_id' => Auth::user()->id,
            'reason' => $data['reason'],
            'value' => $data['value'],
        ]);
        return redirect()->route('expense.index')->with('success' , 'تم تعديل المصروف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $expense->delete();
        return redirect()->route('expense.index')->with('success' , 'تم حذف المصروف بنجاح');

    }
}
