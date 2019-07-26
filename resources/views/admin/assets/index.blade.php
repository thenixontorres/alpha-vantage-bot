@extends('layouts.backoffice')

@section('title', 'Activos')

@section('content')
<div class="container">
    
    @if($type == 'stock_market')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Registrar activo </div>
                <div class="card-body">
                    {!! Form::open(['route'=>'admin.assets.store', 'class'=>'form-inline']) !!}
                    <div class="form-group col-md-10">
                        {{Form::text('keywords', null, ['class'=> 'form-control typeahead', 'placeholder'=>'Nombre del activo', 'style'=>'width:100%;', 'id'=>'keywords', 'required', 'autocomplete'=>'off'])}}
                        {{Form::hidden('type', 'stock_market')}}
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-plus"></i></button>
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
                <div class="card-header"> Lista de activos </div>
                <div class="card-body">
                    @include('admin.assets.table')                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('vendor/typehead/bootstrap3-typeahead.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
    
      var path = "{{ route('admin.alphaVantage.autocomplete') }}";
    
      $('#keywords').typeahead({
          source:  function (query, process) {
          return $.get(path, { keywords: query }, function (data) {
                  return process(data);
              });
          }
      });
    });
</script>
<script type="text/javascript">
    function destroy(id, success = true)
    {
        if (success) {
            Swal.fire({
              title: 'Advertencia',
              text: "Confime que desea borrar este activo.",
              cancelButtonText: 'Cancelar',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, borrrar'
            }).then((result) => {
              if (result.value) {
                destroy(id, false);
              }
            });    
        }else{
            $('#d-'+id).submit();
        }
    }
    
    function des(id, success = true)
    {
        if (success) {
            Swal.fire({
              title: 'Advertencia',
              text: "Confime que desea desactivar este activo.",
              cancelButtonText: 'Cancelar',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, desactivar'
            }).then((result) => {
              if (result.value) {
                des(id, false);
              }
            });    
        }else{
            $('#des-'+id).submit();
        }
    }
    
    function ac(id, success = true)
    {
        if (success) {
            Swal.fire({
              title: 'Advertencia',
              text: "Confime que desea activar este activo.",
              cancelButtonText: 'Cancelar',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, activar'
            }).then((result) => {
              if (result.value) {
                ac(id, false);
              }
            });    
        }else{
            $('#ac-'+id).submit();
        }
    }
    
</script>
@endsection