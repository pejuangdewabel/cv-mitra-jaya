<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TentangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tentang')->insert([
            'wa'            => '6289912781211',
            'alamat'        => 'Jl. Apa No 34, Bandar Lampung',
            'email'         => 'admin@gmail.com',
            'ig'            => 'aaaaaa',
            'fb'            => 'aaaaaa',
            'hero'          => 'aaaaaa',
            'created_at'    => Carbon::now()->toDateTimeString(),
            'updated_at'    => Carbon::now()->toDateTimeString()
        ]);
    }
}
