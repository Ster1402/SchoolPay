<?php

namespace Database\Factories;

use App\Models\Discipline;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'discipline_id' => Discipline::factory(),
            'phoneNumber' => $this->faker->phoneNumber,
            'registerNumber' => $this->faker->regexify('[1-2][1-8]G00([0-9]{3,3})'),
            'IDCardNumber' => $this->faker->numerify('###########'),
            'birthday' => $this->faker->dateTime
        ];
    }
}
