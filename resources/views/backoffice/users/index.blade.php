@extends('layouts.backoffice')

@section('title', 'Mis cuenta')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12 pb-4">
            <div class="card">
                <div class="card-header border-0">
                    <div class="custom-title-wrap bar-info">
                        <div class="custom-title">Mi cuenta</div>
                    </div>
                </div>
                <div class="card-body">
                  {!! Form::model(Auth::user(), ['route' => ['backoffice.users.update', Auth::user()], 'method' => 'patch']) !!}
                      
                    @include('backoffice.users.fields')
                    
                    <div class="form-group row mb-0">
                      <div class="col-md-12">
                          <center>  
                              <a class="btn btn-danger form-pill" href="{{ route('backoffice.index') }}">Volver</a>
                              <button type="submit" class="btn btn-primary form-pill">
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
