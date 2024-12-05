<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendMilk extends Model
{
    use HasFactory;
    protected $fillable = ["trader_id" , "user_id" , "buffalo_milk_qty" , "cow_milk_qty" , "buffalo_pont" , "cow_pont" , "date" , "notes" , "price"];

    public function trader()
    {
        return $this->belongsTo(Trader::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
