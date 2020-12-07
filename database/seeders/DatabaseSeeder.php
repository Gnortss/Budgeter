<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Transaction::factory(40)->create();
        \App\Models\Coupon::factory(10)->create();
        \App\Models\SpecialOffer::factory(5)->create();
        \App\Models\SavedOffer::factory(3)->create();
    }
}
