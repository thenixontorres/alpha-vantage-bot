<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'status'         => 'on',
            'scanners_limit' => '1',
            'alpha_vantage_api' => 'https://www.alphavantage.co',
            'notifications_mail' => 'nixontorres26@gmail.com'
        ]);
    }
}
