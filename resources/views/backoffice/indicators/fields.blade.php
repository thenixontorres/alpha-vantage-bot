<div class="form-group col-md-12">
	{{Form::label('interval','Intervalo de tiempo entre dos puntos de datos consecutivos en la serie de tiempo:')}}
    {{Form::select('interval', $intervals ,null, ['class'=> 'form-control', 'placeholder'=>'Seleccione un periodo', 'style'=>'width:100%;'])}}
</div>

<div class="form-group col-md-12">
	{{Form::label('time_period','Número de puntos de datos utilizados para calcular cada valor:')}}
    {{Form::number('time_period' ,null, ['class'=> 'form-control', 'placeholder'=>'Solo numeros enteros', 'style'=>'width:100%;'])}}
</div>

<div class="form-group col-md-12">
	{{Form::label('series_type','El tipo de precio deseado en la serie de tiempo:')}}
    {{Form::select('series_type', $series ,null, ['class'=> 'form-control', 'placeholder'=>'Seleccione un periodo', 'style'=>'width:100%;'])}}
</div>