{{--@if($errors->any())--}}
    @if(Session::has('log'))
        <?php $errores = Session::get('log')?>

    <div class="col-xs-12 mt-xlg">
        <section class="panel">
            <header class="panel-heading p-xs">

                <h5 class="name" ><i class="fa fa-exclamation-circle pr-xs pl-sm"></i> Resultados de la importación de los datos</h5>



            </header>


            <div class="panel-body">


                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="mt-xs mb-xs">Número de errores encontrados: {{Session::get('total')}}</h4>
                    </div>
                    <div class="col-sm-4 ">
                        <a class=" btn btn-default pull-right text-dark"href="{{route('archivo.descargar.log')}}"><i class="fa fa-download text-primary pr-sm"></i> Descargar</a>

                    </div>
                </div>

                    <hr class="dotted short">


                <table id="datatable"  class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="th-dataTable ">Tipo</th>
                            <th class="th-dataTable ">Error</th>
                            <th class="th-dataTable ">Fila</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($errores as $error)
                        <tr>
                            <td ></td>
                            <td class="perfil">{{$error['tipo']}}</td>
                            <td class="perfil">{{$error['error']}}</td>
                            <td class="perfil">{{$error['fila']}}</td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>

            </div>

        </section>
    </div>

    @endif
{{--@endif--}}
