<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    //Relationships
    public function account(){
        return $this->belongsTo(Account::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function paymentConfigs(){
        return $this->hasMany(PaymentConfig::class);
    }

    public function disciplines(){
        return $this->hasMany(Discipline::class);
    }
}
