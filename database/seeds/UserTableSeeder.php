<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'is_admin' => true,
            'password' => Hash::make('123123123'),
            'email_verified_at' => '2023-6-19 00:00:00'
        ]);
    }
}
