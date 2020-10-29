<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    // Relation to doctor profile model
    public function doctorProfile()
    {
        return $this->hasOne(DoctorProfile::class,'doctor_id');
    }
    // Relation to user model 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
