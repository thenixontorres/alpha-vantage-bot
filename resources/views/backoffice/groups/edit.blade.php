@extends('layouts.backoffice')
@section('css')
@parent
<link href="{{asset('vendor/select2/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', $group->name)

@section('content')
<div class="container">
    <div class="row">
   
      	<div class="col-md-12 pb-4">

            <div class="card">
                <div class="card-header border-0">
                    <div class="custom-title-wrap bar-info">
                        <div class="custom-title">Horarios</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::model($group, ['route' => ['backoffice.groups.update', $group], 'method' => 'patch']) !!}
								
                                @include('backoffice.groups.fields')
				                
				                <div class="form-group col-md-12">
				                    <a href="{{ route('backoffice.groups.index') }}" class="btn btn-danger btn-pill">Volver</a>
				                    {{Form::submit('Actualizar', ['class'=>'btn btn-success btn-pill'])}}
				                </div>
							{{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
    @parent
 	<script src="{{ asset('vendor/select2/js/select2.min.js')}}"></script>
	
	<script>
		$(document).ready(function() {
		    $('.select2').select2();
		});
	</script>

    {{-- Precarga de selects profesores --}}
    <script type="text/javascript">
      $(document).ready(function() {
           
        {{-- Precargamos el select --}}
        var url = "{!! route('backoffice.groups.getGroupSchedules', [$group]) !!}";
        var scannerSchedulesList = $("#scanner_schedules_list");

            $.ajax({
                type: 'GET',
                dataType: "json",   
                url:url
            }).then(function (response) {

                scannerSchedulesList.empty().trigger('change');

                $.each(response, function( index, schedule ) {

                    var option = new Option(schedule.time, schedule.id, true, schedule.selected);

                    scannerSchedulesList.append(option).trigger('change');
                });
            });
        });
    </script>
@endsection
