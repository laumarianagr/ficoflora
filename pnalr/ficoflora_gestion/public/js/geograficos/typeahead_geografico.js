/**
 * Created by Lupita on 09/08/2015.
 */



//---ENTIDAD------------
var entidad = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    local: geograficos.entidad
});

$('#entidad.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    name: 'entidad',
    displayKey: 'nombre',
    templates: {
        header: '<h5 class="type-header">Editades registradas</h5>'
    },
    source: entidad.ttAdapter()

});


//---LOCALIDAD------------
var localidad = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    local: geograficos.localidad
});

$('#localidad.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    name: 'localidad',
    displayKey: 'nombre',
    templates: {
        header: '<h5 class="type-header">Localidades registradas</h5>'
    },
    source: localidad.ttAdapter()

});

//---LUGAR------------
var lugar = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    local: geograficos.lugar
});

$('#lugar.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    name: 'lugar',
    displayKey: 'nombre',
    templates: {
        header: '<h5 class="type-header">Lugares registradas</h5>'
    },
    source: lugar.ttAdapter()

});

//---SITIO------------
var sitio = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    local: geograficos.sitio
});

$('#sitio.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    name: 'sitio',
    displayKey: 'nombre',
    templates: {
        header: '<h5 class="type-header">Sitios registradas</h5>'
    },
    source: sitio.ttAdapter()

});