<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
    use HasFactory;
    protected $fillable = ["name" , "address" , "phone" , "type" , "cow_pont_price" , "buffalo_pont_price" , "cow_kilo_price" , "buffalo_kilo_price" ];



  public function milks()
  {
    return $this->hasMany(SendMilk::class);
  }



}
