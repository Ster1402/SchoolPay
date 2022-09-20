<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => Student::all()->random()->id,
            'academic_year_id' => AcademicYear::all()->random()->id,
            'type' => collect(['discharge-first-part', 'discharge-second-part' , 'medicalVisit'])->random(),
            'amount' => $this->faker->numberBetween(5000, 55000),
            'payAt' => $this->faker->dateTime,
        ];
    }
}
