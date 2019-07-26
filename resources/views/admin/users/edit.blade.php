@extends('layouts.backoffice')

@section('title', 'Editar '.$user->name)

@section('content')
<div class="container">
    <div class="row justify-content-center pt-5" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> {{$user->name}} </div>
                <div class="card-body">
                  {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'patch']) !!}
                      
                    @include('admin.users.fields')
                    
                    <div class="form-group row mb-0">
                      <div class="col-md-12">
                          <center>  
                              <a class="btn btn-danger" href="{{ route('admin.users.index') }}">Volver</a>
                              <button type="submit" class="btn btn-primary">
                                  Actualizar
                              </button>
                          </center>
                      </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
