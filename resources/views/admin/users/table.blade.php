<table class="table table-bordered table-sm" id="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Escaners</th>
            <th>Alertas</th>
            <th>Estatus</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
       		<tr>
	          	<td>{{$user->name}}</td>
	          	<td>{{$user->email}}</td>
	          	<td><span class="badge badge-info">{{$user->type}}</span></td>
            	<td>{{$user->scanners->count() }}</td>
            	<td>{{$user->count_signals }}</td>       		
		        <td>
		            @if($user->status == 'active')
		            <span class="badge badge-success">ACTIVO</span>
		            @else
		            <span class="badge badge-danger">INACTIVO</span>
		            @endif
		        </td>
		        <td>
		        	<div class="dropdown">
	                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                    <i class="fa fa-gear"></i>
	                    </button>
	                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	                        
	                        <a class="dropdown-item" href="{{ route('admin.users.edit', [$user]) }}">Editar</a>

	                        {!! Form::open(['route' => ['admin.users.destroy', $user], 'method' => 'delete', 'id'=> 'del-'.$user->id]) !!}
	                            <a class="dropdown-item" href="#" onclick="del('{{$user->id}}');">Eliminar</a>
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