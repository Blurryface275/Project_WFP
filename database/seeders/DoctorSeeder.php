<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctors')->insert([
            [
                'name' => 'dr. Tirta Mandira Hudhi',
                'user_id' => DB::table('users')->where('email', 'tirta@gmail.com')->value('id'),
                'specialization' => 'Dokter Umum',
                'experience_years' => '11 Tahun',
                'phone_number' => '081233334444',
                'email' => 'tirta@gmail.com',
                'photo' => 'doctors/DrTirta.jpg',
            ],
            [
                'name' => 'dr. Gia Pratama',
                'user_id' => DB::table('users')->where('email', 'gia@gmail.com')->value('id'),
                'specialization' => 'Dokter Umum / Emergency Medicine',
                'experience_years' => '15 Tahun',
                'phone_number' => '081255556666',
                'email' => 'gia@gmail.com',
                'photo' => 'doctors/DrGia.jpg',
            ],
            [
                'name' => 'dr. Richard Lee',
                'user_id' => DB::table('users')->where('email', 'richard@gmail.com')->value('id'),
                'specialization' => 'Spesialis Kecantikan & Kulit',
                'experience_years' => '10 Tahun',
                'phone_number' => '081277778888',
                'email' => 'richard@gmail.com',
                'photo' => 'doctors/DrRichard.jpg',
            ],
            [
                'name' => 'dr. tompi',
                'user_id' => DB::table('users')->where('email', 'tompi@gmail.com')->value('id'),
                'specialization' => 'Spesialis Bedah Plastik',
                'experience_years' => '20 Tahun',
                'phone_number' => '081299990000',
                'email' => 'tompi@gmail.com',
                'photo' => 'doctors/DrTompi.jpeg',
            ],
            [
                'name' => 'dr. Terawan Agus Putranto',
                'user_id' => DB::table('users')->where('email', 'terawan@gmail.com')->value('id'),
                'specialization' => 'Spesialis Radiologi',
                'experience_years' => '30 Tahun',
                'phone_number' => '081211112222',
                'email' => 'terawan@gmail.com',
                'photo' =>  'doctors/DrTerawan.jpeg',
            ],
        ]);
    }
}
