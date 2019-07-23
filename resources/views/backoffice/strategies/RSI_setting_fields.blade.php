<div class="form-group col-md-12">
	{{Form::label('series_type','Tipo de precio:')}}
    
    {{Form::select(
    	'series_type', 
    	$series ,
    	$scanner->settings_array['RSI']['request_data']['series_type'], 
    	['class'=> 'form-control', 'placeholder'=>'Seleccione un tipo','required']
    )}}
</div>

<div class="form-group col-md-12">
	{{Form::label('time_period','Periodos:')}}
    {{Form::number('time_period' ,$scanner->settings_array['RSI']['request_data']['time_period'], ['class'=> 'form-control', 'placeholder'=>'Solo numeros enteros', 'required'])}}
</div>

{{ Form::hidden('function', $scanner->settings_array['RSI']['request_data']['function'])}}

{{ Form::hidden('symbol', $scanner->settings_array['RSI']['request_data']['symbol'])}}

{{ Form::hidden('interval', $scanner->settings_array['RSI']['request_data']['interval'])}}

{{ Form::hidden('code', 'RSI')}}