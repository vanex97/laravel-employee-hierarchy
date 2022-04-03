<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'position_id' => Position::get()->random()->id,
            'phone_number' => $this->faker->unique()->numerify('+38063#######'),
            'salary' => $this->faker->numberBetween(0,500000),
            'image_id' => Image::factory(),
            'employment_date' => $this->faker->dateTimeBetween('-10 years')
        ];
    }
}
