@extends('layouts.backoffice')
@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12 pb-4">
            <a href="{{route('admin.users.create')}}" class="btn btn-primary float-right"><i class="fa fa-plus"></i></a>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Lista de usuarios </div>
                <div class="card-body">
                    @include('admin.users.table')                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
