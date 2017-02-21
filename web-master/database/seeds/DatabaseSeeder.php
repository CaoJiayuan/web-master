<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        \App\User::create([
            'name'     => '0x01301c74',
            'email'    => 'cjy632258@hotmail.com',
            'password' => bcrypt(632258),
        ]);
    }
}
