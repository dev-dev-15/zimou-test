<?php

namespace App\Console\Commands;

use App\Models\Package;
use App\Models\Store;
use Illuminate\Console\Command;

class CreateStoresAndPackagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stores:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create 5000 stores and 100 packages for each store';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ////////// Create 5000 stores
        $this->info('Creating 5000 stores...');

        $stores = Store::factory()->count(5000)->make();
        Store::insert($stores->toArray()); // Using insert() for faster performance

        $this->info('5000 stores created.');

        ////////// Create  100 packages for each store
        $this->info('Creating 100 packages for each store...');

        $storesIds = Store::pluck('id')->toArray();
        
        $packages = [];
        foreach ($storesIds as $storesId) {
            // Using array_merge() to accumulate packages for each store
            // This approach is faster and more performant than using create() in a loop
            $packages = array_merge($packages, Package::factory(100)->make(['store_id' => $storesId])->toArray());
        }
        
        // Using array_chunk() to split the packages array into chunks of 1000
        // This makes the insert() operation faster and more performant
        // NOTE: Because we are using insert(), timestamps will not be filled, but since it's a test data, it's okay
        foreach (array_chunk($packages, 1000) as $chunk) {
            Package::insert($chunk);
        }

        $this->info('100 packages made and inserted into the database for each store.');
        $this->info('Successfully created 5000 stores and 500000 packages in total.');
        $this->info('All done!');
    }
}
