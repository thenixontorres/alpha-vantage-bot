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
            'name' => 'LLave Free, nixontorres26',
            'created_at' => now()
        ]);

        DB::table('keys')->insert([
            'key'         => 'P4OPSR82HZS89VQC',
            'email' => 'unclenixon@hotmail.com',
            'is_active' => false,
            'name' => 'LLave Free, unclenixon',
            'created_at' => now()
        ]);

         
    }
}
