<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($hour=0; $hour < 24; $hour++) 
		{ 	
			$hour_str = str_pad($hour, 2, "0", STR_PAD_LEFT);

			for ($minutes=0; $minutes < 60; $minutes++) 
			{ 
				$minutes_str = str_pad($minutes, 2, "0", STR_PAD_LEFT);

				$time = $hour_str.':'.$minutes_str;
				
		        DB::table('schedules')->insert([
		        	'time' => $time,
		        	'created_at' => now()
		       	]);

			}
		}

    }
}
