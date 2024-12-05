<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ["name" , "address" , "phone" , "line" , "type" , "cow_pont_price" , "buffalo_pont_price" , "cow_kilo_price" , "buffalo_kilo_price"];

    public function deposit()
    {
        return $this->hasMany(Deposit::class);
    }

    public function depositPay()
    {
        return $this->hasMany(DepositPay::class);
    }

    public function debts()
    {
        return $this->hasMany(CustomerDebt::class);
    }

    public function debtspays()
    {
        return $this->hasMany(CustomerDebtPay::class);
    }

    public function milks()
    {
        return $this->hasMany(ReceiveMilk::class);
    }

}
