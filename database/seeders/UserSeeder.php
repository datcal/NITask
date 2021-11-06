<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $csvFile = fopen(base_path('database/csv/users.csv'), 'r');
        $firstLine = true;
        while(($line = fgetcsv($csvFile)) !== false) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            User::create([
                'id' => $line[0],
                'name' => $line[1],
                'email' => $line[2],
                'password' => '102030', # Hash::make('102030'),
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
            ]);
        }

        fclose($csvFile);
    }
}
