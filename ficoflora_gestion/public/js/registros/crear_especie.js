/**
 * Created by maria-pinzon on 04/06/2015.
 */

$(document).ready(function() {


    //Cuando seleccionas algun genero de la lista y actualiza la familia, se especifique la familia en el árbol
    // cuando selecciona una familia de la lista,  se especifique la familia en el árbol
    $("#familia.select").on('change', function (e) {
        getTaxonomia($(this).val()); // Hace la llamada para buscar en la BD el árbol taxonómico
    });


    //Trae los datos para llenar el árbol taxonómico de Resultado al seleccionar una familia de la lista
    function getTaxonomia(id_elem){
        $.ajax({
            type: "get",
            url: root_url+'familia/'+id_elem+'/taxonomia',
            data: {},
            success: function (data) {
                setTaxonomia(data); //Se muestran los valores en Resultado
            },
            error: function ( response, json, errorThrown ) {
                var errors = response.responseJSON;
                console.log(errors);
                console.log(response.responseText);
            }
        });
    }

    // Despliega los datos del árbol taxonómico en Resultados
    function setTaxonomia(data){
        $.each(data, function(key, value) {

            var class_span = '.'+key;

            if(value != null){
                $(class_span).parents(".wrap").show();
            }else{
                $(class_span).parents(".wrap").hide();
            }

            $(class_span).html(value);
        });
    }
});