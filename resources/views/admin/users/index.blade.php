@extends('layouts.backoffice')

@section('title', 'Usuarios')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12 pb-4">
            <a href="{{route('admin.users.create')}}" class="btn btn-pill btn-primary float-right"><i class="fa fa-plus"></i></a>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                  <div class="custom-title-wrap bar-info">
                      <div class="custom-title">Lista de usuarios</div>
                  </div>
                </div>
                <div class="card-body">
                    @include('admin.users.table')                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
