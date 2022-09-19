<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    //Relationships
    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function paymentConfigs(){
        return $this->hasMany(PaymentConfig::class);
    }
}
