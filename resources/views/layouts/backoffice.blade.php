<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-4/css/bootstrap.css') }}">
    
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}"/>
    
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">

    @yield('css')

</head>
<body>
    <div id="app">
        @include('backoffice.elements.navbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="{{ asset('vendor/jquery/jquery.js') }}" ></script>
    <script src="{{ asset('vendor/bootstrap-4/js/bootstrap.bundle.min.js')}}"></script>
    <!-- vendor -->
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- notificacione swal --}}
    @include('sweetalert::alert')

    {{--mensajes de error de laravel con swal --}}
    @if(isset($errors))
        @if(count($errors) > 0)
            @foreach ($errors->all() as $error)
                 <script>
                    Swal.fire({
                        title: '{{ $error }}',
                        type: 'error',
                        toast: true,
                        position: 'top-right',
                        showConfirmButton: false
                    });
                </script>

            @endforeach
        @endif
    @endif
    @yield('js')
</body>
</html>
