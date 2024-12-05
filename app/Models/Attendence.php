<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id' , 'period' , 'price' , 'date'];
    

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function scopeMonth($query , $month)
    {
        return $query->whereMonth('created_at' , $month);
    }
}
