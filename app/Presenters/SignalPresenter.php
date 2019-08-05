<?php

namespace App\Presenters;

trait SignalPresenter
{
	public function getTimeSignalAttribute()
	{
		$list = array_values($this->data_array);

		return $list[0]['time'];

	}

	public function getTypeAttribute()
	{
		$list = array_values($this->data_array);

		return $list[0]['type_html'];
	}

	public function getJustTypeAttribute()
	{
		$list = array_values($this->data_array);

		return $list[0]['type'];
	}

	public function getDataArrayAttribute()
	{
		return unserialize($this->data);
	}
}