<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;


    // Relation to doctor
    public function doctor()
    {
        return $this->belongsToMany(Doctor::class,'doctors_specialties','doctor_id','specialty_id');
    }
}