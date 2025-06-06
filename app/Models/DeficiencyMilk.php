<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeficiencyMilk extends Model
{
    use HasFactory;

    protected $fillable = ['driver' , 'date' , 'value' , 'user_id' , 'type'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
