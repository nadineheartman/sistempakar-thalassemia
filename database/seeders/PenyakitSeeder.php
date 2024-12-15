<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyakits = [
            ['kodepenyakit' => 1, 'namapenyakit' => "Thalassemia Minor"],
            ['kodepenyakit' => 2, 'namapenyakit' => "Thalassemia Mayor / Intermedia"],
        ];

        DB::table('penyakits')->insert($penyakits);
    }
}
