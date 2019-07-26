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
            'scanners_limit' => '3',
            'alpha_vantage_key'  => 'MJRQQRSU4P91WRCN',
            'notifications_mail' => 'nixontorres26@gmail.com'
        ]);
    }
}
