<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Estatus</th>
            <th>Intervalo</th>
            <th>Periodo</th>
            <th>Serie</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($indicators as $indicator)
        <tr>
            <td>{{$indicator->function_name}}</td>
            <td>{{$indicator->description}}</td>
            <td>
                @if($indicator->status  == 'on')
                <span class="badge badge-success">
                Activo
                @else
                <span class="badge badge-warning">
                Inactivo
                @endif
                </span>
            </td>
            <td>
                @if(!empty($indicator->interval))
                    {{ $indicator->interval }}
                @else
                    ---
                @endif
            </td>
            <td>
                @if(!empty($indicator->time_period))
                    {{ $indicator->time_period }}
                @else
                    ---
                @endif
            </td>
            <td>
                @if(!empty($indicator->series_type))
                    {{ $indicator->series_type }}
                @else
                    ---
                @endif
            </td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-gear"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @if($indicator->status  == 'on')
                        {!! Form::open(['route' => 'backoffice.indicators.changeStatus', 'id'=> 'des-'.$indicator->id]) !!}
                        {{Form::hidden('id', $indicator->id)}}
                        {{Form::hidden('status', 'off')}}
                        <a class="dropdown-item" href="#" onclick="des({{$indicator->id}});">Desactivar</a>
                        {!! Form::close() !!}
                        @else
                        {!! Form::open(['route' => 'backoffice.indicators.changeStatus', 'id'=> 'ac-'.$indicator->id]) !!}
                        {{Form::hidden('id', $indicator->id)}}
                        {{Form::hidden('status', 'on')}}
                        <a class="dropdown-item" href="#" onclick="ac({{$indicator->id}});">Activar</a>
                        {!! Form::close() !!}              
                        @endif
                        
                        <a class="dropdown-item" href="{{ route('backoffice.indicators.edit', $indicator) }}">Configurar</a>

                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>