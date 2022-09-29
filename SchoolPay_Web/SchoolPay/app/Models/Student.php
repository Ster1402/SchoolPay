<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory;

    protected $with = ['user'];
    protected $guarded = ['id'];
    protected $casts = ['birthday'];

    //Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    //Attributes
    public function getHasPaidDischargeFirstPartAttribute()
    {
        //If he hasn't paid anything return false
        if (!$this->payments()->exists()) {
            return false;
        }

        //Filter by academic year
        $academicYear_start = (string)Carbon::now()->year; //By default we use the current year

        if (request('academicYear')) {
            $academicYear_start = Str::before(request('academicYear'), '-');
        }

        return $this->payments()
            ->where(static function ($query) {
                $query->where('type', 'discharge-first-part')
                    ->orwhere('type', 'discharge-all');
            })
            ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                $query->where('period', 'like', $academicYear_start . "%-%");
            })->exists();
    }

    public function hasPaid($type)
    {
        switch ($type) {
            case 'discharge-first-part':
                return $this->hasPaidDischargeFirstPart;
            case 'discharge-second-part':
                return $this->hasPaidDischargeSecondPart;
            case 'discharge-all':
                return $this->hasPaidDischargeSecondPart && $this->hasPaidDischargeFirstPart;
            case 'medicalVisit':
                return $this->hasPaidMedicalVisit;
        }

        return false;
    }

    public function getHasPaidDischargeSecondPartAttribute()
    {
        //If he hasn't paid anything return false
        if (!$this->payments()->exists()) {
            return false;
        }

        //Filter by academic year
        $academicYear_start = (string)Carbon::now()->year; //By default we use the current year

        if (request('academicYear')) {
            $academicYear_start = Str::before(request('academicYear'), '-');
        }

        return $this->payments()
            ->where(static function ($query) {
                $query->where('type', 'discharge-second-part')
                    ->orwhere('type', 'discharge-all');
            })
            ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                $query->where('period', 'like', $academicYear_start . "%-%");
            })->exists();

    }

    public function getHasPaidMedicalVisitAttribute()
    {
        //If he hasn't paid anything return false
        if (!$this->payments()->exists()) {
            return false;
        }

        //Filter by academic year
        $academicYear_start = (string)Carbon::now()->year; //By default we use the current year

        if (request('academicYear')) {
            $academicYear_start = Str::before(request('academicYear'), '-');
        }

        return $this->payments()
            ->where(static function ($query) {
                $query->where('type', 'medicalVisit');
            })
            ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                $query->where('period', 'like', $academicYear_start . "%-%");
            })->exists();
    }


    //Query Builder : scope Filter
    public function scopeFilter($query, array $filters)
    {

        //Search in student
        $query->when($filters['search'] ?? false, static function ($query, $search) {
            $query
                ->where('registerNumber', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->orwhere('name', 'like', '%' . $search . '%');
                });
        });

        //Filter by Discipline
        $query->when($filters['discipline'] ?? false, static function ($query, $discipline) {
            $query->whereHas('discipline', static function ($query) use ($discipline) {
                $query->where('slug', $discipline);
            });
        });

        //Filter by academic year
        $academicYear_start = (string)Carbon::now()->year; //By default we use the current year

        if ($filters['academicYear'] ?? false) {
            $academicYear_start = Str::before($filters['academicYear'], '-');
        }

        //Filter by Status of payments
        $query->when($filters['status'] ?? false, static function ($query, $status) use ($academicYear_start) {

            switch ($status) {
                case 'discharge-first-and-second-part-paid':
                    $query->whereHas('payments', function ($query) use ($academicYear_start) {
                        $query
                            ->where(static function ($query) use ($academicYear_start) {
                                $query
                                    ->where('type', 'discharge-first-part')
                                    ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                                        $query->where('period', 'like', $academicYear_start . "%-%");
                                    });
                            })
                            ->where(static function ($query) use ($academicYear_start) {
                                $query
                                    ->where('type', 'discharge-second-part')
                                    ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                                        $query->where('period', 'like', $academicYear_start . "%-%");
                                    });
                            });
                    });
                    break;
                case 'discharge-first-and-second-part-not-paid':
                    $query->whereHas('payments', function ($query) use ($academicYear_start) {
                        $query
                            ->where(static function ($query) use ($academicYear_start) {
                                $query
                                    ->where('type', '!=', 'discharge-first-part')
                                    ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                                        $query->where('period', 'like', $academicYear_start . "%-%");
                                    });
                            })
                            ->where(static function ($query) use ($academicYear_start) {
                                $query
                                    ->where('type', '!=', 'discharge-second-part')
                                    ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                                        $query->where('period', 'like', $academicYear_start . "%-%");
                                    });
                            });
                    });
                    break;

                case 'discharge-first-part-paid':
                    $query->whereHas('payments', function ($query) use ($academicYear_start) {
                        $query
                            ->where('type', 'discharge-first-part')
                            ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                                $query->where('period', 'like', $academicYear_start . "%-%");
                            });
                    });
                    break;
                case 'discharge-first-part-not-paid':
                    $query->whereHas('payments', function ($query) use ($academicYear_start) {
                        $query
                            ->where('type', '!=', 'discharge-first-part')
                            ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                                $query->where('period', 'like', $academicYear_start . "%-%");
                            });
                    })->orWhereDoesntHave('payments');
                    break;

                case 'discharge-second-part-paid':
                    $query->whereHas('payments', function ($query) use ($academicYear_start) {
                        $query
                            ->where('type', 'discharge-second-part')
                            ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                                $query->where('period', 'like', $academicYear_start . "%-%");
                            });
                    });
                    break;

                case 'discharge-second-part-not-paid':
                    $query->whereHas('payments', function ($query) use ($academicYear_start) {
                        $query
                            ->where('type', '!=', 'discharge-second-part')
                            ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                                $query->where('period', 'like', $academicYear_start . "%-%");
                            });
                    })->orWhereDoesntHave('payments');
                    break;

                case 'medical-visit-paid':
                    $query->whereHas('payments', function ($query) use ($academicYear_start) {
                        $query
                            ->where('type', 'medicalVisit')
                            ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                                $query->where('period', 'like', $academicYear_start . "%-%");
                            });
                    });
                    break;

                case 'medical-visit-not-paid':
                    $query->whereHas('payments', function ($query) use ($academicYear_start) {
                        $query
                            ->where('type', '!=', 'medicalVisit')
                            ->whereHas('academicYear', function ($query) use ($academicYear_start) {
                                $query->where('period', 'like', $academicYear_start . "%-%");
                            });
                    })->orWhereDoesntHave('payments');
                    break;
            }

        });
    }
}
