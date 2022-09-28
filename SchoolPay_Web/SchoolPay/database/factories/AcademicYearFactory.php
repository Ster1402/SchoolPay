<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AcademicYearFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = (int) $this->faker->regexify('20[1-2][1-8]');
        $end = $start + 1;

        return [
            'period' => "$start - $end",
            'status' => 'off'
        ];
    }
}
