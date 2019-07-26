@extends('layouts.backoffice')

@section('title', 'Mis cuenta')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                  {!! Form::model(Auth::user(), ['route' => ['backoffice.users.update', Auth::user()], 'method' => 'patch']) !!}
                      
                    @include('backoffice.users.fields')
                    
                    <div class="form-group row mb-0">
                      <div class="col-md-12">
                          <center>  
                              <a class="btn btn-danger" href="{{ route('backoffice.index') }}">Volver</a>
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
