@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="container container-center">
        <div class="row">
            <div class="col-xl-12 d-lg-flex align-items-center">
                <!--login form-->
                <div class="login-form">
                    <center>    
                    <img class="pr-3 pb-4" src="{{ asset('img/turtle.png')}}" srcset="{{ asset('img/turtle.png')}}" style="height: 100px;"  alt=""/>
                    </center>

                    <h4 class="text-uppercase text-center mb-12" style="color: #2f3c4b;">Iniciar Sesion</h4>
                        {!! Form::open(['route'=>'auth.login']) !!}                        
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Ingrese su email" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Ingrese su clave" required>
                            </div>

                            <div class="form-group clearfix">
                                <button type="submit" class="btn btn-primary float-right">LOGIN</button>
                            </div>

                        

                         
                        {!! Form::close() !!}
                </div>
                <!--/login form-->

            </div>
        </div>
    </div>

@endsection
