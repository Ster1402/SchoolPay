<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    protected $with = ['school'];

    //Relationships
    public function students(){
        return $this->hasMany(Student::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }
}
