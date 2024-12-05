<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderPay extends Model
{
    use HasFactory;
    protected $fillable = ['trader_id' , 'user_id' , 'value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trader()
    {
        return $this->belongsTo(Trader::class);
    }
}
