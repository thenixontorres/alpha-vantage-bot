@extends('layouts.backoffice')

@section('title', 'Configuraciones')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header border-0">
                        <div class="custom-title-wrap bar-info">
                            <div class="custom-title">Configuraciones</div>
                        </div>
                    </div>                <div class="card-body">
                  {!! Form::model($setting, ['route' => ['admin.settings.update', $setting], 'method' => 'patch']) !!}
                      
                    @include('admin.settings.fields')
                    
                    <div class="form-group row mb-0">
                      <div class="col-md-12">
                          <center>  
                              <a class="btn btn-pill btn-danger" href="{{ route('backoffice.index') }}">Volver</a>
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
