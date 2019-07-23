{{-- 
<div class="form-group col-md-6">
	{{Form::label('interval','Intervalo de tiempo:')}}
    {{Form::select('interval', $intervals ,$scanner->settings_array['STOCH']['request_data']['interval'], ['class'=> 'form-control', 'placeholder'=>'Seleccione un intervalo','required'])}}
</div>
--}}
<div class="form-group col-md-12">
	{{Form::label('fastkperiod','Smooth:')}}
    {{Form::number('fastkperiod' ,$scanner->settings_array['STOCH']['request_data']['fastkperiod'], ['class'=> 'form-control', 'placeholder'=>'Solo numeros enteros', 'required'])}}
</div>


<div class="form-group col-md-6">
	{{Form::label('slowkperiod','MA (K):')}}
    {{Form::number('slowkperiod' ,$scanner->settings_array['STOCH']['request_data']['slowkperiod'], ['class'=> 'form-control', 'placeholder'=>'Solo numeros enteros', 'required'])}}
</div>


<div class="form-group col-md-6">
	{{Form::label('slowdperiod','MA (D):')}}
    {{Form::number('slowdperiod' ,$scanner->settings_array['STOCH']['request_data']['slowdperiod'], ['class'=> 'form-control', 'placeholder'=>'Solo numeros enteros', 'required'])}}
</div>



<div class="form-group col-md-6">
	{{Form::label('slowkmatype','Tipo de MA (K):')}}
    {{Form::select('slowkmatype' , $scanner->settings_array['STOCH']['indicators_allow'] ,$scanner->settings_array['STOCH']['request_data']['slowkmatype'], ['class'=> 'form-control', 'placeholder'=>'Seleccione un tipo', 'required'])}}
</div>

<div class="form-group col-md-6">
	{{Form::label('slowdmatype','Tipo de MA (D):')}}
    {{Form::select('slowdmatype' , $scanner->settings_array['STOCH']['indicators_allow'] ,$scanner->settings_array['STOCH']['request_data']['slowdmatype'], ['class'=> 'form-control', 'placeholder'=>'Seleccione un tipo', 'required'])}}
</div>

{{ Form::hidden('function', $scanner->settings_array['STOCH']['request_data']['function'])}}

{{ Form::hidden('symbol', $scanner->settings_array['STOCH']['request_data']['symbol'])}}

{{ Form::hidden('interval', $scanner->settings_array['STOCH']['request_data']['interval'])}}

{{ Form::hidden('code', 'STOCH')}}