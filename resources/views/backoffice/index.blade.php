@extends('layouts.backoffice')
@section('title', 'Inicio')
@section('content')
<div class="container">

    <div class="row justify-content-center pb-4">

        <div class="col-xl-4 col-md-4">
            <div class="card card-shadow mb-4">
                <div class="card-body">

                    <div class="text-center">
                        <strong>{{Auth::user()->scanners->count()}}</strong>
                        <span class="text-muted">Escaners</span>
                        <span class="pl-2 pr-2 text-muted weight800">.</span>
                        <strong>{{Auth::user()->count_signals}}</strong>
                        <span class="text-muted">Alertas</span>
                    </div>

                    <div class="text-center">
                        <div class="mt-4 mb-3">
                            <img class="rounded-circle" src="{{ asset('img/turtle.png')}}" width="85" alt=""/>
                        </div>
                        <h5 class="text-uppercase mb-0">{{Auth::user()->name}}</h5>
                        <p class="text-muted mb-0">{{Auth::user()->email}}</p>
                        <div class="rattings mb-4">
                            <i class="fa fa-star text-warning"></i>
                        	@if(Auth::user()->type == 'admin')
                            <i class="fa fa-star text-warning"></i>
                            @endif
                        </div>
                        <div class="mb-2">
                            <a href="{{ route('backoffice.scanners.index') }}" class="btn btn-sm btn-pill btn-primary  pl-4 pr-4">Mis escaners</a>
                            <a href="{{ route('backoffice.signals.index') }}" class="btn btn-sm btn-pill btn-primary pl-4 pr-4">Mis alertas</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
		<div class="col-xl-8 col-md-8">
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

