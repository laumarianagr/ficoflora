/**
 * Created by Maria Pinzon on 04/07/2015.
 * Edit by Yusneyi Carballo Barrera on 22/08/2017
 */

$("#jv_phylum").validate({
    rules: {
        phylum:{
            required: true
        }
    },
    messages: {
        phylum: "Este campo es obligatorio"
    }
});


$("#jv_clase").validate({
    rules: {
        phylum:{
            required: true
        },
        clase: "required"
    },
    messages: {
        phylum: "Este campo es obligatorio",
        clase: "Este campo es obligatorio"

    }
});


$("#jv_subclase").validate({
    rules: {
        clase: "required",
        subclase: "required"
    },
    messages: {
        clase: "Este campo es obligatorio",
        subclase: "Este campo es obligatorio"
    }
});


$("#jv_orden").validate({
    rules: {
        clase: {
            require_from_group: [1, ".grupo"]
        },
        subclase: {
            require_from_group: [1, ".grupo"]
        },
        orden: "required"
    },
    messages: {
        clase: "Debe especificar una clase o una sublcase",
        subclase: "Debe especificar una clase o una sublcase",
        orden: "Este campo es obligatorio"
    }
});


$("#jv_familia").validate({
    rules: {
         orden: "required",
        familia: "required"
    },
    messages: {
        orden: "Este campo es obligatorio",
        familia: "Este campo es obligatorio"
    }
});


$("#jv_genero").validate({
    rules: {
        familia: "required",
        genero: "required"

    },
    messages: {
        familia: "Este campo es obligatorio",
        genero: "Este campo es obligatorio"
    }
});


$("#jv_especie").validate({

     highlight: function(element) {
         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
     },
     success: function(element) {
         $(element).closest('.form-group').removeClass('has-error');
         $(element).remove();
     },
    rules: {
        familia: "required",
        genero: "required",
        especie: "required",
        autor: "required"
    },
    messages: {
        familia: "Este campo es obligatorio",
        genero: "Este campo es obligatorio",
        especie: "Este campo es obligatorio",
        autor: "Este campo es obligatorio"
    }
});


$("#jv_especifico").validate({

     highlight: function(element) {
         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
     },
     success: function(element) {
         $(element).closest('.form-group').removeClass('has-error');
         $(element).remove();
     },
    rules: {
        especifico: "required"
    },
    messages: {
        especifico: "Este campo es obligatorio"
    }
});


$("#jv_varietal").validate({

     highlight: function(element) {
         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
     },
     success: function(element) {
         $(element).closest('.form-group').removeClass('has-error');
         $(element).remove();
     },
    rules: {
        varietal: "required"
    },
    messages: {
        varietal: "Este campo es obligatorio"
    }
});


$("#jv_forma").validate({

     highlight: function(element) {
         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
     },
     success: function(element) {
         $(element).closest('.form-group').removeClass('has-error');
         $(element).remove();
     },
    rules: {
        forma: "required"
    },
    messages: {
        forma: "Este campo es obligatorio"
    }
});

$("#jv_subespecie").validate({

    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).remove();
    },
    rules: {
        subespecie: "required"
    },
    messages: {
        subespecie: "Este campo es obligatorio"
    }
});


$("#jv_autor").validate({

     highlight: function(element) {
         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
     },
     success: function(element) {
         $(element).closest('.form-group').removeClass('has-error');
         $(element).remove();
     },
    rules: {
        autor: "required"
    },
    messages: {
        autor: "Este campo es obligatorio"
    }
});


//buscador de especies catalogo
$("#jv_especie_select").validate({

     highlight: function(element) {
         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
     },
     success: function(element) {
         $(element).closest('.form-group').removeClass('has-error');
         $(element).remove();
     },
    rules: {
        especie: "required"
    },
    messages: {
        especie: "Este campo es obligatorio"
    }
});


//buscador de sinonimias catalogo
$("#jv_sinonimia_select").validate({

     highlight: function(element) {
         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
     },
     success: function(element) {
         $(element).closest('.form-group').removeClass('has-error');
         $(element).remove();
     },

    rules: {
        select_sinonimia: "required"
    },
    messages: {
        select_sinonimia: "Este campo es obligatorio"
    }
});


//modal nueva familia
$("#jv_taxonomia-familia").validate({

     highlight: function(element) {
         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
     },
     success: function(element) {
         $(element).closest('.form-group').removeClass('has-error');
         $(element).remove();
     },
    rules: {
        phylum: "required",
        clase: "required",
        orden: "required",
        familia: "required"
    },
    messages: {
        phylum: "Este campo es obligatorio",
        clase: "Este campo es obligatorio",
        orden: "Este campo es obligatorio",
        familia: "Este campo es obligatorio"
    }
});


//modal nuevo genero
$("#jv_taxonomia-genero").validate({

     highlight: function(element) {
         $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
     },
     success: function(element) {
         $(element).closest('.form-group').removeClass('has-error');
         $(element).remove();
     },
    rules: {
        phylum: "required",
        clase: "required",
        orden: "required",
        familia: "required",
        genero: "required"
    },
    messages: {
        phylum: "Este campo es obligatorio",
        clase: "Este campo es obligatorio",
        orden: "Este campo es obligatorio",
        familia: "Este campo es obligatorio",
        genero: "Este campo es obligatorio"
    }
});


$(".jv_sinonimia").validate({

    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).remove();
    },
    rules: {
        genero: "required",
        especie: "required",
        autor: "required"
    },
    messages: {
        genero: "Este campo es obligatorio",
        especie: "Este campo es obligatorio",
        autor: "Este campo es obligatorio"
    }
});
//
// $("#jv_especie").validate({
//    rules: {
//        phylum:{
//            required: true
//        },
//        clase: "required",
//        orden: "required",
//        familia: "required",
//        genero: "required",
//        especie: "required",
//        autor: "required",
//        cita_autor: "required"
//
//    },
//    messages: {
//        phylum: "Debe especificar un phylum",
//        clase: "Debe especificar un clase",
//        orden: "Debe especificar un orden",
//        familia: "Debe especificar un familia",
//        genero: "Debe especificar un genero",
//        especie: "Debe especificar un especie",
//        autor: "Debe especificar un autor",
//        cita_autor: "Debe especificar un autor para la cita"
//    }
//});

//modal nueva familia
$("#jv_taxonomia").validate({

    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).remove();
    },
    rules: {
        phylum: "required",
        clase: "required",
        orden: "required",
        familia: "required"
    },
    messages: {
        phylum: "Este campo es obligatorio",
        clase: "Este campo es obligatorio",
        orden: "Este campo es obligatorio",
        familia: "Este campo es obligatorio"
    }
});