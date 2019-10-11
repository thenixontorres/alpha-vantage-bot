@if(isset($data_array['STOCH']))

<p><b>K:</b> {{ $data_array['STOCH']['prev_k'] }} -> {{ $data_array['STOCH']['k'] }}</p>
<p><b>D:</b> {{ $data_array['STOCH']['prev_d'] }} -> {{ $data_array['STOCH']['d'] }}</p>
<p><b>PRECIO:</b> {{ $data_array['STOCH']['price'] }}</p>

@endif
