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
            phylum: "Debe especifica un phylum",
            clase: "Debe especifica un clase",
            orden: "Debe especifica un orden",
            familia: "Debe especifica un familia",
            genero: "Debe especifica un genero"
        }
    });

});