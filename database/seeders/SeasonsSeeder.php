<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SeasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('seasons')->delete();

        DB::table('seasons')->insert([
            [
                'id' => Str::uuid()->toString(),
                'season' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid()->toString(),
                'season' => 'B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
