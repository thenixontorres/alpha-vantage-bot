@extends('layouts.backoffice')

@section('title', 'Estrategias')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Lista de estrategias </div>
                <div class="card-body">
                    @include('admin.strategies.table')                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
