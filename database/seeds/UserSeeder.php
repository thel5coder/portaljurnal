<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*\DB::table('users')->insert([
            'email'=>'admin@admin.com',
            'password'=>bcrypt('123456'),
            'name'=>'admin'
        ]);*/

        \DB::table('users')->insert([
            'email'=>'timred@timred.com',
            'password'=>bcrypt('123456'),
            'name'=>'Tim Redaksi',
            'user_level'=>'tim redaksi'
        ]);
    }
}
