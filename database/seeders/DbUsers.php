<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DbUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // REMOVE ALL INCREMENTING TABLE (RESET ROWS)
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'nama'=>'Nyenye',
            'email'=>'nyenye@gmail.com',
            'nohp'=>'087829190342',
            'password'=>Hash::Make('nyenye'),
            'is_dewa'=>1,
            'tgl_pembuatan'=>Carbon::now(),
            'apikey'=>Str::random(32),
            'wlip'=>'202.80.212.176,127.0.0.1',
        ]);
    }
}
