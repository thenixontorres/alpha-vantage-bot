<?php

namespace App\Presenters;

trait ScannerPresenter
{  	
	public function getCountColsAttribute(){

		$count = count($this->strategies);

		return 12;

		//return 12/$count;

	}

	public function getSettingsArrayAttribute()
	{	
        return unserialize($this->settings);
	}

	public function getTableFieldsAttribute()
	{
		return $this->strategy->code.'_table_fields';
	}

	public function getIntervalMsAttribute(){

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

		//$interval = $this->settings_array['request_data']['interval'];

		return $defaults[$this->interval];
	}

	public function getSettingsListAttribute()
	{

		return '---';
	}

	public function getMergedSymbolsAttribute()
	{
		if ($this->scanner_type == 'stock_market') 
		{
			return $this->asset->symbol;
			
		}elseif($this->scanner_type == 'physical')
		{
			return $this->asset->symbol.$this->assetTo->symbol;
		}
	}
}