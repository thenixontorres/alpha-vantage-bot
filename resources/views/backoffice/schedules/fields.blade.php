
{{Form::hidden('scanner_id', $scanner->id)}}

<div class="form-group col-md-12">
	{{Form::label('schedules[]','Actualización de la estrategia:')}}
    {{Form::select('schedules[]', [] ,null, ['class'=> 'form-control select2','multiple'=>'multiple', 'style'=>'width:100%;', 'id'=>'scanner_schedules_list'])}}
</div>