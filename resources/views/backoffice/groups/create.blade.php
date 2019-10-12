<div class="card">
    <div class="card-header border-0">
        <div class="custom-title-wrap bar-info">
            <div class="custom-title">Registrar grupo</div>
        </div>
    </div>
    <div class="card-body">
		{!! Form::open(['route'=>'backoffice.groups.store']) !!}

        		
			@include('backoffice.groups.fields')


			<div class="form-group row mb-0">
                <div class="col-md-12">
                      <center>  
                          <button type="submit" class="btn btn-pill btn-primary">
                              Registrar
                          </button>
                      </center>
              	</div>
            </div>

        {!! Form::close() !!}
    </div>
</div>