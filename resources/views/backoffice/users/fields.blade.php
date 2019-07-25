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
        {{Form::label('password','Nueva clave:')}}
        {{Form::password('password', ['class'=> 'form-control'])}}
    </div>

    <div class="form-group col-md-12">
        {{Form::label('password_confirmation','Repita su nueva clave:')}}
        {{Form::password('password_confirmation', ['class'=> 'form-control'])}}
    </div>

</div>