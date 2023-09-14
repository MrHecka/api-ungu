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
            'nama'=>'API Ungu',
            'email'=>'apiunguverify@gmail.com',
            'nohp'=>'081809140503',
            'password'=>Hash::Make('Heckayo141414'),
            'email_verified_at'=>'2023-09-13 08:17:50',
            'is_dewa'=>1,
            'tgl_pembuatan'=>Carbon::now(),
            'apikey'=>Str::random(32),
            'wlip'=>'202.80.212.176,127.0.0.1',
            'last_activity' => now()->getTimestamp(),
        ]);
    }
}

