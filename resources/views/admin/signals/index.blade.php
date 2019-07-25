@extends('layouts.backoffice')
@section('content')
<div class="container">
    <div class="row justify-content-center pt-5" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Lista de alertas </div>
                <div class="card-body">
                    @include('backoffice.signals.table')                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
