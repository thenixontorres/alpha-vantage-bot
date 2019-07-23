{{-- 
<div class="form-group col-md-6">
	{{Form::label('interval','Intervalo de tiempo:')}}
    {{Form::select('interval', $intervals ,$scanner->settings_array['MA_DOUBLE']['request_data']['interval'], ['class'=> 'form-control', 'placeholder'=>'Seleccione un intervalo','required'])}}
</div>
--}}

<div class="form-group col-md-12">
	{{Form::label('series_type','Tipo de precio:')}}
    
    {{Form::select(
    	'series_type', 
    	$series ,
    	$scanner->settings_array['MA_DOUBLE']['request_data']['series_type'], 
    	['class'=> 'form-control', 'placeholder'=>'Seleccione un tipo','required']
    )}}
</div>

<div class="form-group col-md-6">
	{{Form::label('slow.function','MA lenta:')}}
    {{Form::select('slow[function]',  $scanner->settings_array['MA_DOUBLE']['indicators_allow'] ,$scanner->settings_array['MA_DOUBLE']['request_data']['slow']['function'], ['class'=> 'form-control', 'placeholder'=>'Seleccione un tipo','required'])}}
</div>

<div class="form-group col-md-6">
	{{Form::label('slow.time_period','Periodos MA lenta:')}}
    {{Form::number('slow[time_period]' ,$scanner->settings_array['MA_DOUBLE']['request_data']['slow']['time_period'], ['class'=> 'form-control', 'placeholder'=>'Solo numeros enteros', 'required'])}}
</div>

<div class="form-group col-md-6">
	{{Form::label('fast.function','MA rápida:')}}
    {{Form::select('fast[function]',  $scanner->settings_array['MA_DOUBLE']['indicators_allow'] ,$scanner->settings_array['MA_DOUBLE']['request_data']['fast']['function'], ['class'=> 'form-control', 'placeholder'=>'Seleccione un tipo','required'])}}
</div>

<div class="form-group col-md-6">
	{{Form::label('fast.time_period','Periodos MA rápida:')}}
    {{Form::number('fast[time_period]' ,$scanner->settings_array['MA_DOUBLE']['request_data']['fast']['time_period'], ['class'=> 'form-control', 'placeholder'=>'Solo numeros enteros', 'required'])}}
</div>


{{ Form::hidden('symbol', $scanner->settings_array['MA_DOUBLE']['request_data']['symbol'])}}

{{ Form::hidden('interval', $scanner->settings_array['MA_DOUBLE']['request_data']['interval'])}}

{{ Form::hidden('code', 'MA_DOUBLE')}}