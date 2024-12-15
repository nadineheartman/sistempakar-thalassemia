<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gejalas = [
            ['kodegejala' => 1, 'namagejala' => "Kadar Hb rendah"],
            ['kodegejala' => 2, 'namagejala' => "Pucat kronik"],
            ['kodegejala' => 3, 'namagejala' => "Badan lemah"],
            ['kodegejala' => 4, 'namagejala' => "Nafsu makan menurun"],
            ['kodegejala' => 5, 'namagejala' => "Cepat lelah"],
            ['kodegejala' => 6, 'namagejala' => "Hepatosplenomegali (pembesaran hati dan limpa)"],
            ['kodegejala' => 7, 'namagejala' => "Kuning"],
            ['kodegejala' => 8, 'namagejala' => "Perubahan tulang / pendek"],
            ['kodegejala' => 9, 'namagejala' => "Perubahan wajah (facies cooley)"],
            ['kodegejala' => 10, 'namagejala' => "Hiperpigmentasi (kulit gelap)"],
            ['kodegejala' => 11, 'namagejala' => "Gangguan pubertas"],
            ['kodegejala' => 12, 'namagejala' => "Pernah Transfusi darah?"],
        ];

        DB::table('gejalas')->insert($gejalas);
    }
}
