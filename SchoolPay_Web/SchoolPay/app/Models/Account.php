<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    //Relationships
    public function bank(){
        return $this->belongsTo(Bank::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }
}
