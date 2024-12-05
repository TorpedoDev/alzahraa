<?php

namespace App\Http\Controllers;

use App\Models\DeficiencyMilk;
use App\Models\Expense;
use App\Models\FarmExpense;
use App\Models\HomeExpense;
use App\Models\HomeSale;
use App\Models\ReceiveMilk;
use App\Models\SendMilk;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{


    public function index()
    {

        // Daily Statistics
        $dailyBuffaloQuantity = ReceiveMilk::whereDate('date', Carbon::today('Africa/Cairo'))->sum('buffalo_milk_qty');
        $dailyCowQuantity = ReceiveMilk::whereDate('date', Carbon::today('Africa/Cairo'))->sum('cow_milk_qty');

        $dailyBuffaloSales = SendMilk::whereDate('date', Carbon::today('Africa/Cairo'))->sum('buffalo_milk_qty');
        $dailyCowSales = SendMilk::whereDate('date', Carbon::today('Africa/Cairo'))->sum('cow_milk_qty');


        $dailyHomeSales = HomeSale::whereDate('date', Carbon::today('Africa/Cairo'))->sum('total_price');
        $dailyBuffaloHome = HomeSale::where('product', 'buff_milk')->whereDate('date', Carbon::today('Africa/Cairo'))->sum('quantity');
        $dailyCowHome = HomeSale::where('product', 'cow_milk')->whereDate('date', Carbon::today('Africa/Cairo'))->sum('quantity');

        $dailyBuffaloDeficiency = DeficiencyMilk::whereDate('date', Carbon::today('Africa/Cairo'))->where('type', 'buff')->sum('value');
        $dailyCowDeficiency = DeficiencyMilk::whereDate('date', Carbon::today('Africa/Cairo'))->where('type', 'cow')->sum('value');


        $dailyAdditionalExpenses = Expense::whereDate('created_at', Carbon::today('Africa/Cairo'))->sum('value');
        $dailyHomeExpenses = HomeExpense::whereDate('created_at', Carbon::today('Africa/Cairo'))->sum('value');
        $dailyFarmExpenses = FarmExpense::whereDate('created_at', Carbon::today('Africa/Cairo'))->sum('value');


        $dailyReceiveMoney = ReceiveMilk::whereDate('date', Carbon::today('Africa/Cairo'))->sum('price');
        $dailySalesMoney = SendMilk::whereDate('date', Carbon::today('Africa/Cairo'))->sum('price');
        // Daily Statistics




        // Weekly Statistics
        $weeklyBuffaloQuantity = ReceiveMilk::whereBetween('date', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->sum('buffalo_milk_qty');
        $weeklyCowQuantity = ReceiveMilk::whereBetween('date', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->sum('cow_milk_qty');

        $weeklyBuffaloSales = SendMilk::whereBetween('date', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->sum('buffalo_milk_qty');
        $weeklyCowSales = SendMilk::whereBetween('date', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->sum('cow_milk_qty');


        $weeklyHomeSales = HomeSale::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->sum('total_price');
        $weeklyBuffaloHome = HomeSale::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->where('product', 'buff_milk')->sum('quantity');
        $weeklyCowHome = HomeSale::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->where('product', 'cow_milk')->sum('quantity');

        $weeklyBuffaloDeficiency = DeficiencyMilk::whereBetween('date', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->where('type', 'buff')->sum('value');
        $weeklyCowDeficiency = DeficiencyMilk::whereBetween('date', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->where('type', 'cow')->sum('value');


        $weeklyAdditionalExpenses = Expense::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->sum('value');
        $weeklyHomeExpenses = HomeExpense::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->sum('value');
        $weeklyFarmExpenses = FarmExpense::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->sum('value');


        $weeklyReceiveMoney = ReceiveMilk::whereBetween('date', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->sum('price');
        $weeklySalesMoney = SendMilk::whereBetween('date', [\Carbon\Carbon::now()->startOfWeek(\Carbon\Carbon::SATURDAY), \Carbon\Carbon::now()->endOfWeek(\Carbon\Carbon::FRIDAY)])->sum('price');
        // Weekly Statistics







        // Monthly Statistics
        $monthlyBuffaloQuantity = ReceiveMilk::whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->sum('buffalo_milk_qty');
        $monthlyCowQuantity = ReceiveMilk::whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->sum('cow_milk_qty');

        $monthlyBuffaloSales = SendMilk::whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->sum('buffalo_milk_qty');
        $monthlyCowSales = SendMilk::whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->sum('cow_milk_qty');


        $monthlyHomeSales = HomeSale::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->sum('total_price');
        $monthlyBuffaloHome = HomeSale::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->where('product', 'buff_milk')->sum('quantity');
        $monthlyCowHome = HomeSale::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->where('product', 'cow_milk')->sum('quantity');


        $monthlyBuffaloDeficiency = DeficiencyMilk::whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->where('type', 'buff')->sum('value');
        $monthlyCowDeficiency = DeficiencyMilk::whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->where('type', 'cow')->sum('value');


        $monthlyAdditionalExpenses = Expense::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->sum('value');
        $monthlyHomeExpenses = HomeExpense::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->sum('value');
        $monthlyFarmExpenses = FarmExpense::whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->sum('value');


        $monthlyReceiveMoney = ReceiveMilk::whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->sum('price');
        $monthlySalesMoney = SendMilk::whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->sum('price');
        // Monthly Statistics





        return view('dashboard', get_defined_vars());
    }
}
