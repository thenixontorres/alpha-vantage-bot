@extends('layouts.backoffice')
@section('css')
@parent
<link href="{{asset('vendor/select2/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('title', 'Grupos de Horarios')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-12 pb-4">
            @include('backoffice.groups.create')
        </div>

        <div class="col-md-12 pb-4">

            <div class="card">
                <div class="card-header border-0">
                    <div class="custom-title-wrap bar-info">
                        <div class="custom-title">Horarios</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
							
                            @include('backoffice.groups.table')
                        </div>
                    </div>
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
