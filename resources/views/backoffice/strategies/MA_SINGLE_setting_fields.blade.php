{{-- 
<div class="form-group col-md-3">
	{{Form::label('interval','Intervalo de tiempo:')}}
    {{Form::select('interval', $intervals ,$scanner->settings_array['MA_SINGLE']['request_data']['interval'], ['class'=> 'form-control', 'placeholder'=>'Seleccione un intervalo','required'])}}
</div>
--}}
<div class="form-group col-md-4">
	{{Form::label('series_type','Tipo de precio:')}}
    {{Form::select('series_type', $series ,$scanner->settings_array['MA_SINGLE']['request_data']['series_type'], ['class'=> 'form-control', 'placeholder'=>'Seleccione un tipo','required'])}}
</div>

<div class="form-group col-md-4">
	{{Form::label('function','Tipo de MA:')}}
    {{Form::select('function',  $scanner->settings_array['MA_SINGLE']['indicators_allow'] ,$scanner->settings_array['MA_SINGLE']['request_data']['function'], ['class'=> 'form-control', 'placeholder'=>'Seleccione un tipo','required'])}}
</div>

<div class="form-group col-md-4">
	{{Form::label('time_period','Periodos:')}}
    {{Form::number('time_period' ,$scanner->settings_array['MA_SINGLE']['request_data']['time_period'], ['class'=> 'form-control', 'placeholder'=>'Solo numeros enteros', 'required'])}}
</div>



{{ Form::hidden('symbol', $scanner->settings_array['MA_SINGLE']['request_data']['symbol'])}}

{{ Form::hidden('interval', $scanner->settings_array['MA_SINGLE']['request_data']['interval'])}}

{{ Form::hidden('code', 'MA_SINGLE')}}