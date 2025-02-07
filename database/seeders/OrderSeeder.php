<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'customer_id' => 1,
                'total' =>  "112.80"
            ],
            [
                'customer_id' => 2,
                'total' =>  "219.75"
            ],
            [
                'customer_id' => 3,
                'total' => "1275.18"
            ],
        ]);
    }
}
