@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
            <!-- Add fancyBox -->
    <link rel="stylesheet" href="plugins/fancybox/jquery.fancybox.css" type="text/css" media="screen" />

@stop

@section('content')


    <a class="fancybox" rel="gallery1" href="http://farm1.staticflickr.com/313/19831416459_5ddd26103e_b.jpg" title="Sgwd Ddwli Uchaf, Brecon Waterfalls (technodean2000)">
        <img src="http://farm1.staticflickr.com/313/19831416459_5ddd26103e_m.jpg" alt="" />
    </a>
    <a class="fancybox" rel="gallery1" href="http://farm6.staticflickr.com/5444/17679973232_568353a624_b.jpg" title="Golden Manarola (Sanjeev Deo)">
        <img src="http://farm6.staticflickr.com/5444/17679973232_568353a624_m.jpg" alt="" />
    </a>
    <a class="fancybox" rel="gallery1" href="http://farm8.staticflickr.com/7367/16426879675_e32ac817a8_b.jpg" title="Codirosso spazzacamino (Massimo Greco _Foligno)">
        <img src="http://farm8.staticflickr.com/7367/16426879675_e32ac817a8_m.jpg" alt="" />
    </a>
    <a class="fancybox" rel="gallery1" href="http://farm6.staticflickr.com/5612/15344856989_449794889d_b.jpg" title="Morning Twilight (Jose Hamra Images)">
        <img src="http://farm6.staticflickr.com/5612/15344856989_449794889d_m.jpg" alt="" />
    </a>
@stop

@section('script_section')
    @parent

    <script type="text/javascript" src="plugins/fancybox/jquery.fancybox.js"></script>

    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect	: 'none',
                closeEffect	: 'none'
            });
        });
    </script>
@stop
