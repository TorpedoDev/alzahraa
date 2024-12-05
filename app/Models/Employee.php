<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ["name" , "address" , "phone" , "sheft_sal"];
    
    public function attendences()
    {
        return $this->hasMany(Attendence::class);
    }

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function debts()
    {
        return $this->hasMany(EmployeeDebt::class);
    }

    public function debtspays()
    {
        return $this->hasMany(EmployeeDebtPay::class);
    }
}
