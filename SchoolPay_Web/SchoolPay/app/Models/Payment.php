<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $casts = [
      'payAt' => 'datetime',
    ];

    //Relationships
    public function academicYear(){
        return $this->belongsTo(AcademicYear::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
