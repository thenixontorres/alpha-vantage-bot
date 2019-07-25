<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--favicon icon-->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <title>@yield('title')</title>

    <!--web fonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <!--bootstrap styles-->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!--icon font-->
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/dashlab-icon/dashlab-icon.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/themify-icons/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/weather-icons/css/weather-icons.min.css')}}" rel="stylesheet">

    <!--custom scrollbar-->
    <link href="{{asset('vendor/m-custom-scrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet">

    <!--jquery dropdown-->
    <link href="{{asset('vendor/jquery-dropdown-master/jquery.dropdown.css')}}" rel="stylesheet">

    <!--jquery ui-->
    <link href="{{asset('vendor/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">

    <link href="{{asset('vendor/data-tables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <!--custom styles-->
    <link href="{{asset('css/backoffice.css')}}" rel="stylesheet">

    <!-- swewt alert -->
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}"/>

    @yield('css')
</head>


<body class="fixed-nav top-nav">

    <!--header-->
    @include("backoffice.elements.header")
    
    @include("backoffice.elements.menu")  

    <!--main content wrapper-->
    <div class="content-wrapper">

        @yield('content')
        
    </div>
    <!--/main content wrapper-->

    <!--footer-->
    @include("backoffice.elements.footer")
    <!--/footer-->
    
    @yield('modals')
    
    <!--basic scripts-->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('vendor/popper.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('vendor/jquery-dropdown-master/jquery.dropdown.js')}}"></script>
    <script src="{{ asset('vendor/m-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
   
    <!--datatables-->
    <script src="{{ asset('vendor/data-tables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendor/data-tables/dataTables.bootstrap4.min.js')}}"></script>

    <!--basic scripts initialization-->
    <script src="{{ asset('js/backoffice.js')}}"></script>

    <!-- vendor -->
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
    
    {{-- notificacione swal --}}
    @include('sweetalert::alert')
    
    {{--mensajes de error de laravel con swal --}}
    @if(isset($errors))
        @if(count($errors) > 0)
            @foreach ($errors->all() as $error)
                 <script>
                    Swal.fire({
                      type: 'error',
                      title: '{{ $error }}',
                      toast: true,
                      position: 'top-right',
                      showConfirmButton: false  
                    });
                </script>
            @endforeach
        @endif
    @endif
    
    @yield('scripts')

</body>
</html>
