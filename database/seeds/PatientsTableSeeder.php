<?php

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
       public function run()
    {
        DB::table('patients')->insert([
            'first_name' => 'Katarzyna',
            'last_name' => 'Radzik',
            'pesel' => 93012399120,
            'date_of_birth' => date("Y-m-d", strtotime("12 January 1993")),
            'address' => 'Paderewskiego 2/1, 56-400 Olesnica',
        ]);

        DB::table('patients')->insert([
            'first_name' => 'Magdalena',
            'last_name' => 'Wujczyk',
            'pesel' => 89021099120,
            'date_of_birth' =>  date("Y-m-d", strtotime("10 February 1989"))->format('Y-m-d'),
            'address' => 'Paderewskiego 2/2, 56-400 Olesnica',
        ]);

        DB::table('patients')->insert([
            'first_name' => 'Michał',
            'last_name' => 'Wawrzyniak',
            'pesel' => 85111399120,
            'date_of_birth' =>  date("Y-m-d", strtotime("13 November 1985"))->format('Y-m-d'),
            'address' => 'Paderewskiego 2/3, 56-400 Olesnica',
        ]);
    }
}
