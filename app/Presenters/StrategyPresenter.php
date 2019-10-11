<?php

namespace App\Presenters;

trait StrategyPresenter
{
	public function getTemplateArrayAttribute()
	{	
        return unserialize($this->template);
	}

	public function getSettingFieldsAttribute()
	{
		return $this->code.'_setting_fields';
	}

	public function getNotificationTableAttribute()
	{
		return $this->code.'_table';
	}

	public function getSummaryFieldsAttribute()
	{
		return $this->code.'_summary_fields';
	}

	public function getResultsFieldsAttribute()
	{
		return $this->code.'_results_fields';
	}
	
	public function getNotificationFieldsArrayAttribute()
	{
        return unserialize($this->notification_fields);
	}
}