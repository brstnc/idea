<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'id' => 100,
                'name' => 'Black&Decker A7062 40 Parça Cırcırlı Tornavida Seti',
                'price' =>  "112.80",
                'category' => 1,
                'stock' => 10
            ],
            [
                'id' => 101,
                'name' => "Reko Mini Tamir Hassas Tornavida Seti 32'li",
                'price' =>  "49.50",
                'category' => 1,
                'stock' => 10
            ],
            [
                'id' => 102,
                'name' => "Viko Karre Anahtar - Beyaz",
                'price' =>  "11.28",
                'category' => 1,
                'stock' => 10
            ],
            [
                'id' => 103,
                'name' => 'Legrand Salbei Anahtar, Alüminyum',
                'price' =>  "22.80",
                'category' => 2,
                'stock' => 10
            ],
            [
                'id' => 104,
                'name' => 'Schneider Asfora Beyaz Komütatör',
                'price' =>  "12.95",
                'category' => 2,
                'stock' => 10
            ],
        ]);
    }
}
