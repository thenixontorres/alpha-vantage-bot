@extends('layouts.backoffice')

@section('title', 'Nuevo usuario')

@section('content')
<div class="container">
    <div class="row justify-content-center pb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                  <div class="custom-title-wrap bar-info">
                      <div class="custom-title">Nuevo usuario</div>
                  </div>
                </div>
                <div class="card-body">
                  {!! Form::open(['route' => ['admin.users.store']]) !!}
                      
                    @include('admin.users.fields')
                    
                    <div class="form-group row mb-0">
                      <div class="col-md-12">
                          <center>  
                              <a class="btn btn-pill btn-danger" href="{{ route('admin.users.index') }}">Volver</a>
                              <button type="submit" class="btn btn-pill btn-primary">
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
