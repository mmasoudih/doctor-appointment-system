<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'doctor_id','visit_time', 'turn_date_id'];


    public function turnDate(){
        return $this->belongsTo(TurnDate::class);
    }
}
