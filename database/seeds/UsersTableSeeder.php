<?php

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
            'name'         => 'admin',
            'email'         => 'admin@gmail.com',
            'type'          => 'admin',
            'password'      => bcrypt('admin@gmail.com'),
            'created_at'    => now(),
        ]);

        DB::table('users')->insert([
            'name'         => 'joaiver',
            'email'         => 'joaiver@gmail.com',
            'type'          => 'regular',
            'password'      => bcrypt('joaiver@gmail.com'),
            'created_at'    => now(),
        ]);
    }
}
