<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FromJsonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_alquran_surah = public_path('jsonAPI/alquran_surah.json');

        $json_alqruan_surah = file_get_contents($file_alquran_surah);

        $data_alquran_surah = json_decode($json_alqruan_surah, true);

        DB::table('alquran_surah')->insert($data_alquran_surah);
    }
}
