{{-- 
<div class="form-group col-md-6">
	{{Form::label('asset_id','Activo:')}}
    {{Form::select('asset_id', $assets , $scanner->asset_id, ['class'=> 'form-control', 'placeholder'=>'Seleccione el activo','required'])}}
</div>
--}}

<div class="form-group col-md-12">
	{{Form::label('interval','Temporalidad de la gráfica:')}}
    {{Form::select('interval', $intervals , $scanner->interval, ['class'=> 'form-control', 'placeholder'=>'Seleccione un intervalo','required'])}}
</div>