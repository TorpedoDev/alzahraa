<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDebtPay extends Model
{
    use HasFactory;
    protected $fillable = ['debt_id' , 'user_id' , 'value' , 'date'];

    public function debt()
    {
        return $this->belongsTo(EmployeeDebt::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
