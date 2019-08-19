    <div class="form-group row mb-0">

        <div class="form-group col-md-12">
          {{Form::label('status','Estatus general del escaner:')}}
            {{Form::select('status', ['on'=>'On','off'=>'Off'] ,null, ['class'=> 'form-control', 'required'])}}
          <small id="statusHelp" class="form-text text-muted">Con estatus Off todas las estrategias y peticiones se detendran.</small>
        </div>
        
        <div class="form-group col-md-12">
            {{Form::label('scanners_limit','Cantidad de scanners por usuario:')}}
            {{Form::number('scanners_limit' ,null, ['class'=> 'form-control', 'required'])}} 
        </div>

        <div class="form-group col-md-12">
            {{Form::label('notifications_mail','Email de notificaciones:')}}
            {{Form::email('notifications_mail' ,null, ['class'=> 'form-control', 'required'])}}
            <small id="statusHelp" class="form-text text-muted"> Email que recibira las notificaciones luego de una alerta. </small> 
        </div>

        <div class="form-group col-md-12">
            {{Form::label('alpha_vantage_api','URL de API:')}}
            {{Form::text('alpha_vantage_api' ,null, ['class'=> 'form-control', 'required'])}}
        </div>
        
    </div>