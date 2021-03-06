@extends('layouts.backoffice')

@section('title', 'Editar '.$scanner->merged_symbols)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4> {{$scanner->merged_symbols}} </h4>
        </div>
        <div class="col-md-12 pb-4">

            <div class="card">
                <div class="card-header border-0">
                    <div class="custom-title-wrap bar-info">
                        <div class="custom-title">General</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            {!! Form::model($scanner, ['route' => ['admin.scanners.update', $scanner], 'method' => 'patch']) !!}
                                
                                <div class="form-group row mb-0">
                                
                                    @include('backoffice.strategies.GENERAL_setting_fields')
                                
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <center>  
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
        @foreach($scanner->strategies as $strategy)
            <div class="col-md-12 pb-4">

                <div class="card">
                    <div class="card-header border-0">
                        <div class="custom-title-wrap bar-info">
                            <div class="custom-title">   
                                Estrategia: 
                                <span class="badge badge-info"> {{$strategy->title}}</span> 
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
    	                  	<div class="col-md-12">

                                {!! Form::model($scanner, ['route' => ['admin.scanners.updateSettings', $scanner], 'method' => 'patch']) !!}
                                    
                                    <div class="form-group row mb-0">
                                    
                                        @include('backoffice.strategies.'.$strategy->setting_fields)
                                    
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <center>  
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
        @endforeach

        <div class="col-md-12 pt-4 pb-4">
            <a class="btn btn-pill btn-danger" href="{{ route('admin.scanners.index', $scanner->scanner_type) }}">Volver</a>
        </div>

    </div>
</div>
@endsection
