<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'username' => 'rec',
            'password' => Hash::make('secret'),
            'role' => '2',
        ]);

        DB::table('users')->insert([
            'username' => 'doc',
            'password' => Hash::make('secret'),
            'role' => '3',
            'doctorId' => '1',
        ]);
    }
}
