<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegalFormSeeder extends Seeder
{
    protected $legalForms = [
        ['name' => 'Physical person (Individual Entrepreneur)'],
        ['name' => 'One-person Limited Liability Company (EURL)'],
        ['name' => 'Limited Liability Company (SARL)'],
        ['name' => 'Joint Stock Company (SPA)'],
        ['name' => 'General Partnership (SNC)'],
        ['name' => 'Simple Limited Partnership (SCS)'],
        ['name' => 'Partnership Limited by Shares (SCA)'],
        ['name' => 'Group (GR)'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('legal_forms')->insert($this->legalForms);
    }
}
