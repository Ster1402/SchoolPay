<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PaymentConfigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startAt = new Carbon($this->faker->dateTime);
        $endAt = $startAt->addMonths(2);

        return [
            'school_id' => School::all()->random()->id,
            'academic_year_id' => AcademicYear::all()->random()->id,
            'level' => $this->faker->numberBetween(1,5),
            'startAt' => $startAt->toDateTimeString(),
            'endAt' => $endAt->toDateTimeString(),
            'canPayDischargeFirstPart' => $this->faker->boolean,
            'canPayDischargeSecondPart' => $this->faker->boolean,
            'canPayMedicalVisit' => $this->faker->boolean,
            'dischargeAmount' => 50-000,
            'medicalVisitAmount' => 5-000,
        ];
    }
}
