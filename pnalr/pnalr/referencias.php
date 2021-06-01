<?php
include ("scripts/sesionIniciar.php");
iniciar();
?>
<!DOCTYPE html>
<html lang="es">
<head>	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <meta name="author" content="Yusneyi Carballo Barrera (CENEAC UCV) :: Santiago Gómez Acevedo (IBE UCV) :: Mayra García Ortíz (FIBV UCV) :: Nelson Gil Luna (IPM JMSM). Adaptation by Yusneyi Carballo Barrera - compuefectiva.com">
    <meta name="description" content="Inventario actualizado y georreferenciado de macroalgas bénticas marinas de Venezuela, incluyendo colecciones de ambientes intermareales y submareales, claves taxonómicas, descripción morfoanatómica y distribución en mapas geográficos." />
    <meta name="keywords" content="ficoflora, macroalgas, algas bénticas, algas marinas, botánica, Los Roques, taxonomía, sistemática de algas, phycoflora, macroalgae, benthic algae, seaweed, botany, taxonomy, systematics of algae, UCV, UPEL." />

    <link rel="icon" type="image/png" href="favicon.ico" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112775031-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-112775031-1');
    </script>

	<title>Proyecto Ficoflora Venezuela :: PNALR</title>
    
<!-- ******************  llamadas a scripts  ***************************** -->
    <!-- includes PHP -->
   <?php   
	 include ("scripts/conexion.php");	include ("scripts/cabecera&Pie.php");	 		
	
abrirConexion();
?>
    
    <!-- jQuery -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="bootstrap_v2.0.2/js/bootstrap.js"></script>  
    <script src="js/functions.js" charset="ISO-8859-1"></script>
    
    <!-- Bootstrap -->
    <link href="bootstrap_v2.0.2/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap_v2.0.2/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap_customYCB.css" rel="stylesheet"> 
    
    
    <!-- Soporte navegadores -->
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- ******************  fin llamadas a scripts  ***************************** -->

</head>
<script>
  $(function () {
    $('.dropdown-toggle').dropdown();
  })
</script>

<body>
	
    <div class="navbar navbar-fixed-top"><?php textoCabecera2("referencias");  // en scripts > cabeceraypie.php ?>
     </div>
    
    <div class="container">
                
      <div class="page-header"> <!-- ******** encabezado de página ******** -->
          <h1>Referencias</h1>
          <p class="smaller">Fuentes bibliográficas, hemerográficas y reportes citados como referencias en el sitio web<br />
            <span class="smaller-en">{ <span id="result_box" lang="en">bibliographical sources, hemerographics and reports cited on website</span></span></p>            
      </div>
      
      <div class="row"> <!-- / *********    sección de contenido  *********** -->
      	<div class="span12">
        
        <?php //recuperando el URL y el ancla 
		
		//parse_url( $url, PHP_URL_QUERY );
		//$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$_SERVER['PHP_URL_FRAGMENT']; 
		//$url = $_SERVER['REQUEST_URI'];
		//echo $url; 
		 ?>
          <ul id="refBiblio">
            <a name="Abbas_Shameel_2009"></a>
            <li><span>Abbas &amp; Shameel (2009) </span><br />
            <strong>Abbas, A. &amp; M.  Shameel. </strong>2009.  Anatomical studies on<em> Colpomenia sinuosa </em>(Phaeophycota) from Karachi  Coast of Pakistan. <strong><em>Pakistan Journal of Botany</em>. 41(4): 1921-1926.</strong>
           <a name="Abbas_Shameel_2010"></a></li> 
            
            
            <li><span>Abbas &amp; Shameel (2010) </span><br />
           <strong>Abbas, A. &amp; M.  Shameel.</strong> 2010.  Anatomical studies on <em>Lobophora variegata</em> (Phaeophycota) from the coast  of Pakistan.<em> <strong>Pakistan Journal of Botany</strong></em><strong>. 42(6): 4169-4176.</strong>
           <a name="Abbott_1999"></a></li> 
            
           
            <li><span>Abbott (1999) </span><br />
            <strong>Abbott, I.A</strong>. 1999. Marine red algae of the Hawaiian  Islands. Honolulu, Hawaii: <strong><em>Bishop Museum Pres</em>s 477 pp.</strong>
             <a name="Abbott_Hollenberg_1976"></a></li> 
            
           
            <li><span>Abbott &amp; Hollenberg (1976) </span><br />
            <strong>Abbott, I.A. &amp;  G.J. Hollenberg. </strong>1976. Marine algae of California. <strong><em>Stanford University Press.  California, USA,</em> 827 pp.</strong>
           <a name="Abbott_etal_2010"></a></li> 
            
            <li><span>Abbott <i>et al.</i> (2010) </span><br />
            <strong>Abbott, I.A., D.L.  Ballantine &amp; D. C. O'Doherty</strong>. 2010. Morphological relationships within the genus <em>Lophocladia</em> (Rhodomelaceae, Rhodophyta) including a description a <em>L. kuesteri</em> sp.  nov. from Hawaii. <strong><em>Phycologia</em> 49(4): 390-401.</strong>
           <a name="Aisha_Shameel_2012"></a></li> 
            
            <li><span>Aisha &amp; Shameel (2012) </span><br />
            <strong>Aisha, K. &amp; M.  Shameel.</strong> 2012.  Taxonomy of the Genus <em>Colpomenia </em>(Laminarophyceae, Phaeophycota) from  the Coast of Karachi.  <strong><em>Proceedings  of Pakistan Academy of Sciences</em>. 49(2): 123-129.</strong>
           <a name="Albis-Salas_Gavio_2011"></a></li> 
            
            <li><span>Albis-Salas &amp; Gavio (2011) </span><br />
            <strong>Albis-Salas, M. R.  &amp; B. Gavio</strong>. 2011. Notes  on marine algae in the International Biosphere Reserve Seaflower, Caribbean  Colombian I: new records of macroalgal epiphytes on the seagrass <em>Thalassia  testudinu</em>. <strong><em>Botanica Marina</em></strong><strong> 54(6): 537-543.</strong> 
            <a name="Albornoz_Ríos_1965"></a></li> 
            
            <li><span>Albornoz &amp; Ríos (1965)</span><br />
            <strong>Albornoz, O. &amp; N. de Ríos</strong>.  1965. Lista de Chlorophyta y Phaeophyta del Archipiélago Los Roques  (Venezuela). <strong><em>Lagena</em> 8:3-2.</strong><br />
            <a href="documents/articulos/Albornoz&Rios1965LosRoques.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a>            <a name="Alves_etal_2009"></a></li> 
            
            <li><span>Alves <i>et al.</i> (2009) </span><br />
           <strong>Alves, A. M., C.W. Do Nascimento Moura, G.L.  Alves &amp; L.M. De Souza Gestinari</strong>. 2009. Os  gêneros <em>Chaetomorpha</em> Kütz. nom. cons. e <em>Rhizoclonium</em> Kütz.  (Chlorophyta) do litoral do Estado da Bahia, Brasil. <strong><em>Revista Brasileira  de Botânica </em>32(3):545-570.</strong>
           <a name="Alves_etal_2011"></a></li> 
            
            <li><span>Alves <i>et al.</i> (2011) </span><br />
            <strong>Alves, A. M., L. M. de Souza Gestinari &amp;  C.W. do Nascimento Moura</strong>. 2011. <em>Microdictyon</em> (Chlorophyta, Anadyomenaceae) do Estado da Bahia, Brasil. <strong><em>Sitientibus  série Ciências Biológicas </em>11(1): 57-61.</strong>
           <a name="Alves_etal_2012"></a></li> 
            
            <li><span>Alves <i>et al.</i> (2012) </span><br />
            <strong>Alves, A. M., L. M. de Souza Gestinari &amp;  C.W. do Nascimento Moura</strong>. 2012. Flora da Bahia: Boodleaceae. <strong><em>Sitientibus  série Ciências Biológicas</em> 12(2):1-23.</strong>
           <a name="Alves_etal_2012a"></a></li> 
            
            <li><span>Alves <i>et al.</i> (2012a) </span><br />
            <strong>Alves, A. M., L. M. de Souza Gestinari, N. A.  de Andrade, W. R. de Almeida &amp; C. W. do Nascimento Moura</strong>.  2012a.<em> Boodlea composita</em> (Harv.) F.Brand (Chlorophyta) no litoral  nordeste do Brasil.<strong> <em>Acta Botanica Brasilica</em> 26(2):476-480.</strong>
           <a name="Alves_etal_2012b"></a></li> 
            
            <li><span>Alves <i>et al.</i> (2012b) </span><br />
            <strong>Alves, A. M., L. M. de Souza Gestinari, I. S.  de Oliveira, K. L. Brito &amp; C. W. do Nascimento Moura</strong>.  2012b. The genus <em>Cladophora</em> (Chlorophyta) in the littoral of Bahia, Brazil. <strong><em>Nova  Hedwigia</em> 95(3-4):337-372.</strong>
           <a name="Alves_etal_2012c"></a> </li> 
            
            <li><span>Alves <i>et al.</i> (2012c) </span><br />
            <strong>Alves, A. M., L. M. de Souza Gestinari &amp;  C. W. do Nascimento Moura</strong>. 2012c. Flora da Bahia:  Siphonocladaceae. <strong><em>Sitientibus série Ciências Biológicas </em>12(2):1-24.</strong>
           <a name="Ardito_Vera_1997"></a></li> 
            
            <li><span>Ardito &amp; Vera (1997) </span><br />
            <strong>Ardito, S. &amp; B. Vera</strong>.  1997. Catálogo de las macroalgas marinas del Herbario Nacional de Venezuela  (VEN). <strong><em>Acta Botanica Venezuelica</em> 20(2):25-108.</strong>
            <br>
            <a href="documents/articulos/ArditoyVera1997Catalogo.PDF" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a> <a name="Ardito_etal_2009"></a></li> 
            
            <li><span>Ardito <i>et al.</i> (2009) </span><br />
           <strong>Ardito, S., D. L. Ballantine, E. Villamizar  &amp; J. G. Rodriguez</strong>. 2009. <em>Corallophila verongiae</em> (Ceramiaceae,  Rhodophyta), a new addition for the benthic marine algae from Venezuela. <strong><em>Acta  Botanica Venezuelica</em> 32(2):467-472.</strong>
           <br>
           <a href="documents/articulos/Arditoetal2009CorallophilaVerongiae.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a> <a name="Athanasiadis_1996"></a></li> 
            
            <li><span>Athanasiadis (1996) </span><br />
            <strong>Athanasiadis, A</strong>. 1996. Morphology and classification of  the Ceramioideae (Rhodophyta) based on phylogenetic principles. <strong><em>Opera  Botanica </em>127:1-221.</strong>
           <a name="Athanasiadis_1998"></a></li> 
            
            <li><span>Athanasiadis (1998) </span><br />
            <strong>Athanasiadis, A</strong>. 1998. <em>Crouanophycus athanasiadis</em> nom. nov. (<em>Crouaniella athanasiadis</em> 1996, nom. illeg.), a new genus of  the Crouanieae (Ceramiales, Rhodophyta). <strong><em>Nova  Hedwigia</em> 67:517-518.</strong>
           <a name="Ávila-Ortiz_etal_2011"></a></li> 
            
            <li><span>Ávila-Ortiz <i>et al.</i> (2011) </span><br />
            <strong>Ávila-Ortiz, A. L. Mateo-Cid &amp; C.  Mendoza-González</strong>. 2011. Caracterización morfológica de <em>Padina boergesenii </em>(Dictyotaceae, Phaeophyceae) en la costa mexicana del  Golfo de México y Mar Caribe. <strong><em>Polibotánica </em>31:1-20.</strong>
           <a name="Ballantine_Aponte_2002"></a></li> 
            
            <li><span>Ballantine &amp; Aponte (2002)</span><br />
            <strong>Ballantine, D. L. &amp; N. E. Aponte</strong>.  2002. <em>Ganonema farinosum</em> and <em>Ganonema dendroideum</em> comb. nov.  (Liagoraceae, Rhodophyta) from Puerto Rico, Caribbean Sea. <strong><em>Cryptogamie Algologie </em>23:211-222.</strong>
           <a name="Ballantine_Wynne_1985"></a></li> 
            
            <li><span>Ballantine &amp; Wynne (1985) </span><br />
            <strong>Ballantine, D. L.  &amp; M. J. Wynne. </strong>1985. <em>Platysiphonia</em> and <em>Apoglossum</em> (Delesseriaceae,  Rhodophyta) in the tropical western Atlantic. <strong><em>Phycologia </em>24:459-465.</strong>
           <a name="Ballantine_Wynne_1986"></a></li> 
            
            <li><span>Ballantine &amp; Wynne (1986) </span><br />
            <strong>Ballantine, D. L.  &amp; M. J. Wynne</strong>. 1986. Notes on the marine algae of Puerto Rico II. Additions of  Ceramiaceae (Rhodophyta), including <em>Ceramium verongiae</em> sp. nov. <strong><em>Botanica  Marina</em> 29:497-502.</strong> 
            <a name="Ballantine_etal_2002"></a></li> 
            
            <li><span>Ballantine <i>et al.</i> (2002) </span><br />
           <strong>Ballantine, D. L., H.  Ruiz &amp; M. J. Wynne</strong>. 2002. Notes on the marine algae of Puerto Rico VII. Seven new records  of benthic Rhodophyta. <strong><em>Caribbean Journal of Science</em> 38:252-256.</strong><a name="Barros-Barreto_Yoneshigue-Valentin_2001"></a>
           </li> 
            
            <li><span>Barros-Barreto &amp; Yoneshigue-Valentin (2001) </span><br />
            <strong>Barros-Barreto, M. B. &amp;  Y. Yoneshigue-Valentin.</strong> 2001. Aspectos morfológicos do genero <em>Ceramium</em> Roth (Ceramiaceae,  Rhodophyta) no Estado do Rio de Janeiro. <strong><em>Hoehnea</em> 28(1):77-110.</strong>
           <a name="Barros-Barreto_etal_2006"></a></li> 
            
            <li><span>Barros-Barreto <i>et al.</i> (2006) </span><br />
            <strong>Barros-Barreto, M. B., L. McIvor, C. A. Maggs  &amp; P. C. G. Ferreira.</strong> 2006. Molecular systematics of <em>Ceramium </em>and <em>Centroceras</em> (Ceramiaceae, Rhodophyta) from Brazil. <strong><em>Journal of Phycology</em> 42:905-921.</strong>
           <a name="Barros-Barreto_etal_2007"></a></li> 
            
            <li><span>Barros-Barreto <i>et al.</i> (2007) </span><br />
           <strong>Barros-Barreto, M. B.,  M. T. Fujii &amp; Y. Yoneshigue-Valentin. </strong>2007. Morphological study of <em>Ceramium clarionense</em> (Ceramiaceae, Rhodophyta) in the Atlantic Ocean. <strong><em>Cryptogamie  Algologie</em> 28(2):129-139.</strong>
           <a name="Belton_etal_2014"></a></li> 
            
            <li><span>Belton <i>et al.</i> (2014) </span><br />
            <strong>Belton, G. S., W. F. Van Reine, J. M. Huisman,  S. G. A. Draisma &amp; C. F. D. Gurgel. </strong>2014. Resolving phenotypic plasticity and species  designation in the morphology challenging <em>Caulerpa racemosa-peltata</em> complex (Caulerpaceae, Chlorophyta). <strong><em>Journal of  Phycology</em> 50(1):32-54.</strong> 
            <a name="Bula-Meyer_1997"></a></li> 
            
            <li><span>Bula-Meyer (1997) </span><br />
            <strong>Bula-Meyer, G. 1997</strong>.  Las especies de <em>Champia</em> (Rhodophyta: Champiaceae) de talo aplanado y una  nueva del Caribe Colombiano. <strong><em>Caldasia</em> 19:83-90.</strong>
           <a name="Cabral de Oliveira_1969"></a></li> 
            
            <li><span>Cabral de Oliveira (1969) </span><br />
            <strong>Cabral de Oliveira, E.</strong> 1969. Algas Marinhas do sul do estado do Espirito Santo (Brasil), I.  Ceramiales. <strong><em>Boletim da Universidade de Sao Paulo, Faculdade de Filosofia,  Ciencias e Letras</em>. 343:1-277.</strong>
           <a name="Cabrera_Alfonso_2010"></a></li> 
            
            <li><span>Cabrera &amp; Alfonso (2010) </span><br />
            <strong>Cabrera, R. &amp; Y. Alfonso</strong>.  2010.  Notas sobre el género<em> Penicillus</em>, (Udoteaceae, Chlorophyta)<br /> para Cuba. <strong><em>Revista del Jardín Botánico Nacional.</em> 30-31:239-244.</strong>
              <a name="Cassano_etal_2009"></a></li> 
              
            <li><span>Cassano <i>et al.</i> (2009) </span><br />
            <strong>Cassano, V., J. Díaz-Larrea, A. Sentíes, M. C.  Oliveira, M. C. Gil-Rodríguez &amp; M. T. Fujii</strong>.  2009. Evidence for the  conspecificity of <em>Palisada papillosa</em> with <em>P. perforata</em> (Ceramiales, Rhodophyta) from the western and eastern Atlantic Ocean on the  basis of morphological and molecular analyses. <strong><em>Phycologia</em> 48(2):86-100.</strong>
           <a name="Cecere_etal_2004"></a></li> 
            
            <li><span>Cecere <i>et al.</i> (2004) </span><br />
            <strong>Cecere, E., A. Petrocelli &amp; M. Verlaque</strong>.  2004. Morphology and  vegetative reproduction of the introduced species <em>Hypnea cornuta</em> (Rhodophyta, Gigartinales) in the Mar Piccolo of Taranto (Italy, Mediterranean  Sea). <strong><em>Botanica Marina</em> 47:381-388.</strong> 
            <a name="Cho_etal_2001"></a></li> 
            
            <li><span>Cho <i>et al.</i> (2001) </span><br />
            <strong>Cho, T. O., S.M. Boo &amp; G. I. Hansen.</strong> 2001. Structure and  reproduction of the genus <em>Ceramium</em> (Ceramiales, Rhodophyta) from Oregon,  USA. <strong><em>Phycologia </em> 40:547-571.</strong>
           <a name="Cho_etal_2003"></a></li> 
            
            <li><span>Cho <i>et al.</i> (2003) </span><br />
           <strong> Cho, T. O., R. Riosmena-Rodríguez &amp; S. M.  Boo</strong>. 2003. First record of <em>Ceramium giacconei </em>(Ceramiaceae,  Rhodophyta) in the North Pacific: developmental morphology of vegetative and  reproductive structures. <strong><em>Botanica Marina</em> 46:548-554.</strong>
           <a name="Cho_etal_2008"></a></li> 
            
            <li><span>Cho <i>et al.</i> (2008) </span><br />
            <strong>Cho, T. O., S. M. Boo,  M. H. Hommersand, C. A. Maggs, L. J. McIvor &amp; S. Fredericq</strong>. 2008.<em> Gayliella</em> gen. nov. in the  tribe Ceramieae (Ceramiaceae, Rhodophyta) based on molecular and morphological  evidence.<strong><em> Journal of Phycology</em> 44:721-738.</strong>
           <a name="Conklin_Sherwood_2012"></a></li> 
            
            <li><span>Conklin &amp; Sherwood (2012) </span><br />
            <strong>Conklin, K. Y. &amp;  A. R. Sherwood</strong>. 2012.  Molecular and morphological variation of the red alga <em>Spyridia filamentosa</em> (Ceramiales, Rhodophyta) in the Hawaiian Archipelago. <strong><em>Phycologia</em> 51(3):347-357.</strong> 
            <a name="Cordeiro-Marino_1978"></a></li> 
            
            <li><span>Cordeiro-Marino (1978) </span><br />
            <strong>Cordeiro-Marino, M</strong>.  1978. Rodofíceas bentonicas marinhas do estado de Santa Catarina. <strong><em>Rickia.</em> 7:1-243.</strong> 
            <a name="Cormaci_Furnari_1991"></a></li> 
            
            <li><span>Cormaci &amp; Furnari (1991) </span><br />
            <strong>Cormaci, M. &amp; G.  Furnari.</strong> 1991. The  distinction of <em>Ceramium giacconei</em> sp. nov. (Ceramiales, Rhodophyta) in  the Mediterranean Sea from <em>Ceramium cingulatum</em>. <strong><em>Cryptogamie  Algologie</em> 12(1):43-53.</strong>
           <a name="Cormaci_Motta_1989"></a></li> 
            
            <li><span>Cormaci &amp; Motta (1989) </span><br />
            <strong>Cormaci, M. &amp; G.  Motta. </strong>1989. Prima  segnalazione di <em>Ceramium cingulatum</em> Weber van Bosse (Rhodophyta,  Ceramiaceae) in Italia e osservazioni sul suo ciclo biologico in coltura. <strong><em>Anales  Jardín Botánico de Madrid </em>46: 55-60.</strong>
           <a name="Cribb_1983"></a></li> 
            
            <li><span>Cribb (1983) </span><br />
            <strong>Cribb, A.B. </strong>1983. Marine algae of the southern Great  Barrier Reef. Part 1. Rhodophyta. <strong><em>Brisbane. Australian Coral Reef  Society, </em>173 pp.</strong>
           <a name="Dawes_Mathieson_2008"></a></li> 
            
            <li><span>Dawes &amp; Mathieson (2008) </span><br />
           <strong>Dawes, C.J.</strong> 1974. Marine algae of the West coast of  Florida. <strong><em>University of Miami Press, Florida,</em> 201 pp.</strong>
           <a name="Dawes_1974"></a></li> 
            
            <li><span>Dawes (1974) </span><br />
            <strong>Dawes, C. J. &amp; A.  C. Mathieson</strong>. 2008. The  seaweeds of Florida. <strong><em>University Press of Florida, Gainesville, FL, USA,</em> 591 pp.</strong>
           <a name="Dawson_1954"></a></li> 
            
            <li><span>Dawson (1954) </span><br />
            <strong>Dawson, E. Y.</strong> 1954. Marine plants in the vicinity of  the Institut Océanographique de Nha Trang, Vietnam. <strong><em>Pacific  Science</em>8:373-469.</strong>
           <a name="De Almeida_etal_2012"></a></li> 
            
            <li><span>De Almeida <i>et al.</i> (2012) </span><br />
            <strong>De Almeida, W. R., A. M. Alves, S. M.  Guimarães &amp; W. C. Do Nascimento Moura</strong>. 2012.  Cladophorales and Siphonocladales (Chlorophyta) from Bisbarras Island, Todos os  Santos Bay, Bahia State, Brasil. <strong><em>Iheringia, Série Botanica, Porto Alegre </em>67(2):149-164.</strong>
             <a name="De Clerck_etal_2002"></a></li> 
            
            <li><span>De Clerck <i>et al.</i> (2002) </span><br />
           <strong>De Clerck, O., H. R.  Engledow, J. J. Bolton, R. J. Anderson &amp; E. Coppejans</strong>. 2002. Twenty marine benthic algae new to  South Africa, with emphasis on the flora of Kwazulu-Natal. <strong><em>Botanica  Marina</em> 45:413-431.</strong>
           <a name="De Clerck_2003"></a></li> 
            
            <li><span>De Clerck (2003) </span><br />
            <strong>De Clerck, O</strong>. 2003. The genus <em>Dictyota</em> in the  Indian Ocean. <strong><em>Opera Botanica Belgica </em>13:1-205.</strong> 
             <a name="De Clerck_etal_2006"></a></li> 
            
            <li><span>De Clerck <i>et al.</i> (2006) </span><br />
           <strong>De Clerck, O., F. Leliaert, H. Verbruggen, C.  Lane, J. C. De Paula, D. Payo &amp; E. Coppejans</strong>.  2006. A revised  classification of the Dictyotaceae (Dictyotales. Phaeophyceae) based on rbcL  and 26S ribosomal DNA sequence analyses. <strong><em>Journal of  Phycology</em> 42:1271-1288.</strong>
           <a name="Dreckmann_Sentíes_2009"></a></li> 
            
            <li><span>Dreckmann &amp; Sentíes (2009) </span><br />
            <strong>Dreckmann, K.  M. &amp; A. Sentíes.</strong> 2009. <em>Gracilaria</em>, Subgenus <em>Textoriella</em> (Gracilariaceae, Rhodophyta) in the Gulf of Mexico and the Mexican Caribbean. <strong><em>Revista  Mexicana de Biodiversidad</em> 80:593- 601.</strong>
           <a name="Fredericq_Hommersand_1989"></a></li> 
            
            <li><span>Fredericq &amp; Hommersand (1989) </span><br />
            <strong>Fredericq, S. &amp; M.  H. Hommersand.</strong> 1989.  Comparative morphology and taxonomic status of <em>Gracilariopsis</em> (Gracilariales, Rhodophyta). <strong><em>Journal of Phycology</em> 25:228-241.</strong>
           <a name="Fujii_etal_2001"></a></li> 
            
            <li><span>Fujii <i>et al.</i> (2001) </span><br />
            <strong>Fujii, M. T., A. L. Cocentino &amp; S. M. B.  Pereira.</strong> 2001. <em>Ceramium nitens</em> (Ceramiaceae, Rhodophyta), an uncommon  species from Brazil.<strong><em>Revista  Brasileira de Botanica, São Paulo</em>, 24(3):359-363.</strong> 
            <a name="Gallagher_Humm_1983"></a></li> 
            
            <li><span>Gallagher &amp; Humm (1983) </span><br />
            <strong>Gallagher, S. B. &amp; H. J. Humm.</strong> 1983. <em>Centroceras  internitens</em> sp. nov.  (Rhodophyceae, Ceramiaceae) from the western tropical North Atlantic ocean. <strong><em>Journal  of Phycology 19:261-268.</em></strong>
           <a name="Ganesan_1989"></a></li> 
            
            <li><span>Ganesan (1989) </span><br />
           <strong>Ganesan, E. K. </strong>1989. A catalog of benthic marine algae  and seagrasses of Venezuela. <strong><em>CONICIT. Fondo  editorial, Caracas, </em>237 pp.</strong> 
           <a name="García_2006"></a></li> 
            
            <li><span>García (2006) </span><br />
            <strong>García, M</strong>. 2006.  Presencia de <em>Hypoglossum hypoglossoides</em> (Stackhouse) F.S. Collins &amp;  Hervey (Ceramiales, Rhodophyta) en la costa venezolana. <strong><em>Acta Botanica  Venezuelica</em> 29(1):165-170.</strong>
            <br>
            <a href="documents/articulos/Garcia2006Hypoglossumhypoglossoides.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a> <a name="García_2008"></a></li> 
            
            <li><span>García (2008) </span><br />
            <strong>García, M</strong>. 2008.  Estudio taxonómico del género <em>Ceramium</em> Roth (Ceramiaceae, Rhodophyta) en  la costa de Venezuela. <strong><em>Tesis Doctoral. Facultad de Ciencias, Universidad  Central de Venezuela. Caracas, Venezuels</em>, 155 pp.</strong>
           <a name="García_Gómez_2004"></a></li> 
            
            <li><span>García &amp; Gómez (2004) </span><br />
            <strong>García, M. &amp; S. Gómez</strong>.  2004. Macroalgas bénticas marinas de la localidad Carmen de Uria, Estado  Vargas, Venezuela.<strong><em> Acta Botanica Venezuelica</em>27(1):43-56.</strong><br />
            <a href="documents/articulos/Garcia&Gomez2004MacroalgasCarmendeUria.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a>
           <a name="García_Gómez_2009a"></a></li> 
            
            <li><span>García &amp; Gómez (2009a) </span><br />
            <strong>García, M. &amp; S. Gómez</strong>.  2009a. Primer registro de <em>Ceramium cingulatum</em> Weber-Van Bosse  (Ceramiaceae, Rhodophyta) para el Océano Atlántico Occidental. <strong><em>Ernstia</em> 19(1):55-65.</strong>
            <br>
            <a href="documents/articulos/Garcia&Gomez2009aCeramiumCingulatum.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a> <a name="García_Gómez_2009b"></a></li> 
            
            <li><span>García &amp; Gómez (2009b) </span><br />
            <strong>García, M. &amp; S. Gómez</strong>.  2009b. Estudio morfológico de <em>Ceramium clarionense</em> Setchell &amp; N.L.  Gardner (Ceramiaceae, Ceramiales, Rhodophyta), una novedad para el mar Caribe. <strong><em>Ernstia</em> 19(2):97-107.</strong>
            <br>
            <a href="documents/articulos/Garcia&Gomez2009bCeramiumClarionense.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a> <a name="García_etal_2008"></a></li> 
            
            <li><span>García <i>et al.</i> (2008) </span><br />
            <strong>García, M., N. Gil &amp; S. Gómez</strong>.  2008. Nuevos registros de <em>Herposiphonia parca</em> y<em> H. arcuata</em> (Rhodomelaceae, Rhodophyta) para la costa de Venezuela. <strong><em>Ernstia</em> 18(1)  2008:59-70.</strong>
            <br>
            <a href="documents/articulos/GarciaGil&Gomez2008Herposiphonia.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a><a name="García_etal_2011"></a></li> 
            
            <li><span>García <i>et al.</i> (2011) </span><br />
            <strong>García, M., S. Gómez &amp; N. Gil</strong>.  2011. Adiciones a la ficoflora marina de Venezuela. II. Ceramiaceae,  Wrangeliaceae y Callithamniaceae (Rhodophyta). <strong><em>Rodriguesia</em> 62(11):35-42.</strong><br>
            <a href="documents/articulos/GarciaGomez&Gil2011CeramiaceaeWrangeliaceaeCallitamniaceaeFicofloraVenezuelaII.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a> <a name="García_etal_2013" id="García_etal_2013"> </a></li> 
            
            <li><span>García <i>et al.</i> (2013) </span><br />
              <strong>García, M., S. Gómez, E. Villamizar &amp; M.  Narváez</strong>. 2013. Adiciones a la Ficoflora Marina de  Venezuela. IV. Bryopsidales (Chlorophyta); Dictyotales (Heterokontophyta) y Ceramiales  (Rhodophyta). <strong><em>Acta Botanica Venezuelica</em> 36(2): en prensa.</strong>
            <a name="Geraldino_etal_2006"></a></li> 
            
            <li><span>Geraldino <i>et al.</i> (2006) </span><br />
            <strong>Geraldino, P. J. L., E. C. Yang &amp; S. M. Boo, S.M.</strong> 2006. Morphology and molecular phylogeny  of&nbsp;<em>Hypnea flexicaulis</em>(Gigartinales, Rhodophyta) from Korea.&nbsp;<strong><em>Algae</em>&nbsp;21(4): 417-423.</strong>
           <a name="Gessner_Hammer_1967"></a> </li> 
            
            <li><span>Gessner &amp; Hammer (1967) </span><br />
            <strong>Gessner. F. &amp; L. Hammer</strong>.  1967 Die litorale algen vegetation an den kusten ost-Venezuela. <strong><em>Internationale Revue der gesamten Hydrobiologie und  Hydrographie. </em>  52:657-692.</strong> 
            <a name="Gestinari_etal_2010"></a></li> 
            
            <li><span>Gestinari <i>et al.</i> (2010) </span><br />
            <strong>Gestinari, L. M.,  S. M. Barreto Pereira &amp; Y.  Yoneshigue-Valentin</strong>. 2010. Distribution of <em>Cladophora</em> Species  (Cladophorales, Chlorophyta) along the Brazilian Coast. <strong><em>Phytotaxa</em> 14:22–42.</strong> 
            <a name="Gómez_1998"></a></li> 
            
            <li><span>Gómez (1998) </span><br />
            <strong>Gómez, S.</strong> 1998.  Rhodophyta (Algas marinas rojas) del Parque Nacional Archipiélago Los Roques. <strong><em>Tesis  Doctoral. Facultad de Ciencias, Universidad Central de Venezuela. Caracas,  Venezuela,</em> 299 pp. </strong>
           <a name="Gómez_etal_2013a"></a></li> 
            
            <li><span>Gómez <i>et al.</i> (2013a) </span><br />
            <strong>Gómez, S., M. García &amp; N. Gil</strong>.  2013a. Adiciones a la ficoflora marina de Venezuela. III. Ceramiales y  Rhodymeniales (Rhodophyta). <strong><em>Rodriguesia </em>64(3):573-580.</strong>
           <a name="Gómez_etal_2013b"></a></li> 
            
            <li><span>Gómez <i>et al.</i> (2013b) </span><br />
            <strong>Gómez, S., M. García &amp; N. Gil</strong>.  2013b. Adiciones a la Ficoflora Marina de Venezuela I. Rhodomelaceae  (Rhodophyta). <strong><em>Acta Botanica Venezuelica</em> 36(2): en prensa.</strong>
           <a name="Gordon-Mills_1987"></a></li> 
            
            <li><span>Gordon-Mills (1987) </span><br />
            <strong>Gordon-Mills, E</strong>.  1987. Morphology and taxonomy of <em>Chondria tenuissima</em> and <em>Chondria  dasyphylla</em> (Rhodomelaceae, Rhodophyta) from European waters. <strong><em>British  Phycology Journal</em> 22:237-255.</strong>
           <a name="Guimarães_etal_2004"></a></li> 
            
            <li><span>Guimarães <i>et al.</i> (2004) </span><br />
           <strong>Guimarães, S.M.P. de B., M.T. Fujii, M.T. Pupo  &amp; N.S. Yokoya</strong>. 2004. Reavaliação das  características morfológicas e suas implicações taxonômicas no gênero <em>Polysiphonia  sensu lato</em> (Ceramiales, Rhodophyta) do litoral dos Estados de São Paulo e  Espírito Santo, Brasil. [An assessment of the morphological characteristics and its taxonomical  implications in the genus <em>Polysiphonia sensu lato</em> (Ceramiales,  Rhodophyta) from the littoral of São Paulo]. <strong><em>Revista  Brasileira de Botânica</em> 27:163-183.</strong> 
           <a name="Gurgel_etal_2003"></a></li> 
            
            <li><span>Gurgel <i>et al.</i> (2003) </span><br />
            <strong>Gurgel, C.F.D., L.M. Liao, S. Fredericq &amp;  M.H. Hommersand</strong>. 2003. Systematics of <em>Gracilariopsis</em> (Gracilariales, Rhodophyta) based on rbcL sequence analyses and morphological  evidence. <strong><em>Journal of Phycology</em> 39:154-171.</strong>
           <a name="Guiry_Guiry_2014"></a></li> 
            
            <li><span>Guiry &amp; Guiry (2014) </span><br />
            <strong>Guiry, M.D. &amp; G. M. Guiry</strong>. 2014. AlgaeBase. World-wide electronic  publication, National University of Ireland, Galway. <strong><em>http://www.algaebase.org</em>;  acceso septiembre 10.</strong>
           <a name="Hammer_Gessner_1967"></a></li> 
            
            <li><span>Hammer &amp; Gessner (1967) </span><br />
            <strong>Hammer, L. &amp; F. Gessner</strong>.  1967. La taxonomía de la vegetación marina en la costa oriental de Venezuela. <strong><em>Boletín  del Instituto Oceanográfico de la Universidad de Oriente, Venezuela </em>6:186-265.</strong>
           <a name="Hayden_etal_2003"></a></li> 
            
            <li><span>Hayden <i>et al.</i> (2003) </span><br />
            <strong>Hayden, H., J.  Blomster, C. Maggs, P. C. Silva, M. Stanhope &amp; J. Waaland</strong>. 2003. Linnaeus was right all along: <em>Ulva</em> and <em>Enteromorpha</em> are not distinct genera. <strong><em>European Journal of  Phycology</em> 38:277-294.</strong>
           <a name="Horta_Oliveira_2001"></a></li> 
            
            <li><span>Horta &amp; Oliveira (2001) </span><br />
            <strong>Horta, P. A. &amp; E.  C. Oliveira. </strong>2001. Some  Delesseriaceae (Ceramiales, Rhodophyta) new to the southwestern Atlantic. <strong><em>Revista  Brasileira de Botânica</em></strong><strong> 24:447-454.&nbsp;</strong> 
            <a name="Huisman_etal_2007"></a></li> 
            
            <li><span>Huisman <i>et al.</i> (2007) </span><br />
            <strong>Huisman, J. M., I. A. Abbott &amp; C. M.  Smith. </strong>2007. Hawaiian  reef plants. <strong><em>Honolulu: A publication of the University of Hawai'i See  Grant College Program, </em>264 pp.</strong> 
            <a name="Itono_1972"></a></li> 
            
            <li><span>Itono (1972) </span><br />
            <strong>Itono, H</strong>. 1972. The genus <em>Ceramium</em> (Ceramiaceae, Rhodophyta) in southern Japan. <strong><em>Botanica  Marina</em> 15:74-86.</strong> 
            <a name="Joly_etal_1956"></a></li> 
            
            <li><span>Joly <i>et al.</i> (1956) </span><br />
            <strong>Joly, A. B., M. Cordeiro, N. Yamaguishi &amp;  Y. Ugadim</strong>. 1966. New marine algae from southern Brazil. <strong><em>Rickia </em>2:159-181.</strong>
           <a name="Kapraun_1980"></a></li> 
            
            <li><span>Kapraun (1980) </span><br />
            <strong>Kapraun, D. F.</strong>  1980. An illustrated guide to the benthic  marine algae of Coastal North Carolina. I. Rhodophyta. <strong><em>The University of North Carolina  Press</em>. 206 pp.</strong>
           <a name="Kapraun_Norris_1982"></a></li> 
            
            <li><span>Kapraun &amp; Norris (1982) </span><br />
            <strong>Kapraun, D. F. &amp;  J. N. Norris.</strong> 1982. The red  algal <em>Polysiphonia</em> Greville (Rhodomelaceae) from Carrie Bow Cay and  vicinity, Belize. In Rützler, K. &amp; Macintyre, I.G. (eds) The Atlantic  Barrier Reef Ecosystem at Carrie Bow Cay, Belize. I. Structure and Communities. <strong><em>Smithsonian Contributions to the Marine Sciences: </em>225-238.</strong>
           <a name="Kim_etal_2006"></a></li> 
            
            <li><span>Kim <i>et al.</i> (2006) </span><br />
            <strong>Kim, M. S., E. C. Yang  &amp; S. M. Boo</strong>. 2006.  Taxonomy and phylogeny of flattened species of <em>Gracilaria </em>(Gracilariceae,  Rhodophyta) from Korea based on morphology and protein-coding plastid rbcL and psbA sequences. <strong><em>Phycologia</em> 45:520-528.</strong>
           <a name="Lee_2006"></a></li> 
            
            <li><span>Lee (2006) </span><br />
            <strong>Lee, Y</strong>. 2006. The genus <em>Martensia</em> Hering  (Delesseriaceae, Rhodophyta) with <em>M. albida sp. nov</em>. and <em>M.  flammifolia sp. nov</em>. on Jeju Island, Korea. <strong><em>Algae</em> 21(1):15-48.</strong>
           <a name="Leliaert_Coppejans_2003"></a></li> 
            
            <li><span>Leliaert &amp; Coppejans (2003) </span><br />
            <strong>Leliaert, F. &amp; E.  Coppejans.</strong> 2003. The  marine species of <em>Cladophora</em> (Chlorophyta) from the South African east  coast. <strong><em>Nova Hedwigia</em> 76(1-2):45-82.</strong>
           <a name="Leliaert_Coppejans_2006"></a></li> 
            
            <li><span>Leliaert &amp; Coppejans (2006) </span><br />
            <strong>Leliaert F. &amp; E. Coppejans</strong>. 2006.&nbsp;<em>Cladophora mamillata</em>&nbsp;(Cladophorophyceae,  Chlorophyta): a little-known algal species from New Caledonia.&nbsp;<strong><em>Belgian Journal of Botany</em>&nbsp;139:  120-123.</strong>
           <a name="Lin_etal_2013"></a></li> 
            
            <li><span>Lin <i>et al.</i> (2013) </span><br />
           <strong>Lin, S. M., W. C.  Yang, J. Huisman, O. De Clerck &amp; W. J. Lee.</strong> 2013. Molecular phylogeny of the widespread <em>Martensia  fragilis</em> complex (Delesseriaceae, Rhodophyta) from the Indo-Pacific region  reveals three new species of <em>Martensia</em> from Taiwan. <strong><em>European  Journal of Phycology</em> 48(2):173-187.</strong>
           <a name="Littler_Littler_1997"></a></li> 
            
            <li><span>Littler &amp; Littler (1997) </span><br />
            <strong>Littler, D.S. &amp;  M.M. Littler</strong>. 1997. An  illustrated marine flora of the Pelican Cays, Belize. <strong><em>Bullletin of the  Biological Society of Washington </em>9:1-149.</strong>
           <a name="Littler_Littler_2000"></a></li> 
            
            <li><span>Littler &amp; Littler (2000) </span><br />
            <strong>Littler, D. S. &amp;  M. M. Littler</strong>.  2000.&nbsp;Caribbean reef plants. An identification guide to the reef plants of  the Caribbean, Bahamas, Florida and Gulf of Mexico. <strong><em>OffShore Graphics,  Inc. Washington, </em>542 pp. </strong>
           <a name="Littler_Littler_2004"></a></li> 
            
            <li><span>Littler &amp; Littler (2004) </span><br />
            <strong>Littler, D. S. &amp;  M. M. Littler</strong>. 2004. <em>Taonia  abbottiana sp. nov.</em> (Dictyotales, Phaeophyceae) from the Tropical Western  Atlantic. <strong><em>Cryptogamie Algologie </em>25(4):419-427.</strong>
           <a name="Lozada-Troche_Ballantine_2009"></a></li> 
            
            <li><span>Lozada-Troche &amp; Ballantine (2009) </span><br />
            <strong>Lozada-Troche, C. &amp; D. L. Ballantine</strong>.  2009. <em>Champia puertoricensis</em> (Rhodophyta: Champiaceae) from Puerto Rico,  Caribbean Sea. <strong><em>Botanica Marina</em> 53(2):131-141.</strong> 
            <a name="Lozada-Troche_Ballantine_2010"></a></li> 
            
            <li><span>Lozada-Troche &amp; Ballantine (2010) </span><br />
            <strong>Lozada-Troche, C.  &amp; D. L. Ballantine. </strong>2010. Observations on morphology and the taxonomic affiliation of <em>Coelothrix  irregularis</em> (Harv.) Borgesen (Rhodymeniales, Rhodophyta). <strong><em>Caribbean  Journal of Science</em> 46(1):71-82.</strong>
           <a name="Maggs_Hommersand_1993"></a></li> 
            
            <li><span>Maggs &amp; Hommersand (1993) </span><br />
           <strong>Maggs, C. A. &amp; M.  H. Hommersand.</strong> 1993.  Seaweeds of the British Isles. Volume 1. Rhodophyta. Part 3A. Ceramiales. <strong><em>London:  HMSO</em>, 444 pp.</strong>
           <a name="Mamoozadeh_Freshwater_2011"></a></li> 
            
            <li><span>Mamoozadeh &amp; Freshwater (2011) </span><br />
            <strong>Mamoozadeh, N. R.  &amp; D. W. Freshwater</strong>. 2011. Taxonomic notes on Caribbean <em>Neosiphonia</em> and <em>Polysiphonia</em> (Ceramiales, Florideophyceae): five species from Florida, USA and Mexico. <strong><em>Botanica  Marina </em>54(3):269-292.</strong>
           <a name="Mamoozadeh_Freshwater_2012"></a></li> 
            
            <li><span>Mamoozadeh &amp; Freshwater (2012) </span><br />
           <strong>Mamoozadeh, N. R.  &amp; D. W. Freshwater</strong>. 2012. <em>Polysiphonia</em> sensu lato (Ceramiales, Florideophyceae)  species of Caribbean Panama including <em>Polysiphonia lobophorali</em>s <em>sp. nov</em>. and <em>Polysiphonia nuda</em> sp. nov. <strong><em>Botanica Marina</em> 55(4):317-347.</strong>
           <a name="Martin-Lescanne_etal_2010"></a></li> 
            
            <li><span>Martin-Lescanne <i>et al.</i> (2010) </span><br />
            <strong>Martin-Lescanne, J.,  F. Rousseau, B. De Reviers, C. Payri, A. Coulouxm, C. Cruaud &amp; L. Le Gall</strong>. 2010. Phylogenetic analyses of the <em>Laurencia</em> complex (Rhodomelaceae, Ceramiales) support recognition of five genera: <em>Chondrophycus</em>, <em>Laurencia</em>, <em>Osmundea</em>, <em>Palisada</em> and <em>Yuzurua</em> stat.  nov.<strong><em> European Journal of Phycology</em> 45(1):51-61.</strong>
           <a name="Masuda_Kogame_2000"></a></li> 
            
            <li><span>Masuda &amp; Kogame (2000) </span><br />
            <strong>Masuda, M. &amp; K.  Kogame.</strong> 2000. <em>Herposiphonia  elongata</em> sp. nov. and <em>H. tenella</em> (Rhodophyta, Ceramiales) from the  western Pacific. <strong><em>Cryptogamie Algologie</em> 21:177-189.</strong>
           <a name="Mateo-Cid_2006"></a> </li> 
            
            <li><span>Mateo-Cid (2006) </span><br />
            <strong>Mateo-Cid, L.</strong>. 2006. Estudio taxonómico de los géneros <em>Neogoniolithon, Spongites</em> y <em>Neophyllum</em> (Corallinales, Rhodophyta) en la costa del Atlántico de México. <strong><em>Tesis Doctoral, Universidad autónoma unidad de Iztapalapa. México, DF,</em> 167 pp.</strong>
           <a name="Mateo-Cid_etal_2013"></a></li> 
                       
            <li><span>Mateo-Cid <i>et al.</i> (2013) </span><br />
            <strong>Mateo-Cid, L., A. Mendoza-González, L.  Aguilar-Rosas &amp; R. Aguilar-Rosas</strong>. 2013. Occurrence and distribution of the  genus <em>Jania</em> J. V. Lamouroux (Corallinales, Rhodophyta) in the Pacific  Coast of Baja California and Gulf of California, Mexico. <strong><em>American Journal  of Plant Sciences</em> 4(12B):1-13.</strong>
           <a name="Mendoza-González_etal_2009"></a></li> 
            
            <li><span>Mendoza-González <i>et al.</i> (2009) </span><br />
            <strong>Mendoza-González, C.,  F. Pedroche &amp; L. E.&nbsp;Mateo-Cid</strong>. 2009. The genus <em>Hydrolithon foslie</em> (Corallinales, Rhodophyta) along the Atlantic and Caribbean coasts of Mexico. <strong><em>Gayana  Botanica</em> 66(2):218-238.</strong>
           <a name="Nam_1999"></a></li> 
            
            <li><span>Nam (1999) </span><br />
            <strong>Nam, K. W</strong>. 1999. Morphology of <em>Chondrophycus  undulata</em> and<em> C. parvipapillata</em> and its implications for the taxonomy  of the <em>Laurencia</em> (Ceramiales, Rhodophyta) complex. <strong><em>European  Journal of Phycology</em> 34:455-468.</strong>
           <a name="Norris_1991"></a></li> 
            
            <li><span>Norris (1991) </span><br />
            <strong>Norris, R. E</strong>. 1991. Some unusual marine red algae  (Rhodophyta) from South Africa. <strong><em>Phycologia</em> 30:582-596.</strong>
           <a name="Norris_1993"></a></li> 
            
            <li><span>Norris (1993) </span><br />
            <strong>Norris, R. E.</strong> 1993. Taxonomic studies on Ceramiaceae  (Ceramiales, Rhodophyta) with predominantly basipetal growth of corticating  filaments. <strong><em>Botanica Marina</em>  36:389-398.</strong> 
            <a name="Nunes_Paula_2000"></a></li> 
            
            <li><span>Nunes &amp; Paula (2000) </span><br />
            <strong>Nunes, J. &amp; E. de Paula</strong>.  2000. Estudos taxonómicos do género <em>Padina</em> Adanson  (Dictyotaceae-Phaeophyta) no litoral do estado da Bahia, Brasil. <strong><em>Acta Botanica Malacitana</em> 25:21-43.</strong> 
            <a name="Nunes_Paula_2001"></a></li> 
            
            <li><span>Nunes &amp; Paula (2001) </span><br />
            <strong>Nunes, J. &amp; E. de Paula</strong>.  2001. O género <em>Dictyota </em>lamouroux (Dictyotaceae-Phaeophyta) no litoral  do estado da Bahia, Brasil. <strong><em>Acta  Botanica Malacitana</em> 26:5-18.</strong> 
            <a name="Oliveira-Filho_1969"></a></li> 
            
            <li><span>Oliveira-Filho (1969) </span><br />
            <strong>Oliveira Filho, E. C. de.</strong> 1969. Algas marinhas do sul do Estado do Espírito Santo (Brasil) I. Ceramiales. <strong><em>Boletim da Faculdade de Filosofia, Ciências e Letras, Universidade de São  Paulo. Botânica</em>26:1-278.</strong>
           <a name="Penrose_Chamberlan_1993"></a></li> 
            
            <li><span>Penrose &amp; Chamberlan (1993) </span><br />
            <strong>Penrose, D. &amp; Y.  M. Chamberlain</strong>. 1993. <em>Hydrolithon  farinosum</em> (Lamouroux) comb. nov.: implications for generic concepts in the  Mastophoroideae (Corallinaceae, Rhodophyta). <strong><em>Phycologia</em> 32:295-303.</strong>
           <a name="Phaik-Eem_etal_2007"></a></li> 
            
            <li><span>Phaik-Eem <i>et al.</i> (2007) </span><br />
           <strong>Phaik-Eem, L., M.  Sakaguchi, T. Hanyuda, K. Kogawe, S. Phang &amp; H. Kawai</strong>. 2007. Molecular phylogeny of crustose  brown algae (Ralfsiales, Phaeophyceae) inferred from rbcL sequences resulting  in the proposal for Neoralfsiaceae fam. nov. <strong><em>Phycologia</em> 46(4):456-466.</strong>
           <a name="Riosmena-Rodríguez_etal_2009"></a></li> 
            
            <li><span>Riosmena-Rodríguez <i>et al.</i> (2009) </span><br />
            <strong>Riosmena-Rodriguez, R., L. Paul-Chávez, G. Hernández-Carmona,  J. López-Vivas &amp; M. Casas-Valdez</strong>. 2009. Taxonomic reassessment of the genus <em>Padina </em>(Dictyotales, Phaeophyta) from the Gulf of California. <strong><em>Algae</em> 24(4):213-229.</strong>
           <a name="Robinson_etal_2012"></a></li>      
            
            <li><span>Robinson <i>et al.</i> (2012) </span><br />
            <strong>Robinson, N., C. Galicia-García &amp; Y.  Okolodkov</strong>. 2012.   New records of green (Chlorophyta) and brown algae (Phaeophyceae) for  Cabezo Reef, National Park Sistema Arrecifal Veracruzano, Gulf of Mexico.  <strong><em>Acta Botanica Mexicana</em> 101:11-48.</strong>
           <a name="Rodríguez_1972"></a></li>                 
               
            <li><span>Rodríguez (1972) </span><br />
           <strong>Rodríguez de Rios, N. </strong>1972.  Contribución al estudio sistemático de las algas macroscópicas de la costa de  Venezuela .<strong><em>Acta Botanica Venezuelica</em>&nbsp;7:219-324.</strong>
           <a name="Rodríguez_1981"></a></li> 
                        
            <li><span>Rodríguez (1981) </span><br />
            <strong>Rodríguez  de Ríos, N.</strong> 1981<strong>.</strong> Dos especies nuevas de <em>Laurencia</em> (Rhodophyta, Ceramiales). <strong><em>Ernstia</em> 2:1-20.</strong> <br />
            <a href="documents/articulos/RodriguezDeRios1981LaurenciafoldatsiiyLbolivarii.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a>
           <a name="Rodríguez_Saito_1985"></a></li> 
            
            <li><span>Rodríguez (1985) </span><br />
            <strong>Rodríguez de Ríos, N. &amp; Y. Saito</strong>. 1985. <em>Laurencia scoparia</em> J.  Agardh, nuevo sinónimo de <em>Laurencia filiformis</em> (C. Agardh) Montagne  (Rhodophyta, Ceramiales).<strong> <em>Ernstia</em> 2:19-28.</strong>
           <a name="Rodríguez,_1986b"></a></li> 
            
            <li><span>Rodríguez (1986b) </span><br />
            <strong>Rodríguez de Ríos, N</strong>. 1986b. El género <em>Polycarvernosa</em> Chang y Xia (Gracilariaceae, Rhodophyta) en Venezuela, con descripción de una  nueva especie. <strong><em>Ernstia</em> 38:12-31.</strong>
           <a name="Rodríguez_Saito_1972"></a></li>   
               
            <li><span>Rodríguez &amp; Saito (1985) </span><br />
            <strong>Rodríguez de Ríos, N. &amp; Y. Saito. </strong>1985. <em>Laurencia scoparia</em> J. Agardh, nuevo sinónimo de <em>Laurencia filiformis</em> (C. Agardh) Montagne (Rhodophyta, Ceramiales).<strong><em>&nbsp;Ernstia</em>&nbsp;2:19-28.</strong>
           <a name="Rojas-González_Afonso-Carrillo_2002"></a></li> 
                        
            <li><span>Rojas-González &amp; Afonso-Carrillo (2002) </span><br />
            <strong>Rojas-Gonzalez, B. &amp; J. Afonso-Carrillo</strong>.  2002. Morfología y distribución de<em> Lophosiphonia cristata</em> y<em> L.  reptabunda</em> en las islas Canarias (Rhodophyta, Rhodomelaceae).<strong> <em>Vieraea</em> 30:31-44.</strong>
           <a name="Rojas-González_Afonso-Carrillo_2008"></a></li> 
            
            <li><span>Rojas-González &amp; Afonso-Carrillo (2008) </span><br />
            <strong>Rojas-González, B. &amp; J. Afonso-Carrillo</strong>.  2008. Morfología y distribución de las especies de <em>Polysiphonia</em> en las  Islas Canarias. 3. <em>Polysiphonia ceramiaeformis</em>, <em>P. denudata</em>, <em>P.  furcellata</em> y <em>P. tepida</em> (Rhodophyta, Rhodomelaceae). <strong><em>Vieraea</em>36:55-71.</strong> 
            <a name="Sansón_Reyes_1996"></a></li> 
            
            <li><span>Sansón &amp; Reyes (1996) </span><br />
            <strong>Sansón, M. &amp; J. Reyes, J</strong>.  1996. Sobre la morfología de <em>Spyridia filamentosa</em> y <em>Spyridia hypnoides</em> en las islas Canarias (Rhodophyta, Ceramiaceae)<strong><em>Vierae</em>&nbsp;25, 37-44.</strong>
           <a name="Sansón_Reyes_2006"></a></li> 
            
            <li><span>Sansón <i>et al.</i> (2006)</span><br />
            <strong>Sansón, M., M. J. Martin &amp; J. Reyes, J</strong>.  2006. Vegetative and reproductive morphology of&nbsp;<em>Cladosiphon contortus,  C. occidentalis</em>&nbsp;and&nbsp;<em>C. cymodoceae</em>&nbsp;sp. nov.  (Ectocarpales, Phaeophyceae) from the Canary Islands. <strong><em>Phycologia</em>&nbsp;45: 529-545.</strong>
           <a name="Santelices_Hommersand_1997"></a></li> 
                        
            <li><span>Santelices &amp; Hommersand (1997) </span><br />
            <strong>Santelices, B. &amp;  M. Hommersand</strong>. 1997.<em> Pterocladiella</em>, a new genus in the Gelidiaceae (Gelidiales, Rhodophyta). <strong><em>Phycologia</em> 36:114-119.</strong>
           <a name="Schneider_Lane_2007"></a></li> 
            
            <li><span>Schneider &amp; Lane (2007) </span><br />
           <strong> Schneider, C.W. &amp;  C.E. Lane.</strong>2007. Notes on  the marine algae of the Bermudas. 8. Further additions to the flora, including <em>Griffithsia  aestivana</em> sp. nov. (Ceramiaceae, Rhodophyta) and an update on the alien <em>Cystoseira  compressa</em> (Sargassaceae, Heterokontophyta).<strong><em> Botanica Marina</em>50:128-140.</strong>
           <a name="Schneider_Searles_1991"></a></li> 
            
            <li><span>Schneider &amp; Searles (1991) </span><br />
            <strong>Schneider, C. W. &amp;  R. B. Searles.</strong> 1991.  Seaweeds of the southeastern United States. Cape Hatteras to Cape Canaveral. <strong><em>Durham  &amp; London: Duke University Press</em>, 553 pp.</strong>
            <a name="Schneider_Searles_1997"></a></li>           
            
            <li><span>Schneider &amp; Searles (1997) </span><br />
            <strong>Schneider, C. W. &amp;  R. B. Searles. </strong>1997. Notes on  the marine algae of the Bermudas. 2. Some Rhodophyta, including <em>Polysiphonia  tongatensis</em> and a discussion on the <em>Herposiphonia secunda/tenella</em> complex. <strong><em>Cryptogamie Algologie, </em>187-210.</strong>
           <a name="Schneider_Searles_1998"></a></li> 
            
            <li><span>Schneider &amp; Searles (1998) </span><br />
            <strong>Schneider, C. W. &amp;  R. B. Searles</strong>. 1998. Notes  on the marine algae of the Bermudas. 4. Additions to the flora, including <em>Polysiphonia  plectocarpa</em> sp. nov. <strong><em>Phycologia </em>37:24-33.</strong>
           <a name="Sentíes_etal_2009"></a></li> 
            
            <li><span>Sentíes <i>et al.</i> (2009) </span><br />
            <strong>Sentíes, A., J. Díaz-Larrea, V. Cassano, M. C.  Gil-Rodríguez &amp; M. T. Fujii.</strong> 2009.<em> Palisada perforata </em>(Rhodomelaceae, Ceramiales) en el Caribe mexicano.<strong> <em>Revista  Mexicana de Biodiversidad</em> 80:7-12.</strong>
           <a name="Soares_2005"></a></li> 
            
            <li><span>Soares (2005) </span><br />
            <strong>Soares, D</strong>. 2005. Estudos  taxonômicos do gênero <em>Chondria</em> (Ceramiales, Rhodophyta) no litoral dos estados de São Paulo e Espírito Santo,  Brasil. <strong><em>Thesis Mestre em Biodiversidade Vegetal e Meio Ambiente,  Instituto de Botânica da Secretaria do Meio Ambiente, São Paulo, Brasil</em>, 114  pp.</strong>
           <a name="Solé_2003"></a></li> 
            
            <li><span> </span><span>Solé (2003) </span><br />
            <strong>Solé, M. A</strong>. 2003. <em>Dictyota  hamifera</em> Setchell (Dictyotales, Phaeophyceae): New record for the  Venezuelan Caribbean marine flora. <strong><em>Caribbean Journal of Science</em> 39(2):227–229.</strong>
            <br>
            <a href="documents/articulos/Sole2003DictyotaHamifera.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a><a name="Solé_etal_1999"></a></li> 
            
            <li><span>Solé <i>et al.</i> (1999) </span><br />
           <strong>Solé, M. A., E.  Foldats, B. Vera &amp; S. Gómez</strong>. 1999. Nuevos registros para el Caribe  Venezolano y el Atlántico del género <em>Dictyota</em> (Dictyotales,  Phaeophyceae). <strong><em>Fundación La Salle de Ciencias Naturales</em> 151:133-148.</strong>
           <br>
           <a href="documents/articulos/SoleVeraFoldats&Gomez1999DictyotacrispatayDcanaliculata.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a> <a name="South_Skelton_2000"></a></li> 
            
            <li><span>South &amp; Skelton (2000) </span><br />
            <strong>South, G.R. &amp; P.A. Skelton.</strong> 2000. A review of <em>Ceramium </em>(Rhodophyceae, Ceramiales) from Fiji and Samoa, South Pacific.<strong><em> Micronesica</em> 33:45-98.</strong>
           <a name="Stegenga_etal_1997"></a></li> 
            
            <li><span>Stegenga <i>et al.</i> (1997) </span><br />
            <strong>Stegenga, H., J. J.  Bolton &amp; R. J. Anderson. </strong>1997. Seaweeds of the South African west coast. Cape Town: <strong><em>Bolus  Herbarium, University of Cape Town, </em>655 pp.</strong>
           <a name="Taylor_1928"></a></li> 
            
            <li><span>Taylor (1928) </span><br />
            <strong>Taylor, W. R.</strong> 1928. The marine algae of Florida with  special reference to the Dry Tortugas. <strong><em>Publications of the Carnegie  Institution of Washington,</em> 379 pp.</strong>
           <a name="Taylor_1960"></a></li> 
            
            <li><span>Taylor (1960) </span><br />
            <strong>Taylor, W. R.</strong> 1960.&nbsp;Marine algae of the eastern  tropical and subtropical coasts of the Americas. <strong><em>The University of  Michigan Press, Ann Arbor, Michigan,</em> 870 pp.</strong>
           <a name="Taylor_1976"></a></li> 
            
            <li><span>Taylor (1976) </span><br />
            <strong>Taylor, W. R.</strong> 1976. A check-list of Venezuelan marine  algae. <strong><em>Boletín de la Sociedad Venezolana de Ciencias  Naturales</em> 22(132/133):71-101.</strong>
           <a name="Tittley_etal_2009"></a></li> 
            
            <li><span>Tittley <i>et al.</i> (2009) </span><br />
            <strong>Tittley, I., A. I. Neto &amp; M. I. Parente</strong>.  2009. The marine algal  (seaweed) flora of the Azores: additions and amendments 3. <strong><em>Botanica  Marina</em> 52:7-14.</strong>
           <a name="Van den heede_Coppejans_1996"></a></li> 
            
            <li><span>Van den heede &amp; Coppejans (1996) </span><br />
            <strong>Van den heede, C.  &amp; E. Coppejans</strong>. 1996. The genus <em>Codium</em> (Chlorophyta, Codiale) from Kenya,  Tanzania (Zanzibar) and the Seychelles.<strong></strong><strong><em>Nova  Hedwigia </em>62(3-4):389-417.</strong>
           <a name="Vera_1993"></a></li>             
            
            <li id="Vera_1993"><span>Vera (1993) </span><br />
            <strong>Vera, B</strong>. 1993.  Contribución al conocimiento de las macroalgas asociadas a las praderas de <em>Thalassia  testudinum</em> könig. <strong><em>Acta Botanica Venezuelica</em> 16(2-4): 19-28.</strong>
            <br>
            <a href="documents/articulos/Vera1993MacroalgasThalassia.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo </a><a name="Vera_etal_2011"></a></li>             
           
            <li><span>Vera <i>et al.</i> (2011) </span><br />
            <strong>Vera, B., C. Paz &amp; J. Linares.</strong> 2011. Nuevos registros del género <em>Anadyomene</em> J.V. Lamouroux  (Anadyomenaceae, Chlorophyta) para el mar Caribe. <strong><em>Acta Botanica Venezuelica</em> 34(1):105-111.</strong>
            <br>
            <a href="documents/articulos/VeraPaz&Linares2011Anadyomene.pdf" title="ver artículo" target="_blank"><img src="images/ico_pdf_pq.png" alt="artículo" width="22" height="24" align="baseline"> ver artículo</a> <a name="Woelkerling_Harvey_2012"></a> </li> 
            
            <li><span>Woelkerling &amp; Harvey (2012) </span><br />
            <strong>Woelkerling, W. J.  &amp; A. Harvey</strong>. 2012.  Lectotypification and epitypification of the type species of <em>Amphiroa, A.  tribulus</em> (Lithophylloideae, Corallinaceae, Rhodophyta). <strong><em>Phycologia</em> 51(1):113-117.</strong>
           <a name="Won_etal_2009"></a></li> 
            
            <li><span>Won <i>et al.</i> (2009) </span><br />
            <strong>Won, B. Y., T.O. Cho  &amp; S. Fredericq. </strong>2009. Morphological and molecular characterization of species of the  genus <em>Centroceras</em> (Ceramiaceae, Ceramiales), including two new species. <strong><em>Journal  of Phycology </em>45:227-250.</strong>
           <a name="Won_2010"></a></li>       
                  
            <li><span>Won (2010) </span><br />
            <strong>Won, B. Y. </strong>2010. Characterization of <em>Centroceras  gasparrinii</em> (Ceramiaceae, Rhodophyta), known as <em>Centroceras clavulatum</em>. <strong><em>Algae</em> 25(2):71-76.</strong>
           <a name="Wynne_2011"></a></li> 
            
            <li><span>Wynne (2011) </span><br />
            <strong>Wynne, M. J.</strong> 2011. A checklist of benthic marine algae  of the tropical and subtropical Western Atlantic: third revision. <strong><em>Nova  Hedwigia Beiheft </em>140. 166 pp.</strong>
           <a name="Wynne_Ballantine_1986"></a></li> 
            
            <li><span>Wynne &amp; Ballantine (1986) </span><br />
            <strong>Wynne, M. J. &amp; D.  L. Ballantine.</strong> 1986. The  genus<em> Hypoglossum</em> Kützing (Delesseriaceae, Rhodophyta) in the tropical  western Atlantic, including <em>H. anomalum</em> sp. nov. <strong><em>Journal of  Phycology</em> 22:185-193.</strong>
           <a name="Wynne_Norris_1976"></a></li> 
            
            <li><span>Wynne &amp; Norris (1976) </span><br />
            <strong>Wynne, M. &amp; J.  Norris</strong>. 1976. The  genus <em>Colpomenia</em> Derbes et Solier (Phaeophyta) in the Gulf of  California. <strong><em>Smithsonian Contributions of Botany</em> 35:1-18.</strong>
           <a name="Yamagishi_Masuda_2000"></a></li> 
            
            <li><span>Yamagishi &amp; Masuda (2000) </span><br />
            <strong>Yamagishi, Y. &amp; M.  Masuda</strong>. 2000. A  taxonomic revision of a Hypnea <em>charoides-valentiae</em> complex (Rhodophyta, Gigartinales) in Japan, with a description of <em>Hypnea  flexicaulis sp. nov</em>. <strong><em>Phycological Research</em> 48:27-36.</strong>
            </li> 
          </ul>
        </div>             
      </div>   <!-- /row sección de contenido  --> 
       
          <footer><hr />
          <?php textoPie();  // en scripts > cabeceraypie.php    css: bootstrap_customYCB  ?>
          </footer><!-- /hero-footer -->       
      </div> <!-- /container -->     
       
</body>
</html> 
<?php  cerrarConexion(); /* se cierra la conexion  */ ?>