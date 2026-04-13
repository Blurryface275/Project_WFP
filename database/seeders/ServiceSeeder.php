<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('Services')->insert([
            [
                'service_name' => 'Konsultasi Dokter Online',
                'description' => 'Layanan konsultasi kesehatan secara online dengan dokter umum untuk membantu menjawab berbagai keluhan',
                'availability' => '08.00-21.00',
                'category_id' => 1,
                'price' => 50000,
            ],
            [
                'service_name' => 'Konsultasi Dokter Offline',
                'description' => 'Layanan konsultasi kesehatan secara offline dengan dokter umum untuk membantu menjawab berbagai keluhan',
                'availability' => '10.00-21.00',
                'category_id' => 2,
                'price' => 100000,
            ],
            [
                'service_name' => 'Pemeriksaan Tes Darah Diabetes',
                'description' => 'Layanan pemeriksaan tes darah untuk mendeteksi dan memantau diabetes',
                'availability' => '08.00-21.00',
                'category_id' => 3,
                'price' => 75000,
            ],
            [
                'service_name' => 'Pemeriksaan Obat',
                'description' => 'Layanan pemeriksaan obat untuk memastikan keamanan dan efektivitas penggunaan obat',
                'availability' => '08.00-21.00',
                'category_id' => 4,
                'price' => 25000,
            ],

        ]);
    }
}
