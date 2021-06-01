
$("#jv_entidad").validate({

    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).remove();
    },

    rules: {
        entidad: "required",
        latitud: {
            required: true
        },
        longitud: {
            required: true
        }

    },
    messages: {
        entidad:"Este campo es obligatorio",
        latitud:{
            required: "Este campo es obligatorio"
        },
        longitud:{
            required: "Este campo es obligatorio"
        }
    }
});

$("#jv_localidad").validate({

    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).remove();
    },

    rules: {
        localidad: "required",
        latitud: {
            required: true
        },
        longitud: {
            required: true
        },
        entidad: "required"

    },
    messages: {
        localidad:"Este campo es obligatorio",
        latitud:{
            required: "Este campo es obligatorio"
        },
        longitud:{
            required: "Este campo es obligatorio"
        },
        entidad:"Este campo es obligatorio"
    }
});

$("#jv_lugar").validate({

    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).remove();
    },

    rules: {
        lugar: "required",
        latitud: {
            required: true
        },
        longitud: {
            required: true
        },
        localidad: "required"

    },
    messages: {
        lugar:"Este campo es obligatorio",
        latitud:{
            required: "Este campo es obligatorio"
        },
        longitud:{
            required: "Este campo es obligatorio"
        },
        localidad:"Este campo es obligatorio"
    }
});

$("#jv_sitio").validate({

    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).remove();
    },

    rules: {
        sitio: "required",
        latitud: {
            required: true
        },
        longitud: {
            required: true
        },
        lugar: "required"

    },
    messages: {
        sitio:"Este campo es obligatorio",
        latitud:{
            required: "Este campo es obligatorio"
        },
        longitud:{
            required: "Este campo es obligatorio"
        },
        lugar:"Este campo es obligatorio"
    }
});
