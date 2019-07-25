@extends('layouts.backoffice')

@section('css')
@parent
<link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
	
	@if($type != 'all')
	<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Registrar escaner </div>
                <div class="card-body">
					{!! Form::open(['route'=>'backoffice.scanners.store']) !!}

	                	@if($type == 'stock_market')
							
							@include('backoffice.scanners.stock_market_fields')

	                    @elseif($type == 'physical')
							
							@include('backoffice.scanners.physical_fields')

	                    @endif

	                    {{ Form::hidden('scanner_type', $type) }}

						<div class="form-group row mb-0">
		                    <div class="col-md-12">
		                          <center>  
		                              <button type="submit" class="btn btn-primary">
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

    <div class="row justify-content-center pt-5" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Lista de escaners </div>
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
<script src="{{ asset('vendor/select2/select2.min.js')}}"></script>
<script>
	$(document).ready(function() {
	    $('.select2').select2();
	});
</script>
@endsection

