<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DoctorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('doctor_schedules')->insert([
            // dr. Tirta (doctor_id 1)
            ['doctor_id' => 1, 'day' => 'monday', 'start_time' => '08:00', 'end_time' => '12:00', 'is_available' => true],
            ['doctor_id' => 1, 'day' => 'monday', 'start_time' => '16:00', 'end_time' => '20:00', 'is_available' => true],
            ['doctor_id' => 1, 'day' => 'tuesday', 'start_time' => '08:00', 'end_time' => '12:00', 'is_available' => true],
            ['doctor_id' => 1, 'day' => 'wednesday', 'start_time' => '08:00', 'end_time' => '12:00', 'is_available' => true],
            ['doctor_id' => 1, 'day' => 'thursday', 'start_time' => '08:00', 'end_time' => '12:00', 'is_available' => true],
            ['doctor_id' => 1, 'day' => 'friday', 'start_time' => '08:00', 'end_time' => '12:00', 'is_available' => true],

            // dr. Gia (doctor_id 2)
            ['doctor_id' => 2, 'day' => 'tuesday', 'start_time' => '09:00', 'end_time' => '12:00', 'is_available' => true],
            ['doctor_id' => 2, 'day' => 'tuesday', 'start_time' => '13:00', 'end_time' => '15:00', 'is_available' => true],
            ['doctor_id' => 2, 'day' => 'thursday', 'start_time' => '09:00', 'end_time' => '12:00', 'is_available' => true],
            ['doctor_id' => 2, 'day' => 'saturday', 'start_time' => '10:00', 'end_time' => '14:00', 'is_available' => true],

            // dr. Richard (doctor_id 3)
            ['doctor_id' => 3, 'day' => 'monday', 'start_time' => '07:00', 'end_time' => '10:00', 'is_available' => true],
            ['doctor_id' => 3, 'day' => 'monday', 'start_time' => '12:00', 'end_time' => '15:00', 'is_available' => true],
            ['doctor_id' => 3, 'day' => 'monday', 'start_time' => '19:00', 'end_time' => '21:00', 'is_available' => true],
            ['doctor_id' => 3, 'day' => 'wednesday', 'start_time' => '08:00', 'end_time' => '12:00', 'is_available' => true],
            ['doctor_id' => 3, 'day' => 'wednesday', 'start_time' => '18:00', 'end_time' => '21:00', 'is_available' => true],
            ['doctor_id' => 3, 'day' => 'friday', 'start_time' => '08:00', 'end_time' => '12:00', 'is_available' => true],
            ['doctor_id' => 3, 'day' => 'friday', 'start_time' => '14:00', 'end_time' => '17:00', 'is_available' => true],

            // dr. Tompi (doctor_id 4)
            ['doctor_id' => 4, 'day' => 'monday', 'start_time' => '13:00', 'end_time' => '17:00', 'is_available' => true],
            ['doctor_id' => 4, 'day' => 'wednesday', 'start_time' => '13:00', 'end_time' => '17:00', 'is_available' => true],
            ['doctor_id' => 4, 'day' => 'friday', 'start_time' => '09:00', 'end_time' => '12:00', 'is_available' => true],
            ['doctor_id' => 4, 'day' => 'saturday', 'start_time' => '08:00', 'end_time' => '11:00', 'is_available' => false],

            // dr. Terawan (doctor_id 5)
            ['doctor_id' => 5, 'day' => 'tuesday', 'start_time' => '08:00', 'end_time' => '12:00', 'is_available' => true],
            ['doctor_id' => 5, 'day' => 'tuesday', 'start_time' => '18:00', 'end_time' => '21:00', 'is_available' => true],
            ['doctor_id' => 5, 'day' => 'thursday', 'start_time' => '08:00', 'end_time' => '12:00', 'is_available' => true],
            ['doctor_id' => 5, 'day' => 'thursday', 'start_time' => '14:00', 'end_time' => '17:00', 'is_available' => true],
            ['doctor_id' => 5, 'day' => 'saturday', 'start_time' => '09:00', 'end_time' => '13:00', 'is_available' => true],
        ]);
    }
}
