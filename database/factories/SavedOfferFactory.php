<?php

namespace Database\Factories;

use App\Models\SavedOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SavedOfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SavedOffer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = \App\Models\User::pluck('id')->toArray();
        $offers = \App\Models\SpecialOffer::pluck('id')->toArray();
        return [
            'user_id' => $this->faker->unique()->randomElement($users),
            'special_offer_id' => $this->faker->unique()->randomElement($offers),
        ];
    }
}
