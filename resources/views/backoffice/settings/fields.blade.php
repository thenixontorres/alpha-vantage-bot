    <div class="form-group row mb-0">

        <div class="form-group col-md-12">
          {{Form::label('status','Estatus general del escaner:')}}
            {{Form::select('status', ['on'=>'On','off'=>'Off'] ,null, ['class'=> 'form-control', 'required'])}}
          <small id="statusHelp" class="form-text text-muted">Con estatus Off todas las estrategias y peticiones se detendran.</small>
        </div>

        <div class="form-group col-md-12">
          {{Form::label('type_request','Tipo de periodo de peticiones:')}}
          {{Form::select('type_request', ['strategy'=>'Segun la estrategia','strict'=>'Tiempo estricto'] ,null, ['class'=> 'form-control', 'required'])}}
          <small id="statusHelp" class="form-text text-muted">Seleccionando "Segun la estrategia" el intervalo de escaneo dependera del configurado en la estrategia. Con "Tiempo estricto" debera especificar un perdiodo de tiempo general.</small>
        </div>
        
        <div class="form-group col-md-12">
            
            {{Form::label('strict_time_request','Frecuencia de actualziación:')}}
            
            {{Form::select('strict_time_request', $intervals , null , ['class'=> 'form-control', 'placeholder'=>'Seleccione un intervalo','required'])}}

            {{-- 
            {{Form::number('strict_time_request' ,null, ['class'=> 'form-control', 'required'])}}
            --}}
        </div>

        <div class="form-group col-md-12">
            {{Form::label('notifications_mail','Email de notificaciones:')}}
            {{Form::email('notifications_mail' ,null, ['class'=> 'form-control', 'required'])}}
            <small id="statusHelp" class="form-text text-muted"> Email que recibira las notificaciones luego de una alerta. </small> 
        </div>

        <div class="form-group col-md-12">
            {{Form::label('alpha_vantage_key','Llave de API (Alpha Vantage):')}}
            {{Form::text('alpha_vantage_key' ,null, ['class'=> 'form-control', 'required'])}} 
            <small id="statusHelp" class="form-text text-muted">Verifique que la llave sea valida. Si ella el escaner no podra funcionar.</small> 

        </div>
        
        <div class="form-group col-md-12">
            {{Form::label('test','Testear Llave:')}}
        
            <small id="statusHelp" class="form-text text-muted"><a href="https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=MSFT&interval=5min&apikey={{$setting->alpha_vantage_key}}" target="_blank">Probar {{ $setting->alpha_vantage_key}}</a></small> 

        </div>

    </div>