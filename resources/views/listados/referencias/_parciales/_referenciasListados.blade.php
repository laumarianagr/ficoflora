@if ( $referencia->c12 == "Artículo en Revista" )
    <!-- se construye la lista de referencias bibliográficas según formato de Revista -->

    <b>{!!html_entity_decode(trim($referencia->c1))!!}, {{$referencia->c2}}{{$referencia->c3}}</b><br/>

    {!!html_entity_decode(trim($referencia->c4))!!}.
    <b><em>{{trim($referencia->c5)}}.</em>
        @if($referencia->c6 != null)
            {{$referencia->c6}}@endif
        @if($referencia->c7 != null)
            ({{$referencia->c7}})@endif
        @if( ($referencia->c8 != null) && ( ($referencia->c6 != null) || ($referencia->c7 != null)) )
            :{{$referencia->c8}}.@endif
    </b>
    @if($referencia->c9 != null){{$referencia->c9}}. @endif

    @if($referencia->c11 != null) <br /><span class='mutted'>{{$referencia->c11}}</span>@endif


@elseif( $referencia->c12 == "Libro" )
    <!-- se construye la lista de referencias bibliográficas según formato de Libro -->
    <b>{{$referencia->c1}}, {{$referencia->c2}}{{$referencia->c3}}</b><br/>

    {!!html_entity_decode(trim($referencia->c4))!!}.
    <b><em>
            @if($referencia->c5 != null)
                {{$referencia->c5}} (Ed.). @endif <!--  In: -->
            @if($referencia->c6 != null)
                {{$referencia->c6}},@endif
            @if($referencia->c7 != null)
                {{$referencia->c7}},@endif
            @if($referencia->c8 != null)
                {{$referencia->c8}},@endif
        </em>
        @if($referencia->c9 != null)
            {{$referencia->c9}} pp.@endif
    </b>
    @if($referencia->c10 != null) ISBN:{{$referencia->c10}} @endif

    @if($referencia->c11 != null) <br /><span class='mutted'>{{$referencia->c11}}</span>@endif

    @if($referencia->c13 != null)
       <!-- aquí código que muestra el enlace al pdf o aviso para solicitud del archivo -->

       <a href='#' title='Estimado visitante, disponemos de este artículo original en formato pdf, si requiere una copia del mismo, solicítelo al correo electrónico santiago.gomez@ciens.ucv.ve o yusneyicarballo@gmail.com. Gracias.'>
           <img src='{{asset("../public/img_publicas/icon_pdf.gif")}}'/>
           <b>ver pdf</b></a>
   @endif



@elseif( $referencia->c12 == "Catálogo" )
    <!-- se construye la lista de referencias bibliográficas según formato de Libro -->
    <b>{{$referencia->c1}}, {{$referencia->c2}}{{$referencia->c3}}</b><br/>

    {!!html_entity_decode(trim($referencia->c4))!!}.

    <!-- campos de catálogo en revista nombre, volumen y número -->
    <b>
        @if($referencia->c5 != null)
            <em>{{trim($referencia->c5)}}.</em>@endif
        @if($referencia->c14 != null)
            {{$referencia->c14}}@endif
        @if($referencia->c15 != null)
            ({{$referencia->c15}})@endif

    <!-- campos de catálogo en libro editor_editorial, edición y lugar -->
    <em>
        @if($referencia->c6!= null)
            {{$referencia->c6}} (Ed.). @endif <!--  In: -->
        @if($referencia->c7 != null)
            {{$referencia->c7}},@endif
        @if($referencia->c8 != null)
            {{$referencia->c8}},@endif
        </em>

    @if($referencia->c9 != null)
            {{$referencia->c9}} pp.@endif
    </b>
    @if($referencia->c10 != null) ISBN:{{$referencia->c10}} @endif

    @if($referencia->c11 != null) <br /><span class='mutted'>{{$referencia->c11}}</span>@endif

    @if($referencia->c13 != null)
        <!-- aquí código que muestra el enlace al pdf o aviso para solicitud del archivo -->

        <a href='#' title='Estimado visitante, disponemos de este artículo original en formato pdf, si requiere una copia del mismo, solicítelo al correo electrónico santiago.gomez@ciens.ucv.ve o yusneyicarballo@gmail.com. Gracias.'>
            <img src='{{asset("../public/img_publicas/icon_pdf.gif")}}'/>
            <b>ver pdf</b></a>
    @endif



@elseif($referencia->c12 == "Sitio Web")
    <!-- se construye la lista de referencias bibliográficas según formato de Sitio Web -->

    <b>{{$referencia->c1}}, {{$referencia->c2}}{{$referencia->c3}}</b><br/>

    <b><em>{!!html_entity_decode(trim($referencia->c4))!!}. </em></b>
    @if($referencia->c6 != null){{$referencia->c6}}. @endif
    @if($referencia->c7 != null){{$referencia->c7}}. @endif
    <a href='{{$referencia->c8}}' target='_blank'>{{$referencia->c8}}</a>
    consulta: {{$referencia->c9}}/{{$referencia->c10}}/{{$referencia->c11}}


@elseif($referencia->c12 == "Trabajo Académico")
    <!-- se construye la referencia bibliográfica según formato de Trabajo Académico -->

    <?php
    $t="";
    switch ($referencia->c5)
    {
        case 'Monografías de Trabajos de Ascenso': $t = 'Trabajo de Ascenso'; break;
        case 'Trabajo Especial de Grado (Licenciatura)': $t = 'Trabajo Especial de Grado'; break;
        case 'Tesis (Maestría)': $t = 'Tesis de Maestría'; break;
        case 'Tesis (Doctorado)': $t = 'Tesis de Doctorado'; break;
    }
    ?>

    <b>{{$referencia->c1}}, {{$referencia->c2}}{{$referencia->c3}}</b><br/>

    {!!html_entity_decode(trim($referencia->c4))!!}.
    <b><em>{{ $t }}. {{$referencia->c6}}, {{$referencia->c7}}</em>, {{$referencia->c8}} pp.</b>
    @if($referencia->c11 != null)
        <br /><span class='mutted'>{{$referencia->c11}}</span>@endif

@endif