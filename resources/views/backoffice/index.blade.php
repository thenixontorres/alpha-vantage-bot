@extends('layouts.backoffice')
@section('title', 'Inicio')
@section('content')
<div class="container">

    <div class="row pb-4">
        
        <div class="col-xl-12 col-md-12">
            <div class="card card-shadow mb-4 pt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-sm-3">
                            <div class="media d-flex align-items-center  mb-4">
                                <div class="mr-4 rounded-circle bg-warning sr-icon-box bubble-shadow-small">
                                    <i class="fa fa-bar-chart"></i>
                                </div>
                                <div class="media-body">
                                    <h4 class="text-uppercase mb-0 weight500">{{$count_strategies}}</h4>
                                    <span class="text-muted">Estrategias</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="media d-flex align-items-center  mb-4">
                                <div class="mr-4 rounded-circle bg-purple sr-icon-box bubble-shadow-small">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="media-body">
                                    <h4 class="text-uppercase mb-0 weight500">{{$count_stock}}</h4>
                                    <span class="text-muted">Acciones</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="media d-flex align-items-center  mb-4">
                                <div class="mr-4 rounded-circle bg-danger sr-icon-box bubble-shadow-small">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="media-body">
                                    <h4 class="text-uppercase mb-0 weight500">{{$count_physical}}</h4>
                                    <span class="text-muted">Divisas</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3">
                            <div class="media d-flex align-items-center  mb-4">
                                <div class="mr-4 rounded-circle bg-purple-light sr-icon-box bubble-shadow-small">
                                    <i class="fa fa-bitcoin"></i>
                                </div>
                                <div class="media-body">
                                    <h4 class="text-uppercase mb-0 weight500">{{$count_digital}}</h4>
                                    <span class="text-muted">Criptomonedas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

