<?php

use Illuminate\Database\Seeder;

class KeysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keys')->insert([
            'key'         => 'MJRQQRSU4P91WRCN',
            'email' => 'nixontorres26@gmail.com',
            'is_active' => true,
            'name' => 'LLave Free, Nixon',
            'created_at' => now()
        ]);
    }
}
