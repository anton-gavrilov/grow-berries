<?php

namespace Database\Seeders;

use App\Models\ChemicalBrands;
use Illuminate\Database\Seeder;

class ChemicalBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChemicalBrands::firstOrCreate(['name' => 'Everris(ICL)'], [
            'id' => 1,
            'country' => 'Netherlands',
            'name' => 'Everris(ICL)',
            'about' => '',
        ]);

        ChemicalBrands::firstOrCreate(['name' => 'Syngenta'], [
            'id' => 2,
            'country' => 'Switzerland',
            'name' => 'Syngenta',
            'about' => 'Syngenta is a global company with headquarters in Switzerland. 30,000 employees, in more than 90 countries are working to transform how crops are grown and protected.',
        ]);

        ChemicalBrands::firstOrCreate(['name' => 'Valagro'], [
            'id' => 3,
            'country' => 'Italy',
            'name' => 'Valagro',
            'about' => '',
        ]);
    }
}
