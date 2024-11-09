<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryTypeSeeder extends Seeder
{
    protected $deliveryTypes = [
        ['name' => 'Express'],
        ['name' => 'Economy Express'],
        ['name' => 'Standard'],
        ['name' => 'Point relais (Stop Desk)'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryType::insert($this->deliveryTypes);
    }
}
