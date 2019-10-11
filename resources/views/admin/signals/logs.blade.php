@extends('layouts.backoffice')

@section('title', 'Logs')


@section('content')
<div class="container">
    <div class="row justify-content-center pt-5" >
        <div class="col-md-3">
            <div class="card">
                <div class="card-header"> 
                    <h4>Archivo</h4>
                </div>
                <div class="card-body">
                    @foreach($logs_tab as $date_tab => $tab)
                        <p>
                            @if($date_tab == $date) <i class="fa fa-arrow-right"></i>@endif
                            <a href="{{ route('admin.signals.logs', [$date_tab]) }}">{{$tab}}</a>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-primary" href="{{route('admin.signals.logs', [$date])}}">TODOS</a>
                    
                    <a class="btn btn-danger"  href="{{route('admin.signals.logs', [$date, 'ERROR'])}}"> ERROR</a>
                    
                    <a class="btn btn-secondary"  href="{{route('admin.signals.logs', [$date, 'NEUTRO'])}}"> NEUTRO</a> 

                    <a class="btn btn-success"  href="{{route('admin.signals.logs', [$date, 'BUY'])}}"> BUY</a> 

                    <a class="btn btn-danger"  href="{{route('admin.signals.logs', [$date, 'SELL'])}}"> SELL</a> 
                </div>

                <div class="col-md-12 pt-4">
                    <div class="card">
                        <div class="card-header"> 
                            scanner-{{$date}}.log 
                            <a class="btn btn-success float-right" href="{{route('admin.signals.logs', [$date, $type])}}"><i class="fa fa-refresh"></i> Actualizar</a> 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                @include('admin.signals.logs_listing')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
