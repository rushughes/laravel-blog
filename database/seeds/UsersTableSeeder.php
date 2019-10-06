<?php

use Carbon\Carbon;
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
      DB::table('users')->insert([
        'role_id' => 1,
        'is_active' => true,
        'name' => 'Rus Hughes',
        'email' => 'rus@gmail.com',
        'password' => bcrypt('password'),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('users')->insert([
        'role_id' => 2,
        'is_active' => true,
        'name' => 'Mr Potato',
        'email' => 'potato@gmail.com',
        'password' => bcrypt('password'),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
}
