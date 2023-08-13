<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'id' => Str::uuid()->toString(),
                'names' => 'System admin',
                'email' => 'admin@gmail.com',
                'password' => 'admin12345',
                'role' => User::ADMIN,
                'has_confirmed_password' => true,
                'phone_no' => 250788111111,
            ]
        ]);
    }
}
