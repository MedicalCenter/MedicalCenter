<?php

use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Doctors')->insert([
            'first_name' => 'Jan',
            'last_name' => 'Kowalski',
            'specialization' => 'Internista',
        ]);

        DB::table('Doctors')->insert([
            'first_name' => 'Adam',
            'last_name' => 'Nawałka',
            'specialization' => 'Chirurg',
        ]);

        DB::table('Doctors')->insert([
            'first_name' => 'Jason',
            'last_name' => 'Stradham',
            'specialization' => 'Pediatra',
        ]);
    }
}
