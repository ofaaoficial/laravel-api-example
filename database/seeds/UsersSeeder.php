<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Oscar Amado',
            'email' => 'oscarfamado@gmail.com',
            'username' => 'ofaaoficial',
            'password' => bcrypt('ofaaoficial'),
            'token' => md5('username')
        ]);
    }
}
