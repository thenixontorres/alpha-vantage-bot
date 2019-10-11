@extends('layouts.backoffice')

@section('content')
<div class="container">
    <div class="row justify-content-center pb-4" >
        <div class="col-md-12">
            <h4> Detalles de la alerta </h4>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <table class="table table-bordered table-sm" id="table">
                		<thead>
                            <th>Fecha y Hora</th>
                            <th>Activo</th>
                            <th>Configuraciones</th>
                            <th>Horarios</th>
                            <th>Consulta</th>
                            <th>Resultado</th>      
                        </thead>
                        <tbody>
                            <td>{{$signal->exec_time}}</td>
                            <td>{{$signal->scanner->merged_symbols}}</td>
                            <td>
                            	@foreach($signal->scanner->strategies as $strategy)
                            	<h5>{{$strategy->title}}:</h5>
                                @include('backoffice.strategies.'.$strategy->summary_fields, ['settings_array'=> $signal->scanner->settings_array])
                                @endforeach
                            </td>
                            
                            <td>
                                @foreach($signal->scanner->schedules as $schedule)
                                    {{$schedule->time}} - 
                                @endforeach
                            </td>
                            <td>
                            	@foreach($signal->scanner->strategies as $strategy)
                            		<h5>{{$strategy->title}}:</h5>
                                 	@include('backoffice.strategies.'.$strategy->results_fields, ['data_array'=>$signal->data_array])
                                @endforeach
                            </td>
                            <td>
                                {!!$signal->type!!}
                            </td>
                        </tbody>
                	</table>
                </div>
            </div>
        </div>

        <div class="col-md-12 pt-4">
            <a class="btn btn-danger" href="{{ route('admin.signals.logs', $signal->created_at->format('Y-m-d')) }}">Volver</a>
        </div>

    </div>
</div>
@endsection

@section('js')
@parent
<script src="{{ asset('js/default_datatable.js')}}"></script>
@endsection