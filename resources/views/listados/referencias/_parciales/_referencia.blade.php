
<!-- se construye la referencia bibliográfica según formato de Revista -->
@if (  $tipo == "Artículo en Revista" )

    <h4>{!!html_entity_decode(trim($referencia->autores))!!}, {{$referencia->fecha}}{{$referencia->letra}}</h4>

    {!!html_entity_decode(trim($referencia->titulo))!!}.
    <b><em>{{trim($referencia->nombre)}}.</em>
        @if($referencia->volumen != null)
            {{$referencia->volumen}}@endif
        @if($referencia->numero != null)
            ({{$referencia->numero}})@endif
        @if( ($referencia->intervalo != null) && ( ($referencia->volumen != null) || ($referencia->numero != null)) )
            :{{$referencia->intervalo}}.@endif
    </b>
    @if($referencia->isbn != null){{$referencia->isbn}}. @endif

    @if($referencia->archivo != null)
        <!-- aquí código que muestra el enlace al pdf o aviso para solicitud del archivo -->

        <a href='#' title='Estimado visitante, disponemos de este artículo original en formato pdf, si requiere una copia del mismo, solicítelo al correo electrónico santiago.gomez@ciens.ucv.ve o yusneyicarballo@gmail.com. Gracias.'>
            <img src='{{asset("../public/img_publicas/icon_pdf.gif")}}' style='margin-top:10px; vertical-align: baseline'/>
            <b>ver pdf</b></a>
    @endif

    @if($referencia->comentarios != null) <br /><span class='mutted'>{{$referencia->comentarios}}</span>@endif


<!-- se construye la referencia bibliográfica según formato de Libro -->
@elseif( $tipo == "Libro" )
    <h4>{{$referencia->autores}}, {{$referencia->fecha}}{{$referencia->letra}}</h4>

    {!!html_entity_decode(trim($referencia->titulo))!!}.
    <b><em>
            @if($referencia->editor != null)
                {{$referencia->editor}} (Ed.). @endif  <!--  In: -->
            @if($referencia->editorial != null)
                {{$referencia->editorial}},@endif
            @if($referencia->edicion != null)
                {{$referencia->edicion}},@endif
            @if($referencia->lugar != null)
                {{$referencia->lugar}},@endif
        </em>
        @if($referencia->paginas != null)
            {{$referencia->paginas}} pp.@endif
    </b>
    @if($referencia->isbn != null) ISBN:{{$referencia->isbn}} @endif

    @if($referencia->comentarios != null) <br /><span class='mutted'>{{$referencia->comentarios}}</span>@endif

    @if($referencia->archivo != null)
        <!-- aquí código que muestra el enlace al pdf o aviso para solicitud del archivo -->

        <a href='#' title='Estimado visitante, disponemos de este artículo original en formato pdf, si requiere una copia del mismo, solicítelo al correo electrónico santiago.gomez@ciens.ucv.ve o yusneyicarballo@gmail.com. Gracias.'>
            <img src='{{asset("../public/img_publicas/icon_pdf.gif")}}'/>
            <b>ver pdf</b></a>
    @endif


    <!-- se construye la referencia bibliográfica según formato de Catálogo -->
    @elseif( $tipo == "Catálogo" )
        <h4>{{$referencia->autores}}, {{$referencia->fecha}}{{$referencia->letra}}</h4>

        {!!html_entity_decode(trim($referencia->titulo))!!}.
        <b>

            <!-- campos propios de un catálogo en revista -->

            @if($referencia->nombre != null)
                <em>{{trim($referencia->nombre)}}.</em>@endif
            @if($referencia->volumen != null)
                {{$referencia->volumen}}@endif
            @if($referencia->numero != null)
                ({{$referencia->numero}})@endif

        <!-- campos propios de un catálogo en libro -->
            <em>
            @if($referencia->editor_editorial != null)
                {{$referencia->editor_editorial}} (Ed.). @endif  <!--  In: -->
                @if($referencia->edicion != null)
                    {{$referencia->edicion}},@endif
                @if($referencia->lugar != null)
                    {{$referencia->lugar}},@endif
            </em>

        @if($referencia->paginas != null)
                {{$referencia->paginas}} pp.@endif
        </b>
        @if($referencia->isbn != null) ISBN: {{$referencia->isbn}} @endif

        @if($referencia->comentarios != null) <br /><span class='mutted'>{{$referencia->comentarios}}</span>@endif

        @if($referencia->archivo != null)
            <!-- aquí código que muestra el enlace al pdf o aviso para solicitud del archivo -->

            <a href='#' title='Estimado visitante, disponemos de este artículo original en formato pdf, si requiere una copia del mismo, solicítelo al correo electrónico santiago.gomez@ciens.ucv.ve o yusneyicarballo@gmail.com. Gracias.'>
                <img src='{{asset("../public/img_publicas/icon_pdf.gif")}}'/>
                <b>ver pdf</b></a>
        @endif


<!-- se construye la referencia bibliográfica según formato de Sitio Web -->

@elseif($tipo=="Sitio Web")
    <h4>{{$referencia->autores}}, {{$referencia->fecha}}{{$referencia->letra}}</h4>

    <b><em>{!!html_entity_decode(trim($referencia->nombre))!!}. </em></b>
    @if($referencia->institucion != null){{$referencia->institucion}}. @endif
    @if($referencia->lugar != null){{$referencia->lugar}}. @endif
    <a href='{{$referencia->enlace}}' target='_blank'>{{$referencia->enlace}}</a>



<!-- se construye la referencia bibliográfica según formato de Trabajo Académico -->
@elseif($tipo=="Trabajo Académico")

    <?php
    $t="";
    switch ($referencia->tipo)
    {
        case 'Monografías de Trabajos de Ascenso': $t = 'Trabajo de Ascenso'; break;
        case 'Trabajo Especial de Grado (Licenciatura)': $t = 'Trabajo Especial de Grado'; break;
        case 'Tesis (Maestría)': $t = 'Tesis de Maestría'; break;
        case 'Tesis (Doctorado)': $t = 'Tesis de Doctorado'; break;
    }
    ?>

    <h4>{{$referencia->autores}} {{$referencia->fecha}}{{$referencia->letra}}</h4>

        <span>{!!html_entity_decode(trim($referencia->titulo))!!}.</span>
        <b><em>
        {{ $t }}.
        @if($referencia->institucion != null)
                {{$referencia->institucion}}.@endif
        @if($referencia->lugar != null)
                {{$referencia->lugar}}, @endif
        </em>
        {{$referencia->paginas}} pp.</b>
        @if($referencia->enlace != null) <a href='{{$referencia->enlace}}' target='_blank'><br />{{$referencia->enlace}}</a>@endif
@endif