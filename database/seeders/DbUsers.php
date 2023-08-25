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
        DB::table('users')->insert([
            'nama'=>'Nyenye',
            'email'=>'nyenye@gmail.com',
            'nohp'=>'087829190342',
            'password'=>Hash::Make('nyenye'),
            'tgl_pembuatan'=>Carbon::now(),
            'apikey'=>Str::random(32),
        ]);
    }
}
