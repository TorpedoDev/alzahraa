<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSale extends Model
{
    use HasFactory;
    protected $fillable = ['product' , 'quantity' , 'price' , 'user_id' , 'total_price' , 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
