<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Eddy Rufino',
            'username' => 'EddyRufino',
            'email' => 'eddyjaair@gmail.com',
            'password' => bcrypt('password'),
            'admin' => true
        ]);
    }
}
