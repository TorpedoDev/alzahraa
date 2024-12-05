<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveMilk extends Model
{
    use HasFactory;
    protected $fillable = ["customer_id" , "user_id" , "buffalo_milk_qty" , "cow_milk_qty" , "buffalo_pont" , "cow_pont" , "date" , "period" , "notes" , "price"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
