<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            ['category_name' => 'General Consultation'],
            ['category_name' => 'Specialist Consultation'],
            ['category_name' => 'Medical Check-up'],
            ['category_name' => 'Laboratory Tests'],
            ['category_name' => 'Telemedicine'],
        ]);
    }
}
