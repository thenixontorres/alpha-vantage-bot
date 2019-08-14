@extends('layouts.backoffice')

@section('title', 'Llaves')

@section('content')
<div class="container">
    <div class="row justify-content-center pb-4">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header border-0">
                    <div class="custom-title-wrap bar-info">
                        <div class="custom-title">Registrar llave</div>
                    </div>
                  </div>
                  <div class="card-body">
                      {!! Form::open(['route'=>'admin.keys.store']) !!}
                        
                        <div class="form-group row mb-0">
    
                          @include('admin.keys.fields')
                        </div>

                        <div class="form-group row mb-0">
                          <div class="col-md-12">
                              <center>  
                                  <button type="submit" class="btn btn-pill btn-primary">
                                      Registrar
                                  </button>
                              </center>
                          </div>
                        </div>

                      {!! Form::close() !!}
                  </div>
              </div>
          </div>
    </div>

    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                  <div class="custom-title-wrap bar-info">
                      <div class="custom-title">Lista de Llaves</div>
                  </div>
                </div>
                <div class="card-body">
                    @include('admin.keys.table')                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
