@extends('layouts.backoffice')

@section('title', 'Alertas')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0">
                  <div class="custom-title-wrap bar-info">
                      <div class="custom-title">Lista de alertas</div>
                  </div>
                </div>
                <div class="card-body">
                    @include('admin.signals.table')                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    @parent
    {{-- Logica del scanner--}}
   <script> 
        $(document).ready(function(){

            console.log('starting...');
            
            {{-- luego ejecutamos la estrategia segun el periodo configurado--}}
            setInterval(updateSignals, 60000);

            /*Consulta de la estrategia*/
            function updateSignals()
            {
                location.reload();
            }
        });
    </script>
@endsection