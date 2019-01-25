<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $items = array (
            0 => 
            array (
                'name' => 'Test',
                'email' => 'test@mail.com',
                'password' => bcrypt('123123'),
            ),
        );
        foreach ($items as $key => $value) DB::table('users')->insert($value);
    }
}