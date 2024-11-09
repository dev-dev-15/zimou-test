<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {
        return [
            'uuid' => Str::uuid(),
            'tracking_code' => 'ZIMOU-'.fake()->unique()->regexify('[A-Z0-9]{15}'),
            'commune_id' => fake()->numberBetween(1, 1541),
            'delivery_type_id' => fake()->numberBetween(1, 4),
            'status_id' => $statusId = fake()->numberBetween(1, 12),
            'store_id' => fake()->numberBetween(1, 50),
            'address' => fake()->address,
            'can_be_opened' => fake()->boolean,
            'name' => fake()->word,
            'client_first_name' => fake()->firstName,
            'client_last_name' => fake()->lastName,
            'client_phone' => fake()->phoneNumber,
            'client_phone2' => fake()->optional()->phoneNumber,
            'cod_to_pay' => fake()->randomFloat(2, 0, 10000),
            'commission' => fake()->randomFloat(2, 0, 200),
            'status_updated_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'delivered_at' => $statusId === 5 ? fake()->dateTime()->format('Y-m-d H:i:s') : null,
            'extra_weight_price' => fake()->numberBetween(0, 2000),
            'free_delivery' => $freeDelivery = fake()->boolean,
            'delivery_price' => ! $freeDelivery ? fake()->randomFloat(2, 450, 1300) : 0,
            'packaging_price' => fake()->numberBetween(0, 100),
            'partner_cod_price' => fake()->randomFloat(2, 0, 700),
            'partner_delivery_price' => fake()->numberBetween(150, 250),
            'partner_return' => fake()->randomFloat(2, 0, 350),
            'price' => fake()->randomFloat(2, 10, 200000),
            'price_to_pay' => fake()->randomFloat(2, 10, 500000),
            'return_price' => fake()->numberBetween(0, 350),
            'total_price' => fake()->randomFloat(2, 20, 900000),
            'weight' => fake()->numberBetween(500, 10000),
        ];
    }
}
