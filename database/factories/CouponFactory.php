<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = \App\Models\User::pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($users),
            'description' => $this->faker->sentence(rand(5,10)),
            'start_date' => $this->faker->dateTimeThisMonth($max='now')->format('Y-m-d H:i:s'),
            'end_date' => $this->faker->dateTimeThisMonth($min='now')->format('Y-m-d H:i:s'),
        ];
    }
}
