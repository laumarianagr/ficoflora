<!-- referencias bibliográficas para la ficha de reportes y referencias por Investigador -->

<!-- se construye la referencia bibliográfica según formato de Revista -->

@if (  ($tipo == "Artículo en Revista") || ($tipo == "Catálogo en Revista") )

    <span>{!!html_entity_decode(trim($referencia->titulo))!!}.</span><br />
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
        <a href='{{asset("../../documentos/" .$referencia->archivo)}}' target='_blank' title='consultar pdf del artículo'>
            <img src='{{asset("../public/img_publicas/icon_pdf.gif")}}' style='margin-top:10px; vertical-align: baseline'/>
            <b>ver pdf</b></a>
    @endif

    @if($referencia->comentarios != null) <br /><span class='mutted'>{{$referencia->comentarios}}</span>@endif


<!-- se construye la referencia bibliográfica según formato de Libro -->
@elseif( ($tipo == "Libro") || ($tipo == "Catálogo en Libro") )

    <span>{!!html_entity_decode(trim($referencia->titulo))!!}.</span><br />
    <b><em>{{$referencia->editor}} (Ed.).    <!--  In: -->
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


<!-- se construye la referencia bibliográfica según formato de Sitio Web -->

@elseif($tipo=="Sitio Web")

    <span><em>{!!html_entity_decode(trim($referencia->titulo))!!}.</em></span><br />
    @if($referencia->institucion != null){{$referencia->institucion}}. @endif
    @if($referencia->lugar != null){{$referencia->lugar}}. @endif
    <a href='{{$referencia->enlace}}' target='_blank'>{{$referencia->enlace}}</a>

<!-- se construye la referencia bibliográfica según formato de Trabajo Académico -->
@elseif($tipo=="Trabajo Académico")

    <span>{!!html_entity_decode(trim($referencia->titulo))!!}.</span><br />
    <b><em>
    {{$ta}}.
    @if($referencia->institucion != null) <em>{{$referencia->institucion}}. @endif
    @if($referencia->lugar != null){{$referencia->lugar}}, @endif
    </em>
    {{$referencia->paginas}} pp.</b>
    @if($referencia->enlace != null) <a href='{{$referencia->enlace}}' target='_blank'><br />{{$referencia->enlace}}</a> @endif
@endif
