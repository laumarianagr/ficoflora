<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Iniciar Sesión</title>
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">

</head>
<body>
<div class="container-fluid">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel-text">

                <h1>Ficoflora Venezuela</h1>
                <hr/>

            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">

            <div class="panel-box">

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label class="col-md-4 control-label">correo</label>
                        <div class="col-md-5">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">clave</label>
                        <div class="col-md-5">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group mt-md">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Recordar
                                </label>
                            </div>
                            {{--<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>--}}
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>