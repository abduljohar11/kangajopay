<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operators = config('operator.category');
        $prefixOrVoucher = [
            [
                'name' => 'Pulsa',
                'icon' => 'Smartphone',
                'type' => CategoryType::PREFIX,
                'tingkat' => 1,
                'urutan' => 1,
            ],
            [
                'name' => 'Kuota',
                'icon' => 'SmartphoneNfc',
                'type' => CategoryType::PREFIX,
                'tingkat' => 1,
                'urutan' => 2,
            ],
            [
                'name' => 'Voucher',
                'icon' => 'SmartphoneNfc',
                'type' => CategoryType::VOUCHER,
                'tingkat' => 1,
                'urutan' => 3,
            ],
        ];
        foreach ($prefixOrVoucher as $i => $p) {
            $parent = Category::create([
                'name' => $p['name'],
                'icon' => $p['icon'],
                'type' => $p['type'],
                'tingkat' => $p['tingkat'],
                'urutan' => $p['urutan'],
            ]);

            foreach ($operators as $index => $o) {
                $name = Str::title($parent->name . ' ' . $o);
                Category::create([
                    'parent_id' => $parent->id,
                    'name' => $name,
                    'icon' => $parent->icon,
                    'type' => $parent->type,
                    'tingkat' => 2,
                    'urutan' => $index + 1,
                ]);
            }
        }
        $categories = [
            [
                'name' => 'Token',
                'icon' => 'Zap',
                'type' => CategoryType::PRABAYAR,
                'tingkat' => 1,
                'urutan' => 4,
            ],
            [
                'name' => 'BPJS',
                'icon' => 'Flame',
                'type' => CategoryType::PASCABAYAR,
                'tingkat' => 1,
                'urutan' => 5,
                'children' => [
                    ['name' => 'BPJS Kesehatan', 'urutan' => 1, 'tingkat' => 2],
                    [
                        'name' => 'BPJS Ketenaga Kerjaan',
                        'urutan' => 2,
                        'tingkat' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Tv',
                'icon' => 'Tv',
                'type' => CategoryType::PRABAYAR,
                'tingkat' => 1,
                'urutan' => 6,
                'children' => [['name' => 'K Vision', 'tingkat' => 2, 'urutan' => 1]],
            ],
        ];

        foreach ($categories as $category) {
            $parent = Category::create([
                'name' => $category['name'],
                'icon' => $category['icon'],
                'type' => $category['type'],
                'tingkat' => $category['tingkat'],
                'urutan' => $category['urutan'],
            ]);

            if (isset($category['children'])) {
                foreach ($category['children'] as $anak) {
                    Category::create([
                        'parent_id' => $parent->id,
                        'name' => $anak['name'],
                        'icon' => $parent->icon,
                        'type' => $parent->type,
                        'tingkat' => $anak['tingkat'],
                        'urutan' => $anak['urutan'],
                    ]);
                }
            }
        }
    }
}
