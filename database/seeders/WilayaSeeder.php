<?php

namespace Database\Seeders;

use App\Models\Wilaya;
use Illuminate\Database\Seeder;

class WilayaSeeder extends Seeder
{
    protected $wilayas = [
        [
            'name' => 'Adrar',
        ],
        [
            'name' => 'Chlef',
        ],
        [
            'name' => 'Laghouat',
        ],
        [
            'name' => 'Oum El Bouaghi',
        ],
        [
            'name' => 'Batna',
        ],
        [
            'name' => 'Béjaïa',
        ],
        [
            'name' => 'Biskra',
        ],
        [
            'name' => 'Bechar',
        ],
        [
            'name' => 'Blida',
        ],
        [
            'name' => 'Bouira',
        ],
        [
            'name' => 'Tamanrasset',
        ],
        [
            'name' => 'Tbessa',
        ],
        [
            'name' => 'Tlemcen',
        ],
        [
            'name' => 'Tiaret',
        ],
        [
            'name' => 'Tizi Ouzou',
        ],
        [
            'name' => 'Alger',
        ],
        [
            'name' => 'Djelfa',
        ],
        [
            'name' => 'Jijel',
        ],
        [
            'name' => 'Setif',
        ],
        [
            'name' => 'Saeda',
        ],
        [
            'name' => 'Skikda',
        ],
        [
            'name' => 'Sidi Bel Abbes',
        ],
        [
            'name' => 'Annaba',
        ],
        [
            'name' => 'Guelma',
        ],
        [
            'name' => 'Constantine',
        ],
        [
            'name' => 'Medea',
        ],
        [
            'name' => 'Mostaganem',
        ],
        [
            'name' => "M'Sila",
        ],
        [
            'name' => 'Mascara',
        ],
        [
            'name' => 'Ouargla',
        ],
        [
            'name' => 'Oran',
        ],
        [
            'name' => 'El Bayadh',
        ],
        [
            'name' => 'Illizi',
        ],
        [
            'name' => 'Bordj Bou Arreridj',
        ],
        [
            'name' => 'Boumerdes',
        ],
        [
            'name' => 'El Tarf',
        ],
        [
            'name' => 'Tindouf',
        ],
        [
            'name' => 'Tissemsilt',
        ],
        [
            'name' => 'El Oued',
        ],
        [
            'name' => 'Khenchela',
        ],
        [
            'name' => 'Souk Ahras',
        ],
        [
            'name' => 'Tipaza',
        ],
        [
            'name' => 'Mila',
        ],
        [
            'name' => 'Ain Defla',
        ],
        [
            'name' => 'Naama',
        ],
        [
            'name' => 'Ain Temouchent',
        ],
        [
            'name' => 'Ghardaefa',
        ],
        [
            'name' => 'Relizane',
        ],
        [
            'name' => "El M'ghair",
        ],
        [
            'name' => 'El Menia',
        ],
        [
            'name' => 'Ouled Djellal',
        ],
        [
            'name' => 'Bordj Baji Mokhtar',
        ],
        [
            'name' => 'Béni Abbès',
        ],
        [
            'name' => 'Timimoun',
        ],
        [
            'name' => 'Touggourt',
        ],
        [
            'name' => 'Djanet',
        ],
        [
            'name' => 'In Salah',
        ],
        [
            'name' => 'In Guezzam',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wilaya::insert($this->wilayas);
    }
}
