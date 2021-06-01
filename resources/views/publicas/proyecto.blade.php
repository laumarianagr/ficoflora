@extends('master-publicas')

@section('title')
    <title>Ficoflora Venezuela | Proyecto </title>
@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('css_publicas/hover.css')}}">

@stop

@section('id-menu')
    <script>
        localStorage.setItem("menu", "m-proyecto");
    </script>
@stop


@section('content')

    <!--start: Wrapper-->
    <div id="wrapper">

        <!--start: Container -->
        <div class="container">

            <!--start: Row -->
            <div class="row">

                <div class="col-xlg-8 col-md-8 col-xs-12"><!--start: LEFT area -->

                    <!-- start: About Phycoflora Venezuela Project -->
                    <div id="about">
                        <div class="title"><h3><i class="ico-stats ico-color"></i>Proyecto Ficoflora Venezuela</h3></div>
                        <p>
                            Las algas marinas han constituido un importante recurso biológico para muchos países a lo largo de
                            muchas décadas, lo que ha generado la necesidad de enriquecer su conocimiento taxonómico para así contribuir a su conservación.
                        </p>
                        <p>
                            En la costa de Venezuela se han realizado diversos estudios con relación a los aspectos taxonómicos y florísticos de las macroalgas
                            bénticas marinas. Las primeras colecciones de algas realizadas en Venezuela se remontan al año 1799, llevadas a cabo por los alemanes
                            Alexander Von Humboldt y Aimé Bonpland en su llegada al Nuevo Continente, en expediciones a Cumaná, La Guaira y Puerto Cabello.
                            La mayoría de los estudios ficoflorísticos publicados en las primeras seis décadas del siglo XX fueron realizados, entre otros,
                            por los investigadores William R. Taylor, Manuel Díaz-Piferrer, Ernesto Foldats y E.K. Ganesan, cuya contribución ha sido muy valiosa
                            y pionera para el estudio y reconocimiento de nuestra ficoflora en este período inicial.
                        </p>
                    </div>
                    <!-- end: About -->
                    <!--end: Row   LEFT area   -->

                </div>

                <div class="col-xlg-4 col-md-4 col-xs-12">

                    <!-- start: Sidebar  RIGHT  area -->
                    <div id="sidebar">

                        <!-- start: Tabs -->
                        <div class="title"><h3>Colaboraciones</h3></div>

                        <ul class="tabs-nav">
                            <li class="active"><a href="#tab1"><i class="mini-ico-plus"></i> Enviar reportes</a></li>
                            <li><a href="#tab2"><i class="mini-ico-pencil"></i> ¿Cómo citarnos?</a></li>
                        </ul>

                        <div class="tabs-container">
                            <div class="tab-content" id="tab1">
                                <p>
                                    Agradecemos su colaboración para mantener actualizado este catálogo nacional. <br />
                                    Puede enviarnos sus reportes de especies, artículos de investigación, fotografías,
                                    noticias o eventos escribiendo al Prof. Santiago Gómez Acevedo a: <br />
                                    <i class="ico-envelope"></i>
                                    <a href="mailto:santiago.gomez@ciens.ucv.ve" target="_blank" title="correo:santiago.gomez@ciens.ucv.ve">
                                        santiago.gomez@ciens.ucv.ve
                                    </a>
                                </p>
                            </div>

                            <div class="tab-content" id="tab2">
                                <h4>Web Ficoflora Venezuela (<span id="agno"></span>)&nbsp;&nbsp; <a href="#"><i class="mini-ico-edit" style="vertical-align: bottom;" onclick="copyToClipboard('#p1')" title="clic para copiar referencia"></i></a></h4><br />
                                Referencia: <br />
                                Web Ficoflora Venezuela. <span id="agno2"></span>. <b>Catálogo digital de la Ficoflora de Venezuela</b>.
                                Publicación electrónica. Universidad Central de Venezuela, Caracas.
                                Editores: Santiago Gómez, Yusneyi Carballo Barrera, Mayra García & Nelson Gil.
                                Consultado el <span id="fecha"></span>,
                                en <a href="http://www.ciens.ucv.ve/ficofloravenezuela/" target="_blank" title="Web Ficoflora Venezuela">
                                    http://www.ciens.ucv.ve/ficofloravenezuela/</a>
                            </div>
                        </div>
                        <!-- end: Tabs -->

                    </div>
                    <!-- end: Sidebar   RIGHT area   -->
                </div>

            </div>
            <!--end: Row-->

        </div>
        <!--end: Container-->

        <!--start: Container -->
        <div class="container">

            <!-- start: Row -->
            <div class="row">

                <!-- start: continue ...  About Phycoflora Venezuela Project -->
                <div id="about">
                    <br />
                    <p>
                        Cabe destacar la notable contribución de los científicos venezolanos, como Nora Rodríguez de Ríos con la realización de la
                        lista de algas macroscópicas de la Bahía de Mochima (Sucre) y varias localidades del estado Aragua, así como su importante aporte
                        al estudio taxonómico de los géneros <i>Laurencia</i> y <i>Gracilaria</i>, donde se describen varias especies nuevas para la ciencia;
                        Andrés Lemus en el Golfo de Cariaco y la Península de Paria (Sucre) y Olga Albornoz quien realizó importantes inventarios
                        en la Península de Paraguaná (Falcón) y en el Parque Nacional Archipiélago Los Roques en los últimos 20 años.
                    </p>

                    <!-- start photo -->
                    <div id="box-center">
                        <div class="box-shadow">
                            <img src="{{ asset('img_publicas/parallax-slider/31_v2.jpg')}}" alt="Dos Mosquises - P.N. Los Roques" title="Dos Mosquises - P.N. Los Roques" class="photo">

                        </div>
                        <p class="fuente"><b>Estación Biológica Dos Mosquises</b>, Parque Nacional Archipiélago Los Roques, Territorio Insular Miranda, Venezuela.
                            <span class="fotografo">| <i class="mini-ico-camera"></i> Santiago Gómez &copy; </span>
                        </p>
                    </div>
                    <!-- end photo -->

                    <br />
                    <p>
                        En las últimas tres décadas, diversos investigadores venezolanos han realizado valiosos aportes en las áreas de taxonomía,
                        nomenclatura y distribución de nuevas taxa de algas marinas de Venezuela, entre otros:
                    </p>
                    <ul class="vigneta2">
                        <li>Aidé Velázquez (Universidad de Oriente, Nueva Esparta)</li>
                        <li>Beatriz Vera (Universidad Central de Venezuela, Distrito Capital)</li>
                        <li>Jorge Barrios (Universidad de Oriente, Sucre)</li>
                        <li>María A. Solé (Fundación La Salle de Ciencias Naturales, Nueva Esparta)</li>
                        <li>Mayra García (Universidad Central de Venezuela, Distrito Capital)</li>
                        <li>Mirella Aponte (Universidad de Oriente, Sucre)</li>
                        <li>Nelson Gil (Universidad Pedagógica Experimental Libertador, Distrito Capital)</li>
                        <li>Santiago Gómez (Universidad Central de Venezuela, Distrito Capital)</li>
                        <li>Sonia Ardito (Universidad de Carabobo, Carabobo)</li>
                    </ul>
                    <br/>
                    <p>
                        Con base en lo anteriormente expuesto se puede evidenciar que poseemos una importante información florística y taxonómica de muchas
                        regiones del país, pero estos datos se encuentran en muchos casos dispersos.  La publicación más completa ha sido la obra:
                        "Catálogo Nacional de Algas Bénticas y pastos marinos de Venezuela" (<i>A Catalog of Benthic Marine Algae and Seagrasses of
                            Venezuela</i>), publicado por Ganesan en 1989 y  compila registros de aproximadamente 530 especies de la costa venezolana.
                        Por otra parte mucha de la información publicada corresponde a listas florísticas, sin descripciones, claves, ilustraciones,
                        ni mapas, lo cual hace de esta iniciativa un atractivo didáctico, ya que el presente catálogo contiene la recopilación bibliográfica
                        ficoflorística desde las referidas publicaciones desde el año 1822 hasta el presente y material fotográfico con datos georeferenciados.
                    </p>
                    <p>
                        También es una oportunidad para ingresar otro tipo de material científico y/o de divulgación que deseen aportar los usuarios y que
                        resultarían muy útiles para esta comunidad. En Venezuela existe una importante diversidad de macroalgas marinas bénticas; sin embargo,
                        carecemos de información florística y taxonómica actualizada de muchas regiones del país. Existen muchos registros de especies poco
                        documentadas, raras, de identidad taxonómica incierta o de distribución geográfica restringida, así como carencia de datos geográficos
                        de las poblaciones naturales y su posible aprovechamiento. Las actividades previstas en el presente proyecto permitirán aportar
                        datos para mejorar estos aspectos.
                    </p>
                    <p>
                        Invitamos a los ficólogos nacionales e internacionales a fortalecer el <span class="caligrafia">Catálogo Digital Taxonómico de las
                            Macroalgas Bénticas Marinas de Venezuela</span> enviándonos los artículos o investigaciones que no hayan sido incluidos en esta
                        edición inicial, reportes, fotografías, noticias, eventos o anuncios de actividades nacionales e internacionales de interés.
                    </p>
                </div>
                <!-- end: About -->


                <!-- start: Research Funding and Institutional Support -->
                <div id="about">

                    <br />
                    <div class="title"><h3>Financiamiento y Apoyo Institucional</h3></div>
                        <p>
                            El desarrollo de este proyecto no hubiese sido posible sin el financiamiento otorgado por el
                            <strong>Consejo de Desarrollo Científico y Humanístico de la Universidad Central de Venezuela
                            (<a href="http://cdch-ucv.net/" target="_blank" title="CDCH-UCV">CDCH-UCV</a>)</strong>, a través del
                            Proyecto de Grupo <strong>PG 03-8643-2013</strong>, además del apoyo institucional y logístico de:
                        </p>

                        <ul class="vigneta2">
                            <li>Coordinación de Investigación y Coordinación Administrativa, Facultad de Ciencias, UCV</li>
                            <li>Instituto de Biología Experimental, IBE, Facultad de Ciencias, UCV</li>
                            <li>Centro de Enseñanza Asistida por Computador, CENEAC, Escuela de Computación, UCV</li>
                            <li>Instituto Experimental Jardín Botánico Dr. Tobías Lasser, UCV</li>
                            <li>Instituto Pedagógico de Miranda José Manuel Siso Martínez, UPEL</li>
                            <li>Centro de Computación, Facultad de Ciencias, UCV</li>
                            <li>Centro de Investigaciones Ecológicas Guayacán (CIEG), Universidad de Oriente, Núcleo Sucre</li>
                            <li>También queremos agradecer la colaboración de la Profa. Evelyn Zoppi de Roa (UCV),
                                el Sr. Abel Vásquez y el Sr. Francis Lemus (lancheros).
                            </li>
                        </ul>

                    <p class="logo2">
                        <a href="http://www.ucv.ve" target="_blank" title="Universidad Central de Venezuela">
                            <img src="{{asset('img_publicas/logoUCV.png')}}" alt="Universidad Central de Venezuela">
                        </a>
                        <a href="http://www.ciens.ucv.ve/ciens/" target="_blank" title="Facultad de Ciencias UCV">
                            <img src="{{asset('img_publicas/logoFacCiencias.png')}}" alt="Facultad de Ciencias UCV">
                        </a>
                        <a href="http://www.ciens.ucv.ve/ibexp/Index.htm" target="_blank" title="Instituto de Biología Experimental UCV">
                            <img src="{{asset('img_publicas/logoIBE.png')}}" alt="Instituto de Biología Experimental UCV">
                        </a>
                        <a href="http://computacion.ciens.ucv.ve/escueladecomputacion/" target="_blank" title="Escuela de Computación UCV">
                            <img src="{{asset('img_publicas/logoEscComputacion.png')}}" alt="Escuela de Computación UCV">
                        </a>
                        <a href="http://www.ceneac.com.ve/" target="_blank" title="CENEAC UCV">
                            <img src="{{asset('img_publicas/logoCENEAC.jpg')}}" alt="CENEAC UCV">
                        </a>
                        <a href="http://www.ucv.ve/organizacion/fundaciones-asociaciones-y-centros/fundacion-instituto-botanico-de-venezuela.html"
                           target="_blank" title="Instituto Experimental Jardín Botánico Dr. Tobías Lasser UCV">
                            <img src="{{asset('img_publicas/logoFIBV.png')}}" alt="Instituto Experimental Jardín Botánico Dr. Tobías Lasser UCV">
                        </a>
                        <a href="http://www.ipmjmsm.upel.edu.ve/index.php" target="_blank"
                           title="Instituto Pedagógico de Miranda José Manuel Siso Martínez UPEL">
                            <img src="{{asset('img_publicas/logoIMP_JMSM.png')}}" alt="Instituto Pedagógico de Miranda José Manuel Siso Martínez UPEL">
                        </a>
                        <a href="http://www.upel.edu.ve/" target="_blank" title="Universidad Pedagógica Experimental Libertador">
                            <img src="{{asset('img_publicas/logoUPEL.png')}}" alt="Universidad Pedagógica Experimental Libertador">
                        </a>
                    </p>
                </div>
                <!-- end:  Research Funding  -->

                <!-- start: Research Team Ficoflora Venezuela -->
                <div id="team"><a name="creditos" id="creditos"></a>
                    <div class="title"><h3>Créditos :: Grupo de Investigación y Desarrollo del Catálogo Digital</h3></div>

                    <!-- start: Team row 1  -->
                    <div class="row">

                        <!-- start: About Member -->
                        <div class="col-xlg-3 col-md-3 col-xs-12">
                            <div class="avatar view-team">

                                <img src="{{ asset('img_publicas/foto_SantiagoGomez_2.png')}}" alt="Santiago Gómez Acevedo" title="Santiago Gómez Acevedo">
                                <div class="mask">
                                    <p>
                                        Taxonomía de Algas Marinas Tropicales. <br /><br />
                                        Instituto de Biología Experimental <br />IBE - UCV  <br /><br />
                                    </p>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="team-name">Santiago Gómez Acevedo <br />
                            <span>
                            / Biólogo, Coordinador <br />
                            Universidad Central de Venezuela <br />
                            <a href="mailto:santiago.gomez@ciens.ucv.ve" target="_blank">santiago.gomez@ciens.ucv.ve</a>
                            </span>
                            </div>
                        </div>

                        <div class="col-xlg-3 col-md-3 col-xs-12">
                            <div class="avatar view-team">
                                <img src="{{ asset('img_publicas/foto_YusneyiCarballo_2.png')}}" alt="Yusneyi Carballo Barrera" title="Yusneyi Carballo Barrera">
                                <div class="mask">
                                    <p>
                                        Desarrollo de Aplicaciones de Software y Diseño de Bases de Datos. <br /><br />
                                        Escuela de Computación <br />CENEAC - UCV <br /><br />
                                    </p>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="team-name">Yusneyi Carballo Barrera <br />
                            <span>
                            / Computista <br />
                            Universidad Central de Venezuela <br />
                            <a href="mailto:yusneyi.carballo@ciens.ucv.ve" target="_blank">yusneyi.carballo@ciens.ucv.ve</a>
                            </span>
                            </div>
                        </div>

                        <div class="col-xlg-3 col-md-3 col-xs-12">
                            <div class="avatar view-team">
                                <img src="{{ asset('img_publicas/foto_MayraGarcia_2.png')}}"  alt="Mayra García Ortíz" title="Mayra García Ortíz">
                                <div class="mask">
                                    <p>
                                        Taxonomía de Algas Marinas Tropicales. <br /><br />
                                        Fundación Instituto Botánico de Venezuela <br />FIBV - UCV <br /><br />
                                    </p>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="team-name">Mayra García Ortíz <br />
                            <span>
                            / Bióloga <br />
                            Universidad Central de Venezuela <br />
                            <a href="mailto:mayra.garcia@ucv.ve" target="_blank">mayra.garcia@ucv.ve</a>
                            </span>
                            </div>
                        </div>

                        <div class="col-xlg-3 col-md-3 col-xs-12">
                            <div class="avatar view-team">
                                <img src="{{ asset('img_publicas/foto_NelsonGil_2.png')}}" alt="Nelson Gil Luna" title="Nelson Gil Luna">
                                <div class="mask">
                                    <p>
                                        Taxonomía de Algas Marinas Tropicales. <br /><br />
                                        Instituto Pedagógico de Miranda <br />IPM JMSM - UPEL  <br /><br />
                                    </p>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="team-name">Nelson Gil Luna <br />
                            <span>
                            / Biólogo <br />
                            Universidad Pedagógica Exp. Libertador <br />
                            <a href="mailto:biociencia@gmail.com" target="_blank">biociencia@gmail.com</a>
                            </span>
                            </div>
                        </div>
                        <!-- end: About Team Members -->

                    </div>
                    <!-- end: Row 1 -->

                    <!-- start: Row 2 -->
                    <div class="row">

                        <!-- start: About Member -->
                        <div class="col-xlg-3 col-md-3 col-xs-12">
                            <div class="avatar view-team">
                                <img src="{{ asset('img_publicas/foto_MariaPinzonBaldizan.jpg')}}" alt="María Pinzón Baldizán" title="María Pinzón Baldizán">
                                <div class="mask">
                                    <p>
                                        Tesista desarrolladora de los Módulos Gestión de Datos, Estadísticas y Consultas.  <br /><br />
                                        Escuela de Computación - UCV  <br />
                                    </p>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <div class="team-name">María Pinzón Baldizán <br />
                            <span>
                            / Computista <br />
                            Universidad Central de Venezuela <br />
                                Premio MEJOR TEG SCTC 2016<br />
                            <a href="mailto:mjpinzon@gmail.com" target="_blank">mjpinzon@gmail.com</a>
                            </span>
                            </div>
                        </div>

                        <div class="col-xlg-9 col-md-9 col-xs-12">
                            <div class="title"><h3>Herramientas y tecnologías</h3></div>

                            <p>Ficoflora Venezuela ha sido desarrollado combinando diversas tecnologías:
                            <ul class="vigneta2">
                                <li><a href="http://www.w3schools.com/html/default.asp" target="_blank">HTML5</a>,
                                    <a href="http://www.w3schools.com/css/default.asp" target="_blank">CSS</a>,
                                    <a href="http://www.w3schools.com/js/default.asp" target="_blank">JavaScript</a>,
                                    <a href="https://jquery.com/" target="_blank">jQuery</a>,
                                    <a href="http://www.w3schools.com/bootstrap/default.asp" target="_blank">Bootstrap</a>,
                                    <a href="http://laravel.com/" target="_blank">APIs Laravel</a>,
                                    <a href="http://www.w3schools.com/php/default.asp" target="_blank">PHP</a>,
                                    <a href="https://www.mysql.com/" target="_blank">MySQL</a> y
                                    <a href="https://www.apachefriends.org/es/index.html/" target="_blank">XAMPP Apache Web Server</a>
                                    para el desarrollo de módulos, funcionalidades y ficha descriptiva de la especie
                                </li>
                                <li><a href="http://c3js.org/" target="_blank">C3js</a>,
                                    como librería para conversión de datos y generación de gráficos estadísticos
                                </li>
                                <li><a href="http://leafletjs.com/" target="_blank">Leaflet</a> y
                                    <a href="https://www.openstreetmap.org/" target="_blank">OpenStreetMaps</a>,
                                    para la generación de mapas interactivos y geo-referenciación
                                </li>
                                <li><a href="https://en.wikipedia.org/wiki/Adaptive_software_development" target="_blank">
                                        Adaptive Software Development (ASD)</a>  o Metodología Desarrollo Adaptable de Software
                                </li>
                                <li><a href="http://www.mpdf1.com/mpdf/index.php" target="_blank">mPDF</a>, para la creación y exportación de la
                                    ficha especie en documento portable o .pdf
                                </li>
                            </ul>
                            </p>
                        </div>

                        <!-- end: About Team Members -->

                    </div>
                    <!-- end: Row 2 -->

    </div>
    <!-- end: Wrapper  -->
@stop