/**
 * Created by Lupita on 24/08/2015.
 */

//Guarda los datos de autocompletar de la taxonomia superior
var datos = false,
    taxo;

    //----------------------------------------
    //FORMULARIO DE REGISTRO DE NUEVA taxonomias
    //--------------------------------------------

    //Se piden los datos para el autocompletar del formulario tipo modal de  familia, genero,  ....
    $(".get_typeahead-datos").click(function() {

        getTaxoNombre(this);

        if (!datos) { //Validacion para que solo se pidan una vez los datos
            $.ajax({
                type: "get",
                url: root_url + 'taxonomia/' + taxo,
                data: {},
                success: function (data) {

                    console.log('get_typeahead-datos');
                    datos = true;//para pedirlos una sola vez
                    setTypeaheadDatos( data);//llena el arreglo taxonomia para la funciones de typeahead con los datos

                },
                error: function (response, json, errorThrown) {
                    var errors = response.responseJSON;
                    console.log(errors);
                    console.log(response.responseText);
                }
            });
        }
    });

    function getTaxoNombre(elem_this){
        var id_elem = $(elem_this).attr('id');

        switch (id_elem){
            case 'nuevo-genero':
                taxo = 'genero';
                break;

            case 'nueva-familia':
                taxo = 'familia';
                break;

            case 'nuevo-orden':
                taxo = 'orden';
                break;

            case 'nueva-subclase':
                taxo = 'subclase';
                break;

            case 'nueva-clase':
                taxo = 'clase';
                break;

            case 'nuevo-phylum':
                taxo = 'phylum';
                break;

        }
        console.log(id_elem, taxo);
    }


$(".set-taxo").click(function() {

    var id_elem = $(this).attr('id');
    switch (id_elem){
        case 'nuevo-genero':
            taxo = 'genero';
            break;
    }

});


    function setTypeaheadDatos(data){

        taxonomia.phylum = data.phylum;
        phylum.add(data.phylum);

        if(taxo != 'phylum'){
            taxonomia.clase = data.clase;
            clase.add(data.clase);

            if(taxo != 'clase'){
                taxonomia.subclase = data.subclase;
                subclase.add(data.subclase);

                if(taxo != 'sublcase'){
                    taxonomia.orden = data.orden;
                    orden.add(data.orden);

                    if(taxo != 'orden'){
                        taxonomia.familia = data.familia;
                        familia.add(data.familia);

                        if(taxo != 'familia'){
                            taxonomia.genero= data.genero;
                            genero.add(data.genero);
                        }
                    }
                }
            }
        }
    }


    //Procesa el formulario de nueva familia, genero,  ....
    $('.jv_taxonomia').submit(function(e){

        e.preventDefault();

        var validated = $('.jv_taxonomia').valid();
        var action = $(this).attr('action');
        var postData = $(this).serializeArray();

        if(validated) {

            $.ajax({
                type: "post",
                url:action,
                data: postData,
                beforeSend: function(){
                    $('#nueva_taxonomia').prop( "disabled", true );

                },

                success: function (data) {
                    console.log(data);

                    nuevaOpcionSelect(data);

                    $.magnificPopup.close();

                    toastr.success( "Registro creado correctamente" , "¡Listo!");
                },

                error: function ( response, json, errorThrown ) {
                    var errors = response.responseJSON;
                    var errorsHtml = '';

                    console.log(errors);
    //                        console.log(response.responseText, response.status);


                    $.each( errors, function( key, value ) {
                        //                                errorsHtml += '<li>' + value[0] + '</li>';
                        errorsHtml += value[0] + '</br>';
                        console.log(value[0]);
                    });
                    //                            toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                    toastr.error( errorsHtml , "¡Error!");
                },
                complete: function(){
                    $('#nueva_taxonomia').prop( "disabled", false );

                }
            });
        }

    });


    function nuevaOpcionSelect(data){

        var $id_elem ='#'+taxo+'.select' //$("#familia.select") o $("#genero.select")
        console.log($element);
        var $element = $($id_elem); // the element that Select2 is initialized on
        //var $element = $("#genero.select"); // the element that Select2 is initialized on
        var $option = $("<option selected></option>"); // the new base option
        $option.val(data.id); // set the id
        $option.text(data.nombre); // set the text
        $element.append($option); // add it to the list of selections
        $element.trigger("change"); // tell Select2 to update
    }


