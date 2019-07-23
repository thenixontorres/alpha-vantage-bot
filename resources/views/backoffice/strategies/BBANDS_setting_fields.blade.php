
<div class="form-group col-md-12">
	{{Form::label('time_period','Periodos:')}}
    {{Form::number('time_period' ,$scanner->settings_array['BBANDS']['request_data']['time_period'], ['class'=> 'form-control', 'placeholder'=>'Solo numeros enteros', 'required'])}}
</div>

<div class="form-group col-md-12">
	{{Form::label('nbdevup','Banda Alta:')}}
    {{Form::number('nbdevup' ,$scanner->settings_array['BBANDS']['request_data']['nbdevup'], ['class'=> 'form-control', 'placeholder'=>'Solo numeros enteros', 'required'])}}
</div>


<div class="form-group col-md-12">
	{{Form::label('nbdevdn','Banda Baja:')}}
    {{Form::number('nbdevdn' ,$scanner->settings_array['BBANDS']['request_data']['nbdevdn'], ['class'=> 'form-control', 'placeholder'=>'Solo numeros enteros', 'required'])}}
</div>


<div class="form-group col-md-12">
	{{Form::label('matype','Tipo de MA:')}}
    {{Form::select('matype' , $scanner->settings_array['BBANDS']['indicators_allow'] ,$scanner->settings_array['BBANDS']['request_data']['matype'], ['class'=> 'form-control', 'placeholder'=>'Seleccione un tipo', 'required'])}}
</div>

<div class="form-group col-md-12">
	{{Form::label('series_type','Tipo de precio:')}}
    
    {{Form::select(
    	'series_type', 
    	$series ,
    	$scanner->settings_array['BBANDS']['request_data']['series_type'], 
    	['class'=> 'form-control', 'placeholder'=>'Seleccione un tipo','required']
    )}}
</div>

{{-- 
{{ Form::hidden('series_type', $scanner->settings_array['BBANDS']['request_data']['series_type'])}}
--}}

{{ Form::hidden('function', $scanner->settings_array['BBANDS']['request_data']['function'])}}

{{ Form::hidden('symbol', $scanner->settings_array['BBANDS']['request_data']['symbol'])}}

{{ Form::hidden('interval', $scanner->settings_array['BBANDS']['request_data']['interval'])}}

{{ Form::hidden('code', 'BBANDS')}}