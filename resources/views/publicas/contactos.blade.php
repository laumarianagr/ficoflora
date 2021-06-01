@extends('master-publicas')

@section('title')
    <title>Ficoflora Venezuela | Contactos </title>
@stop

@section('css_section')
    @parent
@stop

@section('id-menu')
    <script>
        localStorage.setItem("menu", "m-contactos");
    </script>
@stop


@section('content')

    <!-- start: Wrapper -->
    <div id="wrapper">
        <!-- start: Container -->
        <div class="container">
            <!-- start: Row -->
            <div class="row">

                <!-- start: Contact Info -->
                <div class="col-xlg-3 col-md-3 col-xs-12">
                    <div class="title"><h3>Dirección</h3></div>
                    <p>
                        <br />
                        <b>Universidad Central de Venezuela</b><br />
                        Facultad de Ciencias <br />
                        Avenida Los Ilustres, Los Chaguaramos<br />
                        Caracas - Venezuela<br />
                    </p>
                </div>
                <!-- end: Contact Info -->

                <!-- start: Contact Form -->
                <div class="col-xlg-5 col-md-5 col-xs-12">
                    <div class="title"><h3>Esperamos tu mensaje:</h3></div>
                    <p>
                        <br />
                        <i class="ico-envelope"></i><a href="mailto:santiago.gomez@ciens.ucv.ve" target="_blank">Santiago Gómez: santiago.gomez@ciens.ucv.ve</a>
                        <br />
                        <i class="ico-envelope"></i><a href="mailto:yusneyi.carballo@ciens.ucv.ve" target="_blank">Yusneyi Carballo: yusneyi.carballo@ciens.ucv.ve</a>
                        <br />
                        <i class="ico-envelope"></i><a href="mailto:mayra.garcia@ucv.ve" target="_blank">Mayra García: mayra.garcia@ucv.ve</a>
                        <br />
                        <i class="ico-envelope"></i><a href="mailto:biociencia@gmail.com" target="_blank">Nelson Gil: biociencia@gmail.com</a>
                    </p>

                </div>

                <!-- start photo -->
                <div class="col-xlg-4 col-md-4 col-xs-12">

                    <!-- start: Testimonials-->
                    <div class="testimonial-container">

                        <div class="title"><h3>Venezuela</h3></div>

                        <div class="testimonials-carousel" data-autorotate="3000">

                            <ul class="carousel">

                                <li class="testimonial">
                                    <div class="testimonials">
                                        <!-- start photo -->
                                        <img src="{{ asset('img_publicas/ficofloraVenezuela_foto7.png')}}" alt="Valle Seco, Higuerote"
                                             title="Valle Seco, Higuerote" class="photo" align="center" />
                                        <!-- end: photo -->
                                    </div>

                                    <div class="testimonials-bg"></div>
                                    <div class="testimonials-author"><b>Valle Seco, Higuerote</b>,
                                        Estado Miranda, Venezuela
                                        <br /><span class="fotografo"> | <i class="mini-ico-camera"></i> Santiago Gómez &copy; </span>
                                    </div>
                                </li>

                                <li class="testimonial">
                                    <div class="testimonials">
                                        <!-- start photo -->
                                        <img src="{{ asset('img_publicas/ficofloraVenezuela_foto8.png')}}" alt="Parque Nacional Mochima"
                                             title="Parque Nacional Mochima" class="photo" align="center" />
                                        <!-- end: photo -->
                                    </div>
                                    <div class="testimonials-bg"></div>
                                    <div class="testimonials-author"><b>Parque Nacional Mochima</b>,
                                        <br />Estados Anzoátegui y Sucre, Venezuela
                                        <br /><span class="fotografo"> | <i class="mini-ico-camera"></i> Santiago Gómez &copy; </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <!-- end: photo -->

        </div>
        <!-- end: Row -->

    </div>
    <!--end: Wrapper -->
@stop