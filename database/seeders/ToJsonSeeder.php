<?php

namespace Database\Seeders;

use App\Models\AlquranSurah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToJsonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_alquran_surah = AlquranSurah::all();

        $json_alquran_surah = $data_alquran_surah->toJson(JSON_PRETTY_PRINT);

        $file_alquran_surah = public_path('jsonAPI/alquran_surah.json');

        file_put_contents($file_alquran_surah, $json_alquran_surah);
    }
}
