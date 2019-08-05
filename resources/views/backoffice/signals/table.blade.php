<table class="table table-bordered table-sm" id="table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Activo</th>
            <th>Estrategia</th>
            <th>Resumen</th>
            <th>Tipo</th>
            <th>Estatus</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($signals as $signal)
       		<tr>
          <td>{{$signal->time_signal}}</td>
       		<td>{{$signal->scanner->merged_symbols}}</td>
       		<td>
       			@foreach($signal->scanner->strategies as $strategy)

                 <span class="badge badge-info">{{ $strategy->title }} </span>

              @endforeach
       		</td>
       		<td>
       			@foreach($signal->scanner->strategies as $strategy)
                @include('backoffice.strategies.'.$strategy->summary_fields, ['settings_array'=> $signal->scanner->settings_array])
            @endforeach
       		</td>
       		<td>
       			{!! $signal->just_type !!}
       		</td>
          <td>
            @if($signal->status == 'ignored')
            <span class="badge badge-secondary">IGNORADA</span>
            @elseif($signal->status == 'success')
            <span class="badge badge-success">CORRECTA</span>
            @else
            <span class="badge badge-danger">FALLIDA</span>
            @endif
          </td>
          <td>

            @if($signal->status == 'ignored')
              
            {!! Form::model($signal, ['route' => ['backoffice.signals.update', $signal], 'method' => 'patch']) !!}

              {!! Form::hidden('status', 'success') !!}
              
              <button class="btn btn-pill btn-success"><i class="fa fa-check"></i></button>

            {!! Form::close() !!}

            {!! Form::model($signal, ['route' => ['backoffice.signals.update', $signal], 'method' => 'patch']) !!}

              {!! Form::hidden('status', 'failed') !!}
              
              <button class="btn btn-pill btn-danger"><i class="fa fa-close"></i></button>
              
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