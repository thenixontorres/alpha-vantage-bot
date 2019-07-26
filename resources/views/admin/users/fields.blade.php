<div class="form-group row mb-0">
	
	<div class="form-group col-md-12">
        {{Form::label('name','Nombre:')}}
        {{Form::text('name' ,null, ['class'=> 'form-control', 'required'])}}
    </div>

    <div class="form-group col-md-12">
        {{Form::label('email','Email:')}}
        {{Form::email('email' ,null, ['class'=> 'form-control', 'required'])}}
    </div>

    <div class="form-group col-md-12">
        {{Form::label('type','Tipo:')}}
        {{Form::select('type' ,['admin'=>'Admin','regular'=>'Regular'],null, ['class'=> 'form-control', 'required'])}}
    </div>

    <div class="form-group col-md-12">
        {{Form::label('status','Estatus:')}}
        {{Form::select('status' ,['active'=>'Activo','inactive'=>'Inactivo'],null, ['class'=> 'form-control', 'required'])}}
    </div>

    <div class="form-group col-md-12">
        {{Form::label('password','Clave:')}}
        {{Form::password('password', ['class'=> 'form-control'])}}
    </div>

</div>