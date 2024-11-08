<?php

namespace Database\Seeders;

use App\Models\PackageStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageStatusSeeder extends Seeder
{
    protected $statuses = [
        ['name' => 'label_created'],
        ['name' => 'picked_up'],
        ['name' => 'in_transit'],
        ['name' => 'out_for_delivery'],
        ['name' => 'delivered'],
        ['name' => 'delivery_attempt_failed'],
        ['name' => 'returned_to_sender'],
        ['name' => 'delayed'],
        ['name' => 'lost'],
        ['name' => 'damaged'],
        ['name' => 'held_at_location'],
        ['name' => 'awaiting_pickup'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->statuses as $status) {
            PackageStatus::create($status);
        }
    }
}
