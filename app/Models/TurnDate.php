<?php

namespace App\Models;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\PseudoTypes\True_;

class TurnDate extends Model
{
    use HasFactory;

    protected $fillable = ['date'];

    public function turns(){
        return $this->hasMany(Turn::class);
    }
}
