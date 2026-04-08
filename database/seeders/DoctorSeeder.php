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
                'photo' => 'https://www.itb.ac.id/files/dokumentasi/1714394948-Dr-Tirta-ITB.jpg',
            ],
            [
                'name' => 'dr. Gia Pratama',
                'user_id' => DB::table('users')->where('email', 'gia@gmail.com')->value('id'),
                'specialization' => 'Dokter Umum / Emergency Medicine',
                'experience_years' => '15 Tahun',
                'phone_number' => '081255556666',
                'email' => 'gia@gmail.com',
                'photo' => 'https://asset.tribunnews.com/tkkxrKMeZBisnMF7CHXxx3QJDqg=/1200x675/filters:upscale():quality(30):format(webp):focal(0.5x0.5:0.5x0.5)/medan/foto/bank/originals/dr-Gia-Pratama-Putra-di-podcast-Raditya-Dika.jpg',
            ],
            [
                'name' => 'dr. Richard Lee',
                'user_id' => DB::table('users')->where('email', 'richard@gmail.com')->value('id'),
                'specialization' => 'Spesialis Kecantikan & Kulit',
                'experience_years' => '10 Tahun',
                'phone_number' => '081277778888',
                'email' => 'richard@gmail.com',
                'photo' => 'https://cdn-jjmn.jawapos.com/images/15/2025/03/06/Richard-Lee-IG_p_C5idNOLy7nT-5-700p-2490149795-3225674032.jpg',
            ],
            [
                'name' => 'dr. tompi',
                'user_id' => DB::table('users')->where('email', 'tompi@gmail.com')->value('id'),
                'specialization' => 'Spesialis Bedah Plastik',
                'experience_years' => '20 Tahun',
                'phone_number' => '081299990000',
                'email' => 'tompi@gmail.com',
                'photo' => 'https://awsimages.detik.net.id/community/media/visual/2023/03/21/tompi_34.jpeg?w=1200',
            ],
            [
                'name' => 'dr. Terawan Agus Putranto',
                'user_id' => DB::table('users')->where('email', 'terawan@gmail.com')->value('id'),
                'specialization' => 'Spesialis Radiologi',
                'experience_years' => '30 Tahun',
                'phone_number' => '081211112222',
                'email' => 'terawan@gmail.com',
                'photo' =>  'https://bskdn.kemendagri.go.id/website/wp-content/uploads/2018/04/dr-terawan.jpeg',
            ],
        ]);
    }
}
