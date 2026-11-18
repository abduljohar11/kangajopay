<?php

namespace Database\Seeders;

use App\Enums\RoleUser;
use App\Enums\StatusUser;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levelId = Level::where('is_default', true)->value('id');
        $users = [
            [
                'name' => 'Admin',
                'role' => RoleUser::ADMIN,
                'status' => StatusUser::ACTIVE,
            ],
            [
                'name' => 'Admin Pending',
                'role' => RoleUser::ADMIN,
                'status' => StatusUser::PENDING,
            ],
            [
                'name' => 'Admin Suspended',
                'role' => RoleUser::ADMIN,
                'status' => StatusUser::SUSPENDED,
            ],
            [
                'name' => 'User',
                'role' => RoleUser::USER,
                'status' => StatusUser::ACTIVE,
            ],
            [
                'name' => 'User Pending',
                'role' => RoleUser::USER,
                'status' => StatusUser::PENDING,
            ],
            [
                'name' => 'User Suspended',
                'role' => RoleUser::USER,
                'status' => StatusUser::SUSPENDED,
            ],
        ];

        foreach ($users as $index => $user) {
            $name = Str::slug($user['name'], '_');
            $phone = '0857123456';

            User::forceCreate([
                'name' => $user['name'],
                'username' => $name,
                'email' => $name . '@ajocell.com',
                'phone' => $phone . $index . $index + 1,
                'role' => $user['role'],
                'status' => $user['status'],
                'password' => 'password123',
                'pin' => '123456',
                'level_id' => $levelId,
                'balance' => 100000,
            ]);
        }
    }
}
