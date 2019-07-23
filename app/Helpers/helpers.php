<?php
 
use App\Models\Setting;

function getSettings()
{   
        if (Schema::hasTable('settings')) 
        {
                return Setting::first()->toArray();
        }

        return [];
}

function getSetting($key)
{
        if (Schema::hasTable('settings')) 
        {
	       $settings = Setting::first()->toArray();

               return $settings[$key];
        }

        return null;
}

function getStrictTimeRequestMs()
{	
        if (Schema::hasTable('settings')) 
        {

        	$settings = Setting::first();

        	$defaults = [
                        '1min' => 60000,
                        '5min' => 300000,
                        '15min' => 900000,
                        '30min' => 1800000,
                        '60min' => 3600000,
                        'daily' => 86400000,
                        'weekly' => 604800000,
                        'monthly' => 2628000000
        	];

	       return $defaults[$settings->strict_time_request];
        }

        return 3600000;
}
