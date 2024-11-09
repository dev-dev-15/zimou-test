<?php

namespace Database\Seeders;

use App\Models\PackageStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageStatusSeeder extends Seeder
{
    protected $statuses = [
        ['name' => 'Label Created'],
        ['name' => 'Picked Up'],
        ['name' => 'In Transit'],
        ['name' => 'Out For Delivery'],
        ['name' => 'Delivered'],
        ['name' => 'Delivery Attempt Failed'],
        ['name' => 'Returned To Sender'],
        ['name' => 'Delayed'],
        ['name' => 'Lost'],
        ['name' => 'Damaged'],
        ['name' => 'Held At Location'],
        ['name' => 'Awaiting Pickup'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PackageStatus::insert($this->statuses);
    }
}
