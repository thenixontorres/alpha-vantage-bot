<table class="table table-bordered table-sm" id="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Horarios</th>
            <th>Escaners</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach(Auth::user()->groups as $group)
        <tr>
            <td>{{ $group->name }}</td>
            <td>
            	@foreach($group->schedules as $schedule)
            		{{ $schedule->time  }}
            	@endforeach
            </td>
        	<td>
        		@foreach($group->scanners as $scanner)
            		{{ $scanner->merged_symbols  }}
            	@endforeach
            </td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-pill btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-gear"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        
                        <a class="dropdown-item" href="{{ route('backoffice.groups.edit', [$group]) }}">Editar grupo</a>
                        
                        {!! Form::open(['route' => ['backoffice.groups.destroy', $group], 'method' => 'delete', 'id'=> 'del-'.$group->id]) !!}
                            <a class="dropdown-item" href="#" onclick="del('{{$group->id}}');">Eliminar grupo</a>
                        {!! Form::close() !!}
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
<script>
	function del(id, success = true)
    {
        if (success) {
            Swal.fire({
              title: 'Advertencia',
              text: "Confime que desea borrar este grupo.",
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