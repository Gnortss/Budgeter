<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = \App\Models\Category::pluck('id')->toArray();
        $users = \App\Models\User::pluck('id')->toArray();
        return [
            'category_id' => $this->faker->randomElement($categories),
            'user_id' => $this->faker->randomElement($users),
            'amount' => $this->faker->randomFloat($nbMaxDecimals=2, $min=-100,$max=100),
            'expense' => $this->faker->boolean($chanceOfGettingTrue = 60),
            'description' => $this->faker->sentence(rand(1,4))
        ];
    }
}
