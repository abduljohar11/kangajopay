<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = ['OkeConnect', 'Digiflazz', 'Iak'];
        foreach ($vendors as $i => $v) {
            Vendor::create([
                'name' => $v,
                'slug' => Str::slug($v),
                'urutan' => $i + 1,
            ]);
        }
    }
}
