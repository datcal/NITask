<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $csvFile = fopen(base_path('database/csv/products.csv'), 'r');
        $firstLine = true;
        while(($line = fgetcsv($csvFile)) !== false) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            Product::create([
                'sku' => $line[0],
                'name' => $line[1],
            ]);
        }

        fclose($csvFile);
    }
}
