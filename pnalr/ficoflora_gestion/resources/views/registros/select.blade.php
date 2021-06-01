@extends('master')

@section('css_section')
    @parent
    <link href="plugins/select2-4.0.0/css/select2.min.css" rel="stylesheet" />

@stop


@section('content')

 <h1>Vista de Select2</h1>

 {!! Form::open(['url' => 'registro',  'id'=>'jvalidate', 'class' => 'form']) !!}

         {{--Genero Form Imput--}}
         <div class="form-group">
             {!! Form::label('genero', 'Genero:') !!}
             {!! Form::select('genero', [null=>''], null, ['id' => 'sel_genero', 'class' => 'form-control']) !!}
         </div>


         {{--Especie Form Imput--}}
         <div class="form-group">
             {!! Form::label('especie', 'Epíteto Específico:') !!}
             {!! Form::text('especie', null, ['class' => 'form-control ', 'autocomplete' => 'off']) !!}
         </div>

         {{--Variedad Form Imput--}}
         <div class="form-group">
             {!! Form::label('variedad', 'Epíteto Varietal:') !!}
             {!! Form::text('variedad', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
         </div>

         {{--Forma Form Imput--}}
         <div class="form-group">
             {!! Form::label('forma', 'Epíteto Forma:') !!}
             {!! Form::text('forma', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
         </div>

 {{--Crear Articulo Form Imput--}}
 <div class="form-group">
     {!! Form::submit('Crear', ['class' => 'btn btn-primary form-control']) !!}
 </div>


 {!! Form::close() !!}

@stop

@section('script_section')
    @parent
    <script type="text/javascript">
        var data = <?php echo $generos; ?>;
        console.log(data);
    </script>
    <script src="plugins/select2-4.0.0/js/select2.min.js"></script>

    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/additional-methods.min.js')}}'></script>


    <script type="text/javascript">

        $('#sel_genero').select2({
            placeholder: "Select a repository",
            allowClear: true,


        }).on("select2:select", function (e) { console.log("select2:select",e);

            var args = JSON.stringify(e.params, function (key, value) {
                console.log("key ",key);
                console.log("value",value);
                if (value && value.nodeName) return ;
                if (value instanceof $.Event) return ;
                return value;
            });

            console.log("valor", e.params.data.text);

            console.log(args);
//            $("#especie").val("Amansia");
        });


        var jvalidate = $("#jvalidate").validate({
            rules: {

                genero: "required",
                especie: "required"

            },
            messages: {
                phylum: "Debe especifica un phylum",
                clase: "Debe especifica un clase",
                orden: "Debe especifica un orden",
                familia: "Debe especifica un familia",
                genero: "Debe especifica un genero",
                especie: "Debe especifica un especie",
                autor: "Debe especifica un autor"
            }
        });
    </script>
@stop


