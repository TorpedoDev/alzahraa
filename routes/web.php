<?php

use App\Models\Customer;
use App\Models\DepositPay;
use App\Models\ReceiveMilk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\DepositPayController;
use App\Http\Controllers\ReceiveMilkController;
use App\Http\Controllers\CustomerDebtController;
use App\Http\Controllers\EmployeeDebtController;
use App\Http\Controllers\CustomerDebtPayController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeficiencyMilkController;
use App\Http\Controllers\EmployeeDebtPayController;
use App\Http\Controllers\FarmExpenseController;
use App\Http\Controllers\HomeExpenseController;
use App\Http\Controllers\HomeSaleController;
use App\Http\Controllers\RebortController;
use App\Http\Controllers\SendMilkController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TraderController;
use App\Http\Controllers\TraderPayController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth', 'active'])->group(function () {
    Route::resource('/employee', EmployeeController::class);
    Route::resource('/attendence', AttendenceController::class);
    Route::resource('/bonus', BonusController::class);
    Route::resource('/discount', DiscountController::class);
    Route::resource("/expense", ExpenseController::class);
    Route::resource("/customer", CustomerController::class);
    Route::resource("/deposit", DepositController::class);
    Route::resource("/depositpay", DepositPayController::class);
    Route::resource('/customerdebt', CustomerDebtController::class);
    Route::resource('/customerdebtpay', CustomerDebtPayController::class);
    Route::resource('/employeedebt', EmployeeDebtController::class);
    Route::resource('/employeedebtpay', EmployeeDebtPayController::class);
    Route::resource("/receivemilk", ReceiveMilkController::class);
    Route::resource("/deficiencymilk", DeficiencyMilkController::class);
    Route::get("customersalary", [ReceiveMilkController::class, 'getsalary'])->name('customer.getsal');
    Route::post("customersalary", [ReceiveMilkController::class, 'salary'])->name('cus.sal');
    Route::post("customersalarypay/{id}/{from?}/{to?}", [ReceiveMilkController::class, 'paySalary'])->name("cus.paysal");
    Route::get('custommerdebtpay/getpay/{id}', [CustomerDebtPayController::class, 'getPay'])->name('customerdebtpay.getpay');
    Route::post('custommerdebtpay/getpay/{id}', [CustomerDebtPayController::class, 'Pay'])->name('customerdebtpay.pay');
    Route::get('employeedebtpay/getpay/{id}', [EmployeeDebtPayController::class, 'getPay'])->name('employeedebtpay.getpay');
    Route::post('employeedebtpay/getpay/{id}', [EmployeeDebtPayController::class, 'Pay'])->name('employeedebtpay.pay');
    Route::resource('/trader', TraderController::class);
    Route::resource('/sendmilk', SendMilkController::class);
    Route::resource('/traderpay', TraderPayController::class);
    Route::get('/sendmilksalary', [SendMilkController::class, 'getSalary'])->name('trader.getsal');
    Route::post('/sendmilksalaryshow', [SendMilkController::class, 'getSalaryShow'])->name('sendmilk.sal');
    Route::resource('/homesale', HomeSaleController::class);
    Route::resource('/homeexpense', HomeExpenseController::class);
    Route::resource('/farmexpense', FarmExpenseController::class);
    Route::get('/getmilkrebort', [RebortController::class, 'getMilkRebort'])->name('getmilkrebort');
    Route::post('/milkrebort', [RebortController::class, 'milkRebort'])->name('milkrebort');
    Route::get('/gettraderrebort', [RebortController::class, 'getTraderRebort'])->name('gettraderrebort');
    Route::post('/traderrebort', [RebortController::class, 'traderRebort'])->name('traderrebort');
    Route::get('/generalrebort', [RebortController::class, 'generalRebortGet'])->name('generalrebort.get');
    Route::post('/generalrebort', [RebortController::class, 'generalRebort'])->name('generalrebort');
    Route::get('/salary', [SalaryController::class, 'salary'])->name('emp.sal');
    Route::post('/getsalary', [SalaryController::class, 'getSalary'])->name('emp.getsal');
    Route::get('/salary/pay/{id}/{month}', [SalaryController::class, 'paySal'])->name('emp.paysal');
    Route::get('/settings', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/settings/update', [SettingController::class, 'update'])->name('setting.update');
    Route::put('/settings/updatepassword', [SettingController::class, 'updatePassword'])->name('setting.updatepassword');
    Route::resource('/user', UserController::class);
    Route::post('/user/{id}/activation', [UserController::class, 'activation'])->name('user.activation');
    Route::get('/dashboardmain', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('custommerdepositpay/getpay/{id}', [DepositPayController::class, 'getPay'])->name('customerdepositpay.getpay');
    Route::post('custommerdepositpay/getpay/{id}', [DepositPayController::class, 'Pay'])->name('customerdepositpay.pay');
    Route::get('/customer-search', [CustomerController::class, 'search'])->name('customer.search');
    Route::get('/trader-search', [TraderController::class, 'search'])->name('trader.search');
});