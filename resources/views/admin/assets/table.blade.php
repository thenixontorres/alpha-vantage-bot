<table class="table table-bordered table-sm" id="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Símbolo</th>
            <th>Estatus</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($assets as $asset)
        <tr>
            <td>{{$asset->name}}</td>
            <td>{{$asset->symbol}}</td>
            <td>
                @if($asset->status  == 'on')
                <span class="badge badge-success">
                Activo
                @else
                <span class="badge badge-warning">
                Inactivo
                @endif
                </span>
            </td>
            <td>
                <span class="badge badge-info">
                @if($asset->type  == 'digital')
                Digital
                @elseif($asset->type == 'physical')
                Fisica
                @else
                Acciones
                @endif
                </span>
            </td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-pill btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-gear"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @if($asset->status  == 'on')
                        {!! Form::open(['route' => 'admin.assets.changeStatus', 'id'=> 'des-'.$asset->id]) !!}
                        {{Form::hidden('id', $asset->id)}}
                        {{Form::hidden('status', 'off')}}
                        <a class="dropdown-item" href="#" onclick="des({{$asset->id}});">Desactivar</a>
                        {!! Form::close() !!}
                        @else
                        {!! Form::open(['route' => 'admin.assets.changeStatus', 'id'=> 'ac-'.$asset->id]) !!}
                        {{Form::hidden('id', $asset->id)}}
                        {{Form::hidden('status', 'on')}}
                        <a class="dropdown-item" href="#" onclick="ac({{$asset->id}});">Activar</a>
                        {!! Form::close() !!}              
                        @endif
                        {{-- 
                        @if($type == 'stock_market')

                            {!! Form::open(['route' => ['admin.assets.destroy', $asset], 'method' => 'delete', 'id'=> 'd-'.$asset->id]) !!}
                            <a class="dropdown-item" href="#" onclick="destroy({{$asset->id}});">Eliminar activo</a>
                            {!! Form::close() !!}
                            
                        @endif
                        --}}
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@section('js')
@parent

<script src="{{ asset('js/default_datatable.js')}}"></script>

@endsection