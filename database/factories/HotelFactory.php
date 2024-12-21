<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company,
            'tax_id' => $this->faker->unique()->numerify('#########'),
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'nit' => $this->faker->unique()->numerify('#########'),
            'max_rooms' => $this->faker->numberBetween(10, 100),
        ];
    }
}