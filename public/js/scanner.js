$(document).ready(function(){

            {{---countruimos el header de la table de notificaciones--}}
            buildHead();
           
            /*Intervalo configurado en milisegundos*/
            var miliseconds = '{{$scanner->interval_ms}}';

            /*Funcion que consulta la estrategia repetidamente segun el intervalo configurado*/
            setInterval(applyStrategy, miliseconds);

            /*Consulta de la estrategia*/
            function applyStrategy(route)
            {
                var route = '{{route('backoffice.scanners.apply', $scanner)}}';
                console.log('getting...');
                $.get(route).then(setSignals);
            }

            /*Respuesta tras consultar la estaregia*/
            function setSignals(data)
            {
                console.log('setting...');

                /*table que se llenara con las senales*/
                var table = $('#alerts_table');
                
                /*Si se encontro una senal disparamos una notificacion*/
                if(!data.data_signal.alert)
                {
                    console.log('alert!...');
                    /*Codigo de la estrategia que se esta aplicando*/
                    var strategy = '{{$scanner->strategy->code}}';

                    /* El cuerpo de la tabla varia segun la estrategia */
                    switch (strategy) {
                        case 'MA_SINGLE':
                            var new_tr = `<tr><td>${data.data_signal.symbol}</td><td>${data.data_signal.type}</td><td>${data.data_signal.price}</td><td>${data.data_signal.ma}</td><td>${data.data_signal.time}</td></tr>`; 
                        break;
                        case 'MA_DOUBLE':
                            var new_tr = `<tr><td>${data.data_signal.symbol}</td><td>${data.data_signal.type}</td><td>${data.data_signal.slow_ma}</td><td>${data.data_signal.fast_ma}</td><td>${data.data_signal.price}</td><td>${data.data_signal.time}</td></tr>`; 
                        break;
                        default:
                            var new_tr = `<tr><td>${data.data_signal.symbol}</td><td>${data.data_signal.type}</td><td>${data.data_signal.k}</td><td>${data.data_signal.d}</td><td>${data.data_signal.price}</td><td>${data.data_signal.time}</td></tr>`; 
                        break;
                    }

                    /* Escribimos la alerta en la tabla */
                    $(table).find('tbody').append(new_tr);
                    
                    /*notificacion push*/
                    Push.create("{{$scanner->strategy->title}}", { //Titulo de la notificación
                        body: `${data.data_signal.symbol} - ${data.data_signal.type}`, //Texto del cuerpo de la notificación
                        timeout: 6000, //Tiempo de duración de la notificación
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

            /*construye el head de la tabla*/
            function buildHead()
            {    
                var strategy = '{{$scanner->strategy->code}}';

                var table = $('#alerts_table');

                /* El header de la tabla varia segun la estrategia */
                switch (strategy) {
                    case 'MA_SINGLE':
                        var head = `<tr><th>ACTIVO</th><th>TIPO</th><th>PRECIO</th><th>MA</th><th>FECHA</th></tr>`; 
                    break;
                    case 'MA_DOUBLE':
                        var head = `<tr><th>ACTIVO</th><th>TIPO</th><th>MA LENTA</th><th>MA RAPIDA</th><th>PRECIO</th><th>FECHA</th></tr>`; 
                    break;
                    default:
                        var head = `<tr><th>ACTIVO</th><th>TIPO</th><th>K</th><th>D</th><th>PRECIO</th><th>FECHA</th></tr>`; 
                    break;
                }

                $(table).find('thead').append(head);

            }
        });