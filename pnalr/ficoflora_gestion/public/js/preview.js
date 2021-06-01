/**
 * Created by Lupita on 11/08/2015.
 */


//Llamada a la función preview para mostrar en  Resultados
$(".preview").on('keyup focus', function(){
    setSpan(this);
});

//Cuando seleccionas algun genero de la lista especifique el genero en el arbol
$(".preview").bind('typeahead:select', function () {
    setSpan(this);
});


//Cuando seleccionas algun genero de la lista y actualiza la familia, se especifique la familia en el arbol
// cuando selecciona una familia de la lista,  se especifique la familia en el arbol
$(".select").on('change', function (e) {
    setSpanSelect(this); // por que el setSpan no función con select
});


//Función para hacer el preview en resultado
function setSpan(elem){

    var _this = elem;
    var class_span = '.'+_this.id;
    var contenido = $(_this).val();

    if($(_this).val()){
        $(class_span).parents(".wrap").show();
    }else{
        $(class_span).parents(".wrap").hide();
    }

    $(class_span).html(contenido);
}


//Función para hacer el preview en resultado cuando es un select
function setSpanSelect(elem){
    //console.log(elem);
    var _this = elem;
    var class_span = '.'+_this.id;
    var contenido = $('option:selected', _this).text();
    //console.log(contenido);

    if($(_this).val()){
        $(class_span).parents(".wrap").show();
        console.log('show');

    }else{
        $(class_span).parents(".wrap").hide();
        console.log('hide');

    }

    $(class_span).html(contenido);
}

//Función para hacer el preview en resultado cuando se da el valor
function setSpanText(contenido, class_span){
    //console.log(elem);
    //var _this = elem;
    //var class_span = '.'+_this.id;
    //var contenido = $('option:selected', _this).text();
    console.log(contenido);

    if(contenido){
        $(class_span).parents(".wrap").show();
        console.log('show');

    }else{
        $(class_span).parents(".wrap").hide();
        console.log('hide');

    }

    $(class_span).html(contenido);
}
