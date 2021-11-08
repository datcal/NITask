<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path('database/csv/purchased.csv'), 'r');
        $firstLine = true;
        while(($line = fgetcsv($csvFile)) !== false) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            Order::create([
                'user_id' => $line[0],
                'product_sku' => $line[1]
            ]);
        }

        fclose($csvFile);
    }
}
