
<div class="form-group col-md-12">
	{{Form::label('group_id','Grupo:')}}
    {{Form::select('group_id', $groups , $scanner->group_id, ['class'=> 'form-control', 'placeholder'=>'Seleccione un grupo de horario'])}}
</div>

<div class="form-group col-md-12">
	{{Form::label('interval','Temporalidad de la gráfica:')}}
    {{Form::select('interval', $intervals , $scanner->interval, ['class'=> 'form-control', 'placeholder'=>'Seleccione un intervalo','required'])}}
</div>