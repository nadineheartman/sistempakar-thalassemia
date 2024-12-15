<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KondisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kondisis')->insert(
            [
                'kondisi' => 'Pasti',
            ],
        );

        DB::table('kondisis')->insert(
            [
                'kondisi' => 'Hampir Pasti',
            ],
        );

        DB::table('kondisis')->insert([
            'kondisi' => 'Kemungkinan Besar',
        ]);

        DB::table('kondisis')->insert(
            [
                'kondisi' => 'Mungkin',
            ],
        );

        DB::table('kondisis')->insert(
            [
                'kondisi' => 'Tidak',
            ],
        );
    }
}
