@extends('layouts.backoffice')

@section('title', $scanner->merged_symbols)

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">
            <h4> {{$scanner->merged_symbols}} :
            
                @foreach($scanner->strategies as $strategy)
                    
                    <span class="badge badge-info">   {{$strategy->title}}</span> 
                        
                @endforeach

            </h4>
        </div>

        <div class="col-md-12 pt-5">
            <div class="card">
                <div class="card-header"> Escaneando... </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($scanner->strategies as $strategy)
    	                    <div class="col-md-{{$scanner->count_cols}} pt-5">
                                @include('admin.scanners.alerts_table')
    						</div>
                        @endforeach
	                    <div class="col-md-12">
	                        <center>  
                                <a class="btn btn-pill btn-danger" href="{{ route('admin.scanners.index', $scanner->scanner_type) }}">Volver</a>
	                        </center>
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
    {{-- PUSH JS --}}
    <script src="{{ asset('js/push.min.js')}}"></script> 

    {{-- Logica del scanner--}}
   <script> 

        $(document).ready(function(){

            console.log('starting...');
            
            {{---countruimos los headers de las tablas de notificaciones--}}
            buildHead();
            
            {{-- ejecutamos la estrategia durante la primera carga --}}
            applyStrategy();
            
            {{-- si el periodo es segun la estrategia tomamos el tiempo del escanner--}}
            var miliseconds = '{{$scanner->interval_ms}}';
          
            {{-- luego ejecutamos la estrategia segun el periodo configurado--}}
            setInterval(applyStrategy, miliseconds);

            /*Consulta de la estrategia*/
            function applyStrategy()
            {
                console.log('getting...');
                var route = '{{route('admin.scanners.apply', $scanner)}}';
                $.get(route).then(setSignals);
            }

            /*Respuesta tras consultar la estaregia*/
            function setSignals(data)
            {
                console.log('setting...');

                /*Si se ejecuto la estrategia correctamente continuamos*/
                if(data.success)
                {
                    console.log('success');
                    /*construir e body de cada tabla*/
                    $.each(data.data_signal, function( code, signal ) 
                    {
                        buildBody(code, signal);
                    });

                    /*si se dieron las condiciones para la senal, notificamos */
                    if(data.general_alert)
                    {
                        console.log('signal found!');
                        var symbol = '{{$scanner->merged_symbols}}';
                        /*notificacion push*/
                        Push.create("Señal en el activo "+symbol, { 
                            body: 'Se ha encontrado una señal en el activo '+ symbol, 
                            timeout: 6000, 
                        });

                        /*disparamos un alert*/    
                        Swal.fire({
                            title: 'Nueva señal encontrada!',
                            type: 'info',
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false
                        });
                    }
                }   
            }

            /*construye el head de las tablas*/
            function buildHead()
            {    
                @foreach($scanner->strategies as $strategy)

                    var strategy_table = '{{ $strategy->notification_table}}';

                    var table = $('#'+strategy_table);

                    var head = '<tr>';

                    @foreach($strategy->notification_fields_array as $label => $value)

                        head = head+'<th>{{$label}}</th>';

                    @endforeach
                    
                    head = head+'</tr>';

                    $(table).find('thead').prepend(head);

                @endforeach
            }

            /*construye el body de una tabla*/
            function buildBody(code, signal){
                /*table que se llenara con las senales*/
                var table = $('#'+code+'_table');

                /*construimos el nuevo tr*/
                switch (code) {
                        
                    case 'MA_SINGLE':
                        var new_tr = `<tr><td>${signal.symbol}</td><td>${signal.type_html}</td><td>${signal.prev_ma} -> ${signal.ma}</td><td>${signal.prev_price} -> ${signal.price}</td><td>${signal.time}</td></tr>`; 
                    break;
                    case 'MA_DOUBLE':
                        var new_tr = `<tr><td>${signal.symbol}</td><td>${signal.type_html}</td><td>${signal.prev_slow_ma} -> ${signal.slow_ma}</td><td>${signal.prev_fast_ma} -> ${signal.fast_ma}</td><td>${signal.price}</td><td>${signal.time}</td></tr>`; 
                    break;
                    case 'BBANDS':
                        var new_tr = `<tr><td>${signal.symbol}</td><td>${signal.type_html}</td><td>${signal.upper}</td><td>${signal.middle}</td><td>${signal.lower}</td><td>${signal.price}</td><td>${signal.time}</td></tr>`; 
                    break;
                    case 'RSI':
                        var new_tr = `<tr><td>${signal.symbol}</td><td>${signal.type_html}</td><td>${signal.prev_rsi} -> ${signal.rsi}</td><td>${signal.price}</td><td>${signal.time}</td></tr>`; 
                    break;
                    default:
                        var new_tr = `<tr><td>${signal.symbol}</td><td>${signal.type_html}</td><td>${signal.prev_k} -> ${signal.k}</td><td>${signal.prev_d} -> ${signal.d}</td><td>${signal.price}</td><td>${signal.time}</td></tr>`; 
                    break;
                }

                /*si ya tiene 5 registros borramos el ultimo */
                var count_rows = $('#'+code+'_table >tbody >tr').length;
                    
                if(count_rows > 5)
                {
                    console.log('removing...');
                    $('#'+code+'_table >tbody >tr:last').remove();
                }

                /* Escribimos la alerta en la tabla */ 
                console.log('adding...'); 

                $(table).find('tbody').prepend(new_tr);

            }

        });
    </script>
@endsection
