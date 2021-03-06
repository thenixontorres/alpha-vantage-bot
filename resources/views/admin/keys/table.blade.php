<table class="table table-bordered table-sm" id="table">
    <thead>
        <tr>
            <th>Llave</th>
            <th>Correo</th>
            <th>Nombre</th>
            <th>Estatus</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($keys as $key)
	       	<tr>
		        <td>{{$key->key}}</td>
		        <td>{{$key->email}}</td>
	       		<td>{{$key->name}}</td>
	          	<td>
		            @if($key->is_active)
		            	<span class="badge badge-success">EN USO</span>
		            @else
		            	<span class="badge badge-warning">APAGADA</span>
		            @endif
		        </td>

	            <td>                              

                @if(!$key->is_active)

					         <div class="dropdown">
	                    <button class="btn btn-pill btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                    <i class="fa fa-gear"></i>
	                    </button>
	                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              {!! Form::model($key, ['route' => ['admin.keys.update', $key], 'method' => 'patch', 'id'=> 'u-'.$key->id]) !!}
                                <a class="dropdown-item" href="#" onclick="update({{$key->id}});">Activar llave</a>
                            
                              {!! Form::close() !!}

                              {!! Form::open(['route' => ['admin.keys.destroy', $key], 'method' => 'delete', 'id'=> 'd-'.$key->id]) !!}
                              <a class="dropdown-item" href="#" onclick="destroy({{$key->id}});">Eliminar llave</a>
                            {!! Form::close() !!}
                           
	                    </div>
	                 </div>
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
    function destroy(id, success = true)
    {
        if (success) {
            Swal.fire({
              title: 'Advertencia',
              text: "Confime que desea borrar esta llave.",
              cancelButtonText: 'Cancelar',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, borrar'
            }).then((result) => {
              if (result.value) {
                destroy(id, false);
              }
            });    
        }else{
            $('#d-'+id).submit();
        }
    }

    function update(id, success = true)
    {
        if (success) {
            Swal.fire({
              title: 'Advertencia',
              text: "Confime que desea activar esta llave.",
              cancelButtonText: 'Cancelar',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, activar'
            }).then((result) => {
              if (result.value) {
                update(id, false);
              }
            });    
        }else{
            $('#u-'+id).submit();
        }
    }
</script>
@endsection