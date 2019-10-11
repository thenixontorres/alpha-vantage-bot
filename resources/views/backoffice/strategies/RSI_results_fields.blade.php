@if(isset($data_array['RSI']))
<p><b>RSI:</b> {{ $data_array['RSI']['prev_rsi'] }} -> {{ $data_array['RSI']['rsi'] }}</p>
<p><b>PRECIO:</b> {{ $data_array['RSI']['price'] }}</p>
@endif
