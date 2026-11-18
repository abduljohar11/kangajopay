<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['name' => 'Mitra', 'markup' => 1000, 'is_default' => true],
            [
                'name' => 'Basic',
                'markup' => 800,
                'is_default' => false,
            ],
            [
                'name' => 'Gold',
                'markup' => 600,
                'is_default' => false,
            ],
            [
                'name' => 'Premium',
                'markup' => 400,
                'is_default' => false,
            ],
            [
                'name' => 'Juragan',
                'markup' => 200,
                'is_default' => false,
            ],
        ];

        foreach ($levels as $l) {
            Level::create([
                'name' => $l['name'],
                'slug' => Str::slug($l['name']),
                'markup' => $l['markup'],
                'is_default' => $l['is_default'],
            ]);
        }
    }
}
