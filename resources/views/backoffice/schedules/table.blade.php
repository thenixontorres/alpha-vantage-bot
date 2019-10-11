<table class="table table-bordered table-sm" id="table">
    <thead>
        <tr>
            <th>Hora de actualiacion</th>
            <th>Cantidad de peticiones ocupadas</th>
            <th>Disponibles</th>
        </tr>
    </thead>
    <tbody>
        @foreach($schadules_used as $used)
        <tr>
            <td>{{ $used['time'] }}</td>
            <td>{{ $used['ocuped']  }}</td>
        	<td>{{ $used['free']  }}</td>
        </tr>
        @endforeach
    </tbody>
</table> 

@section('js')
@parent
<script src="{{ asset('js/default_datatable.js')}}"></script>
@endsection