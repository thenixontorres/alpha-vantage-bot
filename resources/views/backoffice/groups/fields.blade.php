
<div class="form-group col-md-12">
	{{Form::label('name','Nombre del grupo:')}}
    {{Form::text('name', null, ['class'=> 'form-control','required'])}}
</div>

<div class="form-group col-md-12">
	{{Form::label('schedules[]','Horarios:')}}
    {{Form::select('schedules[]', $schedules, null, ['class'=> 'form-control select2','multiple'=>'multiple', 'style'=>'width:100%;', 'id'=>'scanner_schedules_list'])}}
</div>