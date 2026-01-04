<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\Units;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Symfony\Component\Clock\now;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::count() == 0) {
            User::factory(10)->create();
        }
        if (Units::count() == 0) {
            $units = [
                [
                    'name' => 'pieces',
                    'abbreviation' => 'pcs',
                    'coutable' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'gram',
                    'abbreviation' => 'g',
                    'coutable' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'kilogram',
                    'abbreviation' => 'kg',
                    'coutable' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'litre',
                    'abbreviation' => 'l',
                    'coutable' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ];
            Units::insert($units);
        }
        if (Products::count() > 0) {
            Products::factory(10)->create();
        }
    }
}
