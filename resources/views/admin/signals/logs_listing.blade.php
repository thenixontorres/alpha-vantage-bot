<table class="table table-bordered table-sm" id="table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Activo</th>
            <th>Tipo</th>
            <th>Ejecución</th>
            <th>Ver</th>
            {{-- 
            <th>Valida</th>
            --}}
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $signal)
       		<tr>
	          	<td>{{$signal->exec_time}}</td>
	       		<td>{{$signal->scanner->merged_symbols}}</td>
	       		<td>
	       			{!! $signal->type !!}
	       		</td>
                <td>
                    @if($signal->exec_type == 'system')
                        AUTO
                    @else
                        MANUAL
                    @endif
                </td>
	       		<td><a class="btn btn-primary" href="{{route('admin.signals.show', $signal)}}"> <i class="fa fa-eye"></i></a></td>
	       		{{-- 
	       		<td>@if($signal->valid) SI @else NO @endif</td>
	       		--}}
          	</tr>
        @endforeach
    </tbody>
</table>

@section('js')
@parent
<script src="{{ asset('js/default_datatable.js')}}"></script>
@endsection