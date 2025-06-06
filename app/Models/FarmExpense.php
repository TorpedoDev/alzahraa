<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmExpense extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' , 'reason' , 'value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
