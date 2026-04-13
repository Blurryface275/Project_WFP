<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
        $hashedPassword = bcrypt('password');
        DB::table('users')->insert([
            [
                'name' => 'dr. Tirta Mandira Hudhi',
                'email' => 'tirta@gmail.com',
                'email_verified_at' => now(),
                'password' => $hashedPassword,
                'role' => 'doctor',
                'remember_token' => '1234',
            ],
            [
                'name' => 'dr. Gia Pratama',
                'email' => 'gia@gmail.com',
                'email_verified_at' => now(),
                'password' => $hashedPassword,
                'role' => 'doctor',
                'remember_token' => '1234',
            ],
            [
                'name' => 'dr. Richard Lee',
                'email' => 'richard@gmail.com',
                'email_verified_at' => now(),
                'password' => $hashedPassword,
                'role' => 'doctor',
                'remember_token' => '1234',
            ],
            [
                'name' => 'dr. tompi',
                'email' => 'tompi@gmail.com',
                'email_verified_at' => now(),
                'password' => $hashedPassword,
                'role' => 'doctor',
                'remember_token' => '1234',
            ],
            [
                'name' => 'dr. Terawan Agus Putranto',
                'email' => 'terawan@gmail.com',
                'email_verified_at' => now(),
                'password' => $hashedPassword,
                'role' => 'doctor',
                'remember_token' => '1234',
            ],
            [
                'name' => 'Alexander',
                'email' => 'alexander@gmail.com',
                'email_verified_at' => now(),
                'password' => $hashedPassword,
                'role' => 'admin',
                'remember_token' => '1234',
            ],
            [
                'name' => 'Benedictus',
                'email' => 'benedictus@gmail.com',
                'email_verified_at' => now(),
                'password' => $hashedPassword,
                'role' => 'member',
                'remember_token' => '1234',
            ],
            [
                'name' => 'Dave',
                'email' => 'dave@gmail.com',
                'email_verified_at' => now(),
                'password' => $hashedPassword,
                'role' => 'member',
                'remember_token' => '1234',
            ],
            [
                'name' => 'Hansen',
                'email' => 'hansen@gmail.com',
                'email_verified_at' => now(),
                'password' => $hashedPassword,
                'role' => 'member',
                'remember_token' => '1234',
            ],
            [
                'name' => 'Kenny',
                'email' => 'kenny@gmail.com',
                'email_verified_at' => now(),
                'password' => $hashedPassword,
                'role' => 'member',
                'remember_token' => '1234',
            ],
        ]);
    }
    //-> INI KUHAPUS KARENA ERROR TERUS INI METHOD PUNYA FACTORY, JADI GA DITARUH SINI
    // public function unverfied(): static
    // {
    //     return $this->state(fn(array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
}
