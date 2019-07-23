@extends('layouts.backoffice')
@section('content')
<div class="container">
    <div class="row justify-content-center pt-5" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Lista de indicadores </div>
                <div class="card-body">
                    @include('backoffice.indicators.table')                    
                </div>
                {{ $indicators->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    function des(id, success = true)
    {
        if (success) {
            Swal.fire({
              title: 'Advertencia',
              text: "Confime que desea desactivar este indicador.",
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
              text: "Confime que desea activar este indicador.",
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