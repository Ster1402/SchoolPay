<?php

namespace Database\Factories;

use App\Models\Bank;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bank_id' => Bank::factory(),
            'school_id' => School::factory(),
            'number' => $this->faker->regexify('67[0-9]{7,7}')
        ];
    }
}
