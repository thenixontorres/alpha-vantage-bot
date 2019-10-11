@if(isset($data_array['BBANDS']))
<p><b>SUPERIOR:</b> {{ $data_array['BBANDS']['upper'] }}</p>
<p><b>MEDIA:</b> {{ $data_array['BBANDS']['middle'] }}</p>
<p><b>BAJA:</b> {{ $data_array['BBANDS']['lower'] }}</p>
<p><b>PRECIO:</b> {{ $data_array['BBANDS']['price'] }}</p>
@endif
