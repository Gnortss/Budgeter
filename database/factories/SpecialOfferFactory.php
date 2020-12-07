<?php

namespace Database\Factories;

use App\Models\SpecialOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialOfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecialOffer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->dateTimeThisMonth($max='now')->format('Y-m-d H:i:s'),
            'end_date' => $this->faker->dateTimeThisMonth($min='now')->format('Y-m-d H:i:s'),
            'description' => $this->faker->sentence(rand(5,10)),
        ];
    }
}
