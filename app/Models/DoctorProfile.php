<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'age',
        'bio',
        'avatar'
    ];

    // Relation to doctor
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
