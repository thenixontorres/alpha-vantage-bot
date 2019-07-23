<div class="form-group row mb-0">

    <div class="form-group col-md-12">
      	
      	{{Form::label('asset_id','De:')}}
        
        {{Form::select('asset_id', $assets, null, ['class'=> 'form-control select2', 'placeholder'=>'Seleccione un activo', 'required'])}}
    </div>

     <div class="form-group col-md-12">
      	
      	{{Form::label('asset_to_id','Contra:')}}
        
        {{Form::select('asset_to_id', $assets, null, ['class'=> 'form-control select2', 'placeholder'=>'Seleccione un activo', 'required'])}}
    </div>

    <div class="form-group col-md-12">
      	
      	{{Form::label('strategy_id','Estrategias:')}}
        
        {{Form::select('strategy_id[]', $strategies->pluck('title', 'id'), null, ['class'=> 'form-control select2', 'required', 'multiple'=>'multiple'])}}
    </div>

</div>