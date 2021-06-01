@extends('master')

@section('css_section')
    @parent


@stop

@section('titulo-seccion')
    Registro de nueva Referencia
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Nuevo</span></a></li>
    <li><a href="#"><span>Bibliográfico</span></a></li>
    <li><a href="#"><span>Referencia</span></a></li>
@stop


@section('content')

    @include('errors._listar')


    <!-- vertical -->
    <div class="row">
        <div class="col-md-12">
            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_revista" data-toggle="tab">Revista</a>
                    </li>
                    <li>
                        <a href="#tab_trabajo" data-toggle="tab">Trabajo Académico</a>
                    </li>
                    <li>
                        <a href="#tab_libro" data-toggle="tab">Libro</a>
                    </li>
                    <li>
                        <a href="#tab_catalogo" data-toggle="tab">Catálogo</a>
                    </li>
                    <li>
                        <a href="#tab_enlace" data-toggle="tab">Enlace Web</a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div id="tab_revista" class="tab-pane active">
                        @include('bibliograficos.referencias._parciales._revista-formulario')
                    </div>

                    <div id="tab_trabajo" class="tab-pane">
                        @include('bibliograficos.referencias._parciales._trabajos-form')
                    </div>

                    <div id="tab_libro"  class="tab-pane">
                        @include('bibliograficos.referencias._parciales._libro-formulario')
                    </div>

                    <div id="tab_catalogo"  class="tab-pane">
                        @include('bibliograficos.referencias._parciales._catalogo-formulario')
                    </div>

                    <div id="tab_enlace" class="tab-pane">
                        @include('bibliograficos.referencias._parciales._enlace-form')
                    </div>

                    <div class="dp-none" id="clean"></div>

                </div>
            </div>

        </div>
    </div>

@stop


@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins/tinymce/tinymce.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/wizard/jquery.bootstrap.wizard.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/wizard/examples.wizard.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/bibliograficos/crear_referencias.js')}}'></script>


    <script type="text/javascript">

        $('html').addClass('fixed sidebar-left-collapsed');

            $(document).ready(function() {

                var $select = $(".select").select2({
                    placeholder: "Seleccione una opción",
                    allowClear: true
                });

                $(".cita").select2({
                    placeholder: "Seleccione la cantidad de autores",
                    allowClear: true
                });

                $(function () {
                    $('#ref_libro [data-toggle="popover"]').popover({
                        trigger: 'focus'
                    })
                })


                    //pasa los textos de los select a resultado
                $(".select").change(function(){

                    //Obtengo el texto del select que se selecciono
                    var seleccion = $('option:selected', this).text();


                    //obtengo el id del elemento seleccionado, se transforma en clase, la cual sera la que tenga el span de resultado
                    // ejem select id= fecha_libro, span class = fecha_libro
                    var class_span = '.'+this.id;

                    if($(this).val()){
                        $(class_span).parents(".wrap").show();
                    }else{
                        $(class_span).parents(".wrap").hide();
                    }

                    $(class_span).html(seleccion);
                });


                $(".cita").change(function(){

                    //Obtengo el value del select de la cita
                    var value = $('option:selected', this).val();
                    var tipo = this.id.split('_')[1];
                    var id_autores = '#autores_'+tipo;
                    var class_span = '.cita_'+tipo;
                    var cita;
                    
                    var autores = $(id_autores).val();

                    if($(id_autores).val()){

                        $(class_span).parents(".wrap").show();

                        switch(value){
                            case '1':
                                cita = autores.split(',')[0];
                                break;
                            
                            case '2':
                                cita = autores.split(',')[0]+' & '+ autores.split(' ').pop();
                                break;
                            
                            case '3':
                                cita = autores.split(',')[0]+' <em>et al.</em>'
                                break;

                        }
                    }else{
                        $(class_span).parents(".wrap").hide();
                    }

                    $(class_span).html(cita);
                });



                $(".preview").on('keyup', function(){
                    var class_span = '.'+this.id;

                    var contenido = $(this).val();
//                    console.log(contenido);

                    if($(this).val()){
                        $(class_span).parents(".wrap").show();
                    }else{
                        $(class_span).parents(".wrap").hide();
                    }

                    $(class_span).html(contenido);
                });





                tinymce.init({
                    selector: ".tinymce",
                    min_height: 60,
                    fontsize_formats: "18pt 24pt 36pt",
                    menubar : false,
                    language : 'es',
                    plugins: "charmap paste code",
                    valid_elements: "p,b,i,strong,em,span[style]",
                    paste_word_valid_elements: "p,b,i,strong,em,span",
                    forced_root_block: '',

                    toolbar: [
                        "undo redo | copy paste | bold italic underline | charmap  code"
                    ],
                    setup: function(editor) {

                        editor.on('keyup change', function(e) {
//                            console.log( tinyMCE.activeEditor.getContent({format : 'html'}));
//                            console.log( tinyMCE.activeEditor.getContent());

                            //obtengo el contenido del texarea tinymce
                            var p = tinyMCE.activeEditor.getContent();

                            //tranformo el id en la clase que tiene el span de resultado
                            var class_span = '.'+this.id;

                            if( p != ''){
                                $(class_span).parents(".wrap").show();
                            }else{
                                $(class_span).parents(".wrap").hide();
                            }
                            //adjunto el contenido del textarea a el span de resultado
                            $(class_span).html(p);

                        });

                        editor.on('init', function()
                        {
                            this.getDoc().body.style.fontSize = '14px';
                        });
                    }

                });



            });

    </script>

    <script>
        localStorage.setItem("menu", "m-registros");
    </script>

@stop