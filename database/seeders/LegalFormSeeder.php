<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegalFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $legalForms = [
            ['name' => 'Physical person (Individual Entrepreneur)'],
            ['name' => 'One-person Limited Liability Company (EURL)'],
            ['name' => 'Limited Liability Company (SARL)'],
            ['name' => 'Joint Stock Company (SPA)'],
            ['name' => 'General Partnership (SNC)'],
            ['name' => 'Simple Limited Partnership (SCS)'],
            ['name' => 'Partnership Limited by Shares (SCA)'],
            ['name' => 'Group (GR)'],
        ];

        DB::table('legal_forms')->insert($legalForms);
    }
}
