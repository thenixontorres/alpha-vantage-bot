@if(isset($data_array['MA_DOUBLE']))
<p><b>EMA RAPIDA:</b> {{ $data_array['MA_DOUBLE']['prev_fast_ma'] }} -> {{ $data_array['MA_DOUBLE']['fast_ma'] }}</p>
<p><b>EMA LENTA:</b> {{ $data_array['MA_DOUBLE']['prev_slow_ma'] }} -> {{ $data_array['MA_DOUBLE']['slow_ma'] }}</p>
<p><b>PRECIO:</b> {{ $data_array['MA_DOUBLE']['price'] }}</p>
@endif
