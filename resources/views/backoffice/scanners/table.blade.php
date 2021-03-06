<table class="table table-bordered table-sm" id="table">
    <thead>
        <tr>
            <th>Simbolo</th>
            {{-- <th>Símbolo</th> --}}
            <th>Estrategia</th>
            <th>Resumen</th>
            <th>Vincular</th>
            <th>Acciones</th>
            <th>Notificaciones</th>
            <th>Escanear</th>
        </tr>
    </thead>
    <tbody>
        @foreach($scanners as $scanner)
        <tr>
            {{-- <td>{{$scanner->asset->name}}</td> --}}
            <td>{{$scanner->merged_symbols}}</td>
            <td>
                @foreach($scanner->strategies as $strategy)

                    {!! Form::open(['route' => ['backoffice.scanners.detachStrategy'], 'id'=> 'd-'.$strategy->id.'-'.$scanner->id]) !!}
                        
                        {{Form::hidden('strategy_id', $strategy->id)}}
                        
                        {{Form::hidden('scanner_id', $scanner->id)}}
                    
                        <span class="badge badge-info">{{ $strategy->title }} <i class="fa fa-close" onclick="d('{{$strategy->id}}-{{$scanner->id}}');"></i></span>

                    {!! Form::close() !!}

                @endforeach
            </td>
            <td> 
                @if(!empty($scanner->group))
                <p><b>Grupo:</b> {{$scanner->group->name}}</p>
                @endif
                @foreach($scanner->strategies as $strategy)
                    @include('backoffice.strategies.'.$strategy->summary_fields, ['settings_array'=> $scanner->settings_array])
                @endforeach
            </td>
            <td> 
                <div class="dropdown">
                    <button class="btn btn-pill btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bar-chart"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($strategies as $strategy)
                            
                            {{Form::open(['route'=>'backoffice.scanners.attachStrategy', 'id'=>'a-'.$strategy->id.'-'.$scanner->id])}}

                                {{Form::hidden('strategy_id', $strategy->id)}}

                                {{Form::hidden('scanner_id', $scanner->id)}}
                            
                            {{Form::close()}}

                            <a class="dropdown-item" onclick="event.preventDefault();document.getElementById('a-{{$strategy->id}}-{{$scanner->id}}').submit();" href="#">{{$strategy->title}}</a>
                        @endforeach
                    </div>
                </div>
            </td>
            <td> 
                <div class="dropdown">
                    <button class="btn btn-pill btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-gear"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        
                        <a class="dropdown-item" href="{{ route('backoffice.scanners.edit', [$scanner]) }}">Configurar escaner</a>
                        
                        {!! Form::open(['route' => ['backoffice.scanners.destroy', $scanner], 'method' => 'delete', 'id'=> 'del-'.$scanner->id]) !!}
                            <a class="dropdown-item" href="#" onclick="del('{{$scanner->id}}');">Eliminar escaner</a>
                        {!! Form::close() !!}
                    </div>
                </div>
            </td>
            <td>
                @if(!empty($scanner->strategies->first()))
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::model($scanner, ['route' => ['backoffice.scanners.updateStatus', $scanner], 'method' => 'patch']) !!}

                                @if($scanner->status == 'on')
                                    {{ Form::hidden('status', 'off') }}
                                    <button class="btn btn-pill btn-success"><i class="fa fa-play"></i></button>
                                @else
                                    {{ Form::hidden('status', 'on') }}
                                    <button class="btn btn-pill btn-secondary"><i class="fa fa-play"></i></button>
                                @endif
                                
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::model($scanner, ['route' => ['backoffice.scanners.updateEmail', $scanner], 'method' => 'patch']) !!}

                                @if($scanner->email_notifications == 'on')
                                    {{ Form::hidden('email_notifications', 'off') }}
                                    <button class="btn btn-pill btn-success"><i class="fa fa-envelope-o"></i></button>
                                @else
                                    {{ Form::hidden('email_notifications', 'on') }}
                                    <button class="btn btn-pill btn-secondary"><i class="fa fa-envelope-o"></i></button>
                                @endif
                                
                            {!! Form::close() !!}
                        </div>
                    </div>
                @else
                    <button class="btn btn-pill btn-secondary"><i class="fa fa-play"></i></button>
                    <button class="btn btn-pill btn-secondary"><i class="fa fa-envelope-o"></i></button>
                    <button class="btn btn-pill btn-secondary"><i class="fa fa-telegram"></i></button>

                @endif
            </td>
            <td> 
                @if(!empty($scanner->strategies->first()))
                    <a href="{{route('backoffice.scanners.show', $scanner)}}" class="btn btn-pill btn-primary"><i class="fa fa-eye"></i></a>
                @else
                    <button class="btn btn-pill btn-secondary"><i class="fa fa-eye"></i></button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table> 

@section('js')
@parent

<script src="{{ asset('js/default_datatable.js')}}"></script>

<script type="text/javascript">
    function d(id, success = true)
    {
        if (success) {
            Swal.fire({
              title: 'Advertencia',
              text: "Confime que desea desvincular esta estrategia.",
              cancelButtonText: 'Cancelar',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, desvincular'
            }).then((result) => {
              if (result.value) {
                d(id, false);
              }
            });    
        }else{
            $('#d-'+id).submit();
        }
    }
    function del(id, success = true)
    {
        if (success) {
            Swal.fire({
              title: 'Advertencia',
              text: "Confime que desea borrar este escaner.",
              cancelButtonText: 'Cancelar',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, borrar'
            }).then((result) => {
              if (result.value) {
                del(id, false);
              }
            });    
        }else{
            $('#del-'+id).submit();
        }
    }
</script>
@endsection