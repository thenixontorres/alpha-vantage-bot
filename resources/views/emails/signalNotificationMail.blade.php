@extends('layouts.emails')

@section('content')
	<style>
		.table {
		    width: 100%;
		    margin-bottom: 1rem;
		    color: #212529;
		}
		.table-bordered {
		    border: 1px solid #dee2e6;
		}
		.th {
			border: 1px solid #dee2e6;
		}
		.td {
			border: 1px solid #dee2e6;
		}
	</style>

	<div style="font-size: 14px;">
		<h4>Nueva Alerta encontrada</h4>

		<table class="table table-bordered">
		    <thead>
		        <tr>
		            <th class="th">Fecha</th>
		            <th class="th">Activo</th>
		            <th class="th">Estrategia</th>
		            <th class="th">Resumen</th>
		            <th class="th">Tipo</th>
		        </tr>
		    </thead>
		    <tbody>
	       		<tr>
		          <td class="td">{{$signal->time_signal}}</td>
		       		<td class="td">{{$signal->scanner->merged_symbols}}</td>
		       		<td class="td">
		       			@foreach($signal->scanner->strategies as $strategy)

		                 	<span class="badge badge-info">{{ $strategy->title }} </span>

		              	@endforeach
		       		</td>
		       		<td class="td">
		       			@foreach($signal->scanner->strategies as $strategy)
		                	@include('backoffice.strategies.'.$strategy->summary_fields, ['settings_array'=> $signal->scanner->settings_array])
		            	@endforeach
		       		</td>
		       		<td class="td">
		       			{!! $signal->just_type !!}
		       		</td>
		        </tr>
		    </tbody>
		</table>
	</div>
@endsection