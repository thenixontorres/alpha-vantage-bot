@extends('layouts.backoffice')
@section('css')
@parent
<link href="{{asset('vendor/select2/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Horarios '.$scanner->merged_symbols)

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-12 pb-4">

            <div class="card">
                <div class="card-header border-0">
                    <div class="custom-title-wrap bar-info">
            			<h4> Horarios ocupados </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
            				@include('backoffice.schedules.table')
                        </div>
                    </div>
                </div>
            </div>

        </div>


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
							{{Form::open(['route'=>'backoffice.schedules.store'])}}
								@include('backoffice.schedules.fields')
				                <div class="form-group col-md-12">
				                    <a href="{{ route('backoffice.scanners.index', $scanner->scanner_type) }}" class="btn btn-danger btn-pill">Volver</a>
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
        var url = "{!! route('backoffice.schedules.getScannerSchedules', [$scanner]) !!}";
        var scannerSchedulesList = $("#scanner_schedules_list");

            $.ajax({
                type: 'GET',
                dataType: "json",   
                url:url
            }).then(function (response) {

                scannerSchedulesList.empty().trigger('change');

                $.each(response, function( index, schedule ) {

                    var option = new Option(schedule.time, schedule.time, true, schedule.selected);

                    scannerSchedulesList.append(option).trigger('change');
                });
            });
        });
    </script>
@endsection
