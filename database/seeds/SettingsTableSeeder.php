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
            'type_request'         => 'strict',
            'strict_time_request'      => '60min',
            'alpha_vantage_key'  => 'MJRQQRSU4P91WRCN',
            'notifications_mail' => 'nixontorres26@gmail.com'
        ]);
    }
}
