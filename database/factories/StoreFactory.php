<?php

namespace Database\Factories;

use App\Models\Package;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition(): array
    {
        return [
            'code' => Str::random(10),
            'name' => fake()->company,
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->phoneNumber,
            'company_name' => fake()->company,
            'capital' => fake()->randomNumber(5, true),
            'address' => fake()->address,
            'register_commerce_number' => fake()->numerify('########'),
            'nif' => fake()->numerify('########'),
            'legal_form_id' => fake()->numberBetween(1, 8),
            'status' => 1,
            'can_update_preparing_packages' => fake()->boolean,
        ];
    }
}
