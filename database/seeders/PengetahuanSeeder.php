<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PengetahuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengetahuans = [
            ['gejala_id' => 1, 'penyakit_id' => 1, 'nilai_cf' => 0.3],
            ['gejala_id' => 2, 'penyakit_id' => 1, 'nilai_cf' => 0.25],
            ['gejala_id' => 3, 'penyakit_id' => 1, 'nilai_cf' => 0.15],
            ['gejala_id' => 4, 'penyakit_id' => 1, 'nilai_cf' => 0.1],
            ['gejala_id' => 5, 'penyakit_id' => 1, 'nilai_cf' => 0.15],
            ['gejala_id' => 6, 'penyakit_id' => 1, 'nilai_cf' => 0],
            ['gejala_id' => 7, 'penyakit_id' => 1, 'nilai_cf' => 0],
            ['gejala_id' => 8, 'penyakit_id' => 1, 'nilai_cf' => 0],
            ['gejala_id' => 9, 'penyakit_id' => 1, 'nilai_cf' => 0],
            ['gejala_id' => 10, 'penyakit_id' => 1, 'nilai_cf' => 0],
            ['gejala_id' => 11, 'penyakit_id' => 1, 'nilai_cf' => 0.25],
            ['gejala_id' => 12, 'penyakit_id' => 1, 'nilai_cf' => 0],
            ['gejala_id' => 1, 'penyakit_id' => 2, 'nilai_cf' => 0.2],
            ['gejala_id' => 2, 'penyakit_id' => 2, 'nilai_cf' => 0.25],
            ['gejala_id' => 3, 'penyakit_id' => 2, 'nilai_cf' => 0.1],
            ['gejala_id' => 4, 'penyakit_id' => 2, 'nilai_cf' => 0.1],
            ['gejala_id' => 5, 'penyakit_id' => 2, 'nilai_cf' => 0.1],
            ['gejala_id' => 6, 'penyakit_id' => 2, 'nilai_cf' => 0.65],
            ['gejala_id' => 7, 'penyakit_id' => 2, 'nilai_cf' => 0.5],
            ['gejala_id' => 8, 'penyakit_id' => 2, 'nilai_cf' => 0.55],
            ['gejala_id' => 9, 'penyakit_id' => 2, 'nilai_cf' => 0.85],
            ['gejala_id' => 10, 'penyakit_id' => 2, 'nilai_cf' => 0.5],
            ['gejala_id' => 11, 'penyakit_id' => 2, 'nilai_cf' => 0.2],
            ['gejala_id' => 12, 'penyakit_id' => 2, 'nilai_cf' => 0.95],
        ];

        DB::table('pengetahuans')->insert($pengetahuans);
    }
}
