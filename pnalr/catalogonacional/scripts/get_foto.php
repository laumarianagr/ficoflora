<?php 
/* mostra una foto y sus créditos según parámetros */

function mostrarFoto($foto, $fuente, $credito){
// muestra una foto en la página
    ?>
    <div class="row">
        <!-- start photo -->
        <div class="box-shadow">
             <img src="<?php echo $foto;?>" alt="" title="" class="photo" />
        </div>
        <p class="fuente"><?php echo $fuente;?>a
        <span class="fotografo">| <i class="mini-ico-camera"></i> <?php echo $credito;?> </span></p>
    </div>
<?php
} //end function
?>