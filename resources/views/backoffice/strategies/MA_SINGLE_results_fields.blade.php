@if(isset($data_array['MA_SINGLE']))

<p><b>MA LENTA:</b> {{ $data_array['MA_SINGLE']['prev_ma'] }} -> {{ $data_array['MA_SINGLE']['ma'] }}</p>
<p><b>PRECIO:</b> {{ $data_array['MA_SINGLE']['prev_price'] }} -> {{ $data_array['MA_SINGLE']['price'] }}</p>

@endif
