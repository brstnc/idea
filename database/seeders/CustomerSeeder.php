<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'name' => "Türker Jöntürk",
                'since' =>  "2014-06-28",
                'revenue' => '492.12'
            ],
            [
                'name' => "Kaptan Devopuz",
                'since' =>  "2015-01-15",
                'revenue' => "1505.95"
            ],
            [
                'name' => "İsa Sonuyumaz",
                'since' =>  "2016-02-11",
                'revenue' => "0.00"
            ],
        ]);
    }
}
