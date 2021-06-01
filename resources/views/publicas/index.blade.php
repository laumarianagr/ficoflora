@extends('master-publicas')

@section('title')
    <title>Ficoflora Venezuela, Bienvenidos </title>
@stop

@section('css_section')
    @parent
@stop

@section('id-menu')
    <script>
        localStorage.setItem("menu", "m-index");
    </script>
@stop


@section('content')

    <!-- start: Slider -->
    <div class="slider-wrapper">

        <div id="da-slider" class="da-slider">
            <!--  intervalo de transición en js_publicas/jquery.cslider.js -->


            <div class="da-slide">
                <h2 style="font-size: 36px;">XII Congreso de Ficología <br />
                    de <br />
                    América Latina y El Caribe
                </h2>
                <p>
                    <br /><br />
                    SOFILAC 2020, 12 al 17 de julio<br />
                    San José, Costa Rica
                    <br /><br />
                    <a href="https://www.facebook.com/SOFILAC2020/?modal=admin_todo_tour" target="_blank" title="SOFILAC 2020, Costa Rica" style="color: #FFFFFF;">
                        www.facebook.com/SOFILAC2020</a>
                </p>
                <!-- <a href="#" class="da-link">Read more</a>  -->
                <div class="da-img"><img src="{{ asset('img_publicas/parallax-slider/12_Sofilac2020.jpg')}}" alt="SOFILAC 2020, Costa Rica" /></div>
            </div>


            <div class="da-slide">
                <h2 style="font-size: 30px;">Macroalgas Bénticas Marinas del <br />Parque Nacional Archipiélago Los Roques<br />Guía Ilustrada</h2>
                <p>
                    <br />
                    Gómez, García, Carballo Barrera y Gil<br /><br />
                    Disponible en:<br />
                    <a href="http://www.ciens.ucv.ve/ficofloravenezuela/pnalr/pnalr/index.php" target="_blank" title="Macroalgas P.N. Archipiélago Los Roques - Guía Ilustrada" style="color: #FFFFFF;">
                        Macroalgas P.N. Archipiélago Los Roques - Guía Ilustrada<br />
                        http://www.ciens.ucv.ve/ficofloravenezuela/pnalr
                    </a>
                </p>
                <div class="da-img"><img src="{{ asset('img_publicas/parallax-slider/FicofloraPNALR.jpg')}}" alt="Macroalgas P.N. Archipiélago Los Roques - Guía Ilustrada" /></div>
            </div>


            <div class="da-slide">
                <h2>Catálogo Nacional</h2>
                <p>Compilación de
                    <br />&#8226; 5.272 registros <br />&#8226; 663 especies <br />&#8226; 222 referencias bibliográficas
                    <br />&#8226; 534 localidades distribuidas en 12 entidades federales</p>
                <!-- <a href="#" class="da-link">Read more</a>  -->
                <div class="da-img"><img src="{{ asset('img_publicas/parallax-slider/34.jpg')}}" alt="Ficoflora Venezuela compilación" /></div>
            </div>


            <div class="da-slide">
                <h2>Divulgando la <br />Investigación</h2>
                <p><br /><br />
                    Hemos incluido en Ficoflora Venezuela referencias bibliográficas correspondientes a
                    catálogos, artículos, trabajos de grado, trabajos académicos y libros, las cuales
                    que reportan nuestra biodiversidad regional y nacional</p>
                <!-- <a href="#" class="da-link">Read more</a>  -->
                <div class="da-img"><img src="{{ asset('img_publicas/parallax-slider/0_divulgacion_2.jpg')}}" alt="divulgación de investigaciones" /></div>
            </div>

            <div class="da-slide">
                <h2 style="font-size: 36px;">bdLACET<br />
                    Buscador Algas Continentales<br />
                </h2>
                <p>
                    Laboratorio de Algas Continentales, <br />
                    Ecología y Taxonomía, UNAM
                    <br /><br /><br />
                    <a href="https://bdlacet.mx/" target="_blank" title="bdLACET Buscador, UNAM" style="color: #FFFFFF;">
                        https://bdlacet.mx/</a>
                </p>
                <!-- <a href="#" class="da-link">Read more</a>  -->
                <div class="da-img"><img src="{{ asset('img_publicas/parallax-slider/12_bdLacet.jpg')}}" alt="bdLACET Buscador, UNAM" /></div>
            </div>

    </div>
    <!-- end: Slider -->

    <!--start: Wrapper-->
    <div id="wrapper">
        <!--start: Container -->
        <div class="container">
            <!--start: Row -->
            <div class="row">

                <div class="col-md-6 col-xlg-8 col-xs-12"><!--start: LEFT area -->
                    <!-- start: Hero Unit - Main hero unit for a primary marketing message or call to action -->
                    <div class="hero-unit">
                        <p>
                            Ficoflora Venezuela es un proyecto realizado con el objetivo de actualizar el inventario de
                            algas marinas a nivel nacional, caracterizando, ilustrando morfoanatómicamente y validando
                            taxonómicamente los registros disponibles, elaborando así el primer Catálogo Taxonómico Digital de
                            Macroalgas Bénticas Marinas de Venezuela.
                        </p>
                        <p>
                            <a class="btn btn-success btn-large" href="{{route('proyecto')}}" target="_parent">Leer más &raquo;</a>
                        </p>
                    </div>
                    <!-- end: Hero Unit -->
                </div>

                <div class="col-md-6 col-xlg-4 col-xs-12"><!--start: LEFT area -->
                    <!-- start: Testimonials-->
                    <div class="testimonial-container">

                        <div class="title"><h3>Lo más reciente</h3></div>

                        <div class="testimonials-carousel" data-autorotate="6500">
                            <ul class="carousel">


                                <li class="testimonial">
                                    <div class="testimonials">
                                        <h4>Actualización base de datos bdLACET</h4>
                                        Facultad de Ciencias, UNAM, México<br />
                                        Registros bibliográficos de algas de aguas continentales de México y con datos de otros lugares.
                                        Las actualizaciones incluyen Cyanoprokaryota, Rhodophyta y Euglenophyta (Euglenozoa).
                                        <br />
                                        Disponible en:
                                        <a href="https://bdlacet.mx/"
                                           target="_blank" title="bdLACET UNAM México">
                                            bdLACET.mx/</a>
                                    </div>
                                    <div class="testimonials-bg"></div>
                                    <div class="testimonials-author">:: <span>20/Junio/2019</span></div>
                                </li>

                                <li class="testimonial">
                                    <div class="testimonials">
                                        <h4>CODIMAR, Colección de Dinoflagelados Marinos</h4>
                                        Morquecho, L., Reyes-Salinas, A., 2004 en adelante. Colección de Dinoflagelados Marinos (CODIMAR). Centro de Investigaciones Biológicas
                                        del Noroeste, S.C. La Paz, Baja California Sur, México.
                                        Curador Responsable: Dra. Lourdes Morquecho Escamilla. Técnico: M. en C. Amada Reyes Salinas
                                        <br />
                                        Mayor información:
                                        <a href="https://www.cibnor.gob.mx/investigacion/colecciones-biologicas/codimarm"
                                           target="_blank" title="CODIMAR, Colección de Dinoflagelados Marinos">
                                            www.cibnor.mx</a>
                                    </div>
                                    <div class="testimonials-bg"></div>
                                    <div class="testimonials-author">:: <span>10/Junio/2019</span></div>
                                </li>

                                <li class="testimonial">
                                    <div class="testimonials">
                                        <h4>Macroalgas Bénticas del PNALR</h4>
                                        El sello editorial EdiCiencias, de la Facultad de Ciencias UCV, ha presentado entre
                                        sus primeras obras al libro
                                        <b>"Macroalgas Bénticas del Parque Nacional Archipiélago Los Roques, Venezuela. Guía Ilustrada". </b>
                                        <br />
                                        Puede consultarse en:
                                        <a href="http://www.ciens.ucv.ve/ficofloravenezuela/pnalr/index.php" target="_blank"
                                           title="sitio Ficoflora PNALR">
                                            Ficoflora Parque Nacional Archipiélago Los Roques</a>
                                    </div>
                                    <div class="testimonials-bg"></div>
                                    <div class="testimonials-author">:: <span>16/Noviembre/2017</span></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Row-->

            <!--start: Row -->
            <div class="row">
                <!-- start: About Us -->
                <div id="about">
                    <div class="title"><h3>Propósito de esta iniciativa </h3></div>
                    <p>
                        En Venezuela existe una importante diversidad de Algas Marinas Bénticas; sin embargo,
                        carecemos de información florística y taxonómica actualizada de muchas regiones del país.
                        Existen muchos registros de especies poco documentadas, raras, de identidad taxonómica incierta
                        o de distribución geográfica restringida, así como carencia de datos geográficos de las poblaciones
                        naturales y su posible aprovechamiento.
                    </p>
                    <p>
                        Se hace necesario un levantamiento de información y actualización de la misma, elaborando una
                        base de datos nacional, con datos taxonómicos, ecológicos, geográficos, bibliográficos, mapas y fotografías.
                    </p>
                    <p>
                        Esta base de datos está disponible al público en general a través del proyecto Ficoflora Venezuela,
                        a través de este sitio web y con funcionalidades de consulta de la información y herramientas
                        de uso educativo.
                    </p>
                </div>
                <!-- end: About Us -->
            </div>
            <!--end: Row-->

            <hr>

            <!--start: Row -->
            <div class="row">
                <!-- start Species List -->
                <div class="clients-carousel">
                    <ul class="slides clients">

                        <li><img src="{{ asset('img_publicas/species-carousel/Acanthophora_spicifera_3.jpg')}}" alt="Acanthophora spicifera" title="Acanthophora spicifera"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Acrothamnion_butlerae_4.jpg')}}" alt="Acrothamnion butlerae" title="Acrothamnion butlerae"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Bryopsis_plumosa_2.jpg')}}" alt="Bryopsis plumosa" title="Bryopsis plumosa"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Caulerpa_cylindracea.jpg')}}" alt="Caulerpa cylindracea" title="Caulerpa cylindracea"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Centroceras_gasparrinii_2.jpg')}}" alt="Centroceras gasparrinii" title="Centroceras gasparrinii"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Ceramium_vagans.jpg')}}" alt="Ceramium vagans" title="Ceramium vagans"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Codium_repens.jpg')}}" alt="Codium repens" title="Codium repens"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Cryptonemia_crenulata.jpg')}}" alt="Cryptonemia crenulata" title="Cryptonemia crenulata"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Derbesia_marina.jpg')}}" alt="Derbesia marina" title="Derbesia marina"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Dictyota_pulchella.jpg')}}" alt="Dictyota pulchella" title="Dictyota pulchella"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Ganonema_farinosum_5.jpg')}}" alt="Ganonema farinosum" title="Ganonema farinosum"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Gelidium_pusillum_2.jpg')}}" alt="Gelidium pusillum" title="Gelidium pusillum"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Hypnea_cornuta_4.jpg')}}" alt="Hypnea cornuta" title="Hypnea cornuta"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Laurencia_obtusa_2.jpg')}}" alt="Laurencia obtusa" title="Laurencia obtusa"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Palisada_perforata_2.jpg')}}" alt="Palisada perforata" title="Palisada perforata"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Phyllodictyon_anastomosans.jpg')}}" alt="Phyllodictyon anastomosans" title="Phyllodictyon anastomosans"/></li>
                        <li><img src="{{ asset('img_publicas/species-carousel/Sargassum_polyceratium.jpg')}}" alt="Sargassum polyceratium" title="Sargassum polyceratium"/></li>

                    </ul>
                </div>
                <!-- end Species List -->
            </div>
            <!--end: Row-->

        </div>
        <!--end: Container-->
    </div>
    <!-- end: Wrapper  -->
@stop