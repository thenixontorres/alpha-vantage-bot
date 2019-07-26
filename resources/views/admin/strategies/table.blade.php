<table class="table table-bordered table-sm" id="table">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Titulo</th>
            <th>Estatus</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($strategies as $strategy)
       		<tr>
          		<td>{{$strategy->code}}</td>
          		<td>{{$strategy->title}}</td>
       		
		        <td>
		            @if($strategy->status == 'on')
		            	<span class="badge badge-success">Activa</span>
					@else	
						<span class="badge badge-warning">Inactiva</span>
		            @endif
		        </td>
				<td>
		            @if($strategy->status == 'off')
		              
			            {!! Form::model($strategy, ['route' => ['admin.strategies.update', $strategy], 'method' => 'patch']) !!}

			              {!! Form::hidden('status', 'on') !!}
			              
			              <button class="btn btn-primary"><i class="fa fa-check"></i></button>

			            {!! Form::close() !!}
					
					@else

			            {!! Form::model($strategy, ['route' => ['admin.strategies.update', $strategy], 'method' => 'patch']) !!}

			              {!! Form::hidden('status', 'off') !!}
			              
			              <button class="btn btn-danger"><i class="fa fa-close"></i></button>
			              
			            {!! Form::close() !!}

		            @endif
         		</td>
          </tr>
        @endforeach
    </tbody>
</table>

@section('js')
@parent
<script src="{{ asset('js/default_datatable.js')}}"></script>
@endsection