@extends('layouts.backoffice')

@section('title', 'Mis escaners')

@section('css')
@parent
<link href="{{asset('vendor/select2/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
	
	@if($type != 'all')
	<div class="row justify-content-center pb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="custom-title-wrap bar-info">
                        <div class="custom-title">Registrar escaner</div>
                    </div>
                </div>
                <div class="card-body">
					{!! Form::open(['route'=>'backoffice.scanners.store']) !!}

	                	@if($type == 'stock_market')
							
							@include('backoffice.scanners.stock_market_fields')

	                    @elseif($type == 'physical')
							
							@include('backoffice.scanners.physical_fields')
	                    
	                    @elseif($type == 'digital')
							
							@include('backoffice.scanners.digital_fields')

	                    @endif

	                    {{ Form::hidden('scanner_type', $type) }}

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
	@endif

    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card">
				<div class="card-header border-0">
                    <div class="custom-title-wrap bar-info">
                        <div class="custom-title">Lista de escaners</div>
                    </div>
                </div>                
                <div class="card-body">
                    @include('backoffice.scanners.table')            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@parent
<script src="{{ asset('vendor/select2/js/select2.min.js')}}"></script>
<script>
	$(document).ready(function() {
	    $('.select2').select2();
	});
</script>
@endsection

