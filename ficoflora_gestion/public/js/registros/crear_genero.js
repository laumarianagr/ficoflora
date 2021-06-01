/**
 * Created by maria-pinzon on 22/06/2015.
 */


$(document).ready(function() {

    var jvalidate = $("#jvalidate").validate({
        rules: {
            phylum:{
                required: true
            },
            clase: "required",
            orden: "required",
            familia: "required",
            genero: "required"

        },
        messages: {
            phylum: "Debe especificar un phylum",
            clase: "Debe especificar un clase",
            orden: "Debe especificar un orden",
            familia: "Debe especificar un familia",
            genero: "Debe especificar un género"
        }
    });

});