@extends('master-publicas')

@section('title')
    <title>Ficoflora Venezuela | Catálogo </title>
@stop

@section('css_section')
    @parent
@stop

@section('id-menu')
    <script>
        localStorage.setItem("menu", "m-catalogo");
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

                    <!-- start: About Phycoflora Venezuela Digital Catalogue Taxonomic -->
                    <div id="about">
                        <div class="title"><h3><i class="ico-stats ico-color"></i>Catálogo Taxonómico Digital Ficoflora Venezuela</h3></div>
                        <p>
                            En este proyecto interdisciplinario participan investigadores de la Biología y la Computación,
                            a fin de recopilar y actualizar la información ficoflorística venezolana, elaborándose una base de datos de acceso público,
                            de utilidad para  colegas ficólogos, docentes, estudiantes y el público en general.
                        </p>
                        <p>
                            Para la elaboración de este primer catálogo taxonómico digital de nuestra ficoflora, se han incorporado
                            <b>{{$totalReferencias}} referencias bibliográficas</b>, lo que ha permitido alimentar la base de datos mencionada con al
                            menos <b>{{$totalRegistros}} registros</b>, <b>{{$totalEspecies}} especies</b> (incluyendo variedades y formas) y
                            <b>{{$totalLocalidades}} localidades</b> distribuidas en {{$totalEntidades}} entidades federales.
                        </p>
                        <p>
                            Cada una de las especies reportadas que están registradas en la base de datos "Ficoflora Venezuela" posee una ficha descriptiva,
                            en donde es clasificada, se listan los autores que la han reportado, las localidades y las fuentes bibliográficas citadas,
                            se muestran mapas con la geo-localización de la especie, sinonimia y una galería de fotografías cuando se
                            dispone de esta información.
                        </p>
                    </div>
                    <!-- end: About -->
                    <!--end: LEFT area   -->
                </div>

                <div class="col-xlg-4 col-md-4 col-xs-12"> <!-- start: Sidebar  RIGHT  area -->
                    <div id="sidebar">

                        <!-- start: Tabs -->
                        <div class="title"><h3>Colaboraciones</h3></div>

                        <ul class="tabs-nav">
                            <li class="active"><a href="#tab1"><i class="mini-ico-pencil"></i> ¿Cómo citarnos?</a></li>
                            <li><a href="#tab2"><i class="mini-ico-plus"></i> Enviar reportes</a></li>
                        </ul>

                        <div class="tabs-container">
                            <div class="tab-content" id="tab1">
                                <h4>Web Ficoflora Venezuela (<span id="agno"></span>)&nbsp;&nbsp; <a href="#"><i class="mini-ico-edit" style="vertical-align: bottom;" onclick="copyToClipboard('#p1')" title="clic para copiar referencia"></i></a></h4><br />
                                Referencia: <br />
                                Web Ficoflora Venezuela. <span id="agno2"></span>. <b>Catálogo de la Ficoflora de Venezuela</b>.
                                Publicación electrónica. Universidad Central de Venezuela, Caracas.
                                Editores: Yusneyi Carballo-Barrera, Santiago Gómez, Mayra García & Nelson Gil.
                                Consultado el <span id="fecha"></span>,
                                en <a href="http://www.ciens.ucv.ve/ficofloravenezuela" target="_blank" title="Web Ficoflora Venezuela">
                                    http://www.ciens.ucv.ve/ficofloravenezuela</a>
                            </div>

                            <div class="tab-content" id="tab2">
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

            <!-- start: species profile -->
            <!-- start photo -->
            <div id="box-center">
                <div class="box-shadow">
                    <img src="{{ asset('img_publicas/parallax-slider/30_v2.jpg')}}" alt="Parque Nacional Morrocoy" title="Parque Nacional Morrocoy" class="photo" />
                </div>
                <p class="fuente"><b>Parque Nacional Morrocoy</b>, Estado Falcón, Costa Centro Occidental de Venezuela
                    <span class="fotografo">| <i class="mini-ico-camera"></i> Santiago Gómez &copy; </span>
                </p>
            </div>
            <!-- end: photo -->


            <!-- start: continue ... About Phycoflora Venezuela Digital Catalog Taxonomic -->
            <div id="about">
                <div class="title"><h3>Funcionalidades</h3></div>

                <p>
                    Las principales funcionalidades incorporadas en este catálogo taxonómico digital son:
                    <br /><br />
                <ul class="vigneta2">
                    <li>Consulta de registros por cualesquiera de las categorías taxonómicas, desde phylum hasta especie, por autor y
                        por localidad geográfica
                    </li>
                    <li>Listados con todos los registros reportados, por cualesquiera de las categorías taxonómicas y por localidad
                    </li>
                    <li>Referencias de las fuentes bibliográficas, hemerográficas y reportes incorporados
                    </li>
                    <li>Exportación de los resultados de las consultas y de la información de la ficha de las especies en formato de
                        documento portable (.pdf)
                    </li>
                    <li>Generación dinámica de mapas, indicando la geo-referenciación de las especies
                    </li>
                    <li>Galería de fotografías
                    </li>
                    <li>Diseño adaptativo que permite acceder al catálogo digital desde distintos dispositivos.
                    </li>
                </ul>
                </p>

            </div>
            <!-- end: About -->
            <div id="speciesprofile">
                <div class="title"><h3>Ficha de la Especie</h3></div>

                <p>
                    Dado que uno de los objetivos principales de la aplicación web es la preservación y la divulgación de la información, la ficha especie se puede
                    descargar y guardar en formato de documento portable o .pdf.
                </p>
                <p>
                    Las principales secciones y herramientas de la ficha especie se describen a continuación:
                    <br /><br />
                </p>
                <p>
                    <span class="dropcap color1">1</span>
                    La sección de <b>encabezado</b> muestra la identificación del catálogo, suministra enlaces a las páginas del sitio y
                    campos para la búsqueda por nombre de especie. <br /><br />
                </p>
                <p>
                    <span class="dropcap color2">2</span>
                    Sección de <b>identificación</b> de la especie consultada, clasificación taxonómica con enlaces que permiten
                    la consulta de los niveles superiores y la opción de exportar o guardar como archivo .pdf.
                </p>
                <p>
                    <span class="dropcap color3">3</span>
                    En la sección de <b>reportes</b> se indican los reportes de la especie en el país, en las respectiva fuente bibliográfica.
                    Puede seleccionar cuántos reportes mostrar por página, filtrar por autor, localidad o año de la publicación,
                    además de ordenar, ascendente o descendentemente, por año o autor del reporte.
                </p>
                <p>
                    <span class="dropcap dark">4</span>
                    Ficoflora Venezuela incorpora <b>mapas dinámicos</b> para mostrar la ubicación geográfica de la localidad,
                    desde la entidad federal que es la más amplia, siguiendo en orden descendente por localidades y lugares, hasta la ubicación
                    más específica que es el sitio. Haciendo clic en el nombre de la ubicación o en el icono
                    <img src="{{ asset('img_publicas/poi.png')}}" alt="icono mostrar mapa" title="icono mostrar mapa" /> se muestra el mapa de la misma.
                </p>
                <p>
                    <span class="dropcap dark">5</span>
                    En la sección <b>izquierda</b> se muestra la fotografía principal y enlaces al mapa con la ubicación en Venezuela
                    de la especie, galería fotográfica, opción para exportar a .pdf, lista de especies del género, nueva búsqueda,
                    y sinonimia, si se tienen reportes con esta información.
                <p>
                    <span class="dropcap color3">6</span>
                    La <b>galería</b> incluye fotos de hábito y/o de laboratorio que se pueden ampliar al hacer clic sobre ellas.
                    <br />
                    <span class="caligrafia">¿Tiene fotos que quiere compartir?</span> por favor
                    <a href="{{route('contactos')}}" title="página Contactos" alt="página Contactos">escríbanos</a>,
                    en colaboración podemos suministrar un catálogo lo más completo posible.
                </p>
                <p>
                    <span class="dropcap color2">7</span>
                    La sección de <b>referencias bibliográficas</b> muestra la información de las fuentes en donde se reportan
                    las especies, incluyendo artículos, trabajos académicos y sitios web.
                    Puede indicar cuántas referencias mostrar por página, filtrarlas por autor, año, parte del título, nombre de la
                    revista o cualquier otro dato de la referencia, además de ordenar, ascendente o descendentemente,
                    por año o autor del reporte.
                </p>
                <p>
                    <span class="dropcap color1">8</span>
                    Finalmente, <span class="caligrafia"> SE AGRADECE TODA AYUDA</span> que contribuya a divulgar esta iniciativa
                    y a posicionar al Catálogo Taxonómico Digital Ficoflora Venezuela como una referencia importante en
                    la comunidad científica venezolana, citando adecuadamente el sitio web cuando sea consultado y utilice la
                    información y recursos, sean listas de especies, listas de reportes, fotos o mapas.
                </p>

                <p>&nbsp;
                </p>
                <p>
                    En los reportes encontrados en la bibliografía venezolana, existe amplia variabilidad
                    en cuanto a nombres y sinónimos válidos, así como en autoridades taxonómicas; es por esto que en el interés de
                    homogeneizar al máximo posible la información presentada, todos los nombres y sinónimos taxonómicos válidos, así como
                    las autoridades se han corregido tomando como base lo establecido en el sitio web
                    <a href="http://www.algaebase.org" target="_blank" alt="ir a AlgaEBase"  title="ir a AlgaEBase">AlgaeBase</a>.
                    Además, hemos tratado de homogeneizar hasta donde es posible, la amplia diversidad reportada en localidades, lugares y sitios.

                <br /><br />
                <h4>Guiry, M.D. & G.M. Guiry, 2016</h4>
                <b>Algaebase</b>. Publicación electrónica. National University of Ireland, Galway. Ireland.
                URL: <a href="http://www.algaebase.org" target="_blank" title="Web Algaebase" alt="Web Algaebase">
                    http://www.algaebase.org</a>
                </p>
            </div>

            <div class="row">
                <p>
                    <br /><br />
                    En la siguiente figura puede observarse un ejemplo de nuestra ficha descriptiva de las especies:
                    <br />
                </p>
                <!-- star: photo -->
                <div id="box-center">
                    <div class="box-shadow">
                        <img src="{{ asset('img_publicas/ficofloraVenezuela_ima1.png')}}" alt="Ficha Especie de Ficoflora Venezuela"
                             title="Ficha Especie de Ficoflora Venezuela" class="photo" style="border: 1px #999 solid;" />
                    </div>
                    <p class="fuente"><b>Ficha de la especie <i>Acrochaetium microscopicum</i></b>, Catálogo Taxonómico Digital Ficoflora Venezuela.</span>
                    </p>
                </div>

            </div>
            <!-- end: Species profile -->
        </div>
        <!--end: Container-->
    </div>
    <!--end: Wrapper -->
@stop