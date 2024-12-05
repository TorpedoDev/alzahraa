<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DepositPay extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' , 'value' , 'deposit_id' , 'date'];

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
