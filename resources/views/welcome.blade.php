<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>Admin - Ficoflora Venezuela</title>
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico')}}" />

    <link rel="stylesheet" href="{{ asset('css/landing.css')}}">

</head>
<body>
<div class="container">
    <div class="content">

        <div class="logo">
            {{--            <img src="{{ asset('img/ficoflora_logo.png')}}" height="35" alt="Porto Admin" />--}}

        </div>
        <div class="title">Ficoflora Venezuela</div>
        <hr/>
        <div class="quote">Módulo de Consultas</div>

        <div class="auth">

            @if($usuario == null)
            <a href="{{route('auth')}}">Ingresar</a>

                @else
                <a href="{{route('buscar.especies')}}">Ingresar</a>

            @endif
        </div>
    </div>
</div>
</body>
</html>