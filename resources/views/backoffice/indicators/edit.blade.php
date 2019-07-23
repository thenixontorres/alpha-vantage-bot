@extends('layouts.backoffice')
@section('content')
<div class="container">
    <div class="row justify-content-center pt-5" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Configurar indicador <strong>{{ $indicator->function_name }}</strong> </div>
                <div class="card-body">

                  {!! Form::model($indicator, ['route' => ['backoffice.indicators.update', $indicator], 'method' => 'patch']) !!}

                    	@include('backoffice.indicators.fields')     
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <center>  
                                    <a class="btn btn-danger" href="{{ route('backoffice.indicators.index') }}">Volver</a>
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
