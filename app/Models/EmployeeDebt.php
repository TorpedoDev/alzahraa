<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDebt extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id' , 'user_id' , 'value' , 'date' , 'rest' , 'paid'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function debtspays()
    {
        return $this->hasMany(EmployeeDebtPay::class);
    }
}
