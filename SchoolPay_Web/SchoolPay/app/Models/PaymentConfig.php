<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentConfig extends Model
{
    use HasFactory;

    protected $casts = [
        'startAt' => 'datetime',
        'endAt' => 'datetime'
    ];

    //Relationships
    public function school(){
        return $this->belongsTo(School::class);
    }

    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }
}
