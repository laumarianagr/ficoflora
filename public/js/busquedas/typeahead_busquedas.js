
//---PHYLUM------------
var phylum= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/phylums/%QUERY',
        wildcard: '%QUERY'
    }
});



$('#phylum.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'phylum',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione un phylum</h6>'
    },
    source: phylum.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'phylum/'+suggestion.id+'/clases');
});

//---CLASES------------
var clase= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/clases/%QUERY',
        wildcard: '%QUERY'
    }
});



$('#clase.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'clase',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una clase</h6>'
    },
    source: clase.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'clase/'+suggestion.id+'/subclases');
});

//---SUBCLASES------------
var subclase= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/subclases/%QUERY',
        wildcard: '%QUERY'
    }
});



$('#subclase.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'subclase',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una subclase</h6>'
    },
    source: subclase.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'subclase/'+suggestion.id+'/ordenes');
});


//---ORDEN------------
var orden= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/ordenes/%QUERY',
        wildcard: '%QUERY'
    }
});



$('#orden.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'orden',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione un orden</h6>'
    },
    source: orden.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'orden/'+suggestion.id+'/familias');
});


//---FAMILIA------------
var familia= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/familias/%QUERY',
        wildcard: '%QUERY'
    }
});

$('#familia-especies.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'familia',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una familia</h6>'
    },
    source: familia.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'familia/'+suggestion.id+'/especies');
});


$('#familia.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'familia',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una familia</h6>'
    },
    source: familia.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'familia/'+suggestion.id+'/generos');
});






//---GENERO------------
var genero= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/generos/%QUERY',
        wildcard: '%QUERY'
    }
});

$('#genero-especies.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'genero',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione un género</h6>'
    },
    source: genero.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {

    window.location.replace(root_url+'genero/'+suggestion.id+'/especies');
});








//genero solo completa los formularios de typeahead
//el s-genero es por el catalogo que tengo la especie y la sinonimia en la misma pagina y hacien conflicto con el span





//---ENTIDAD------------
var entidad= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/entidades/%QUERY',
        wildcard: '%QUERY'
    }
});

$('#entidad-especies.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'entidad',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una entidad federal</h6>'
    },
    source: entidad.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'entidad/'+suggestion.id+'/especies');
});

$('#entidad.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'entidad',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una entidad federal</h6>'
    },
    source: entidad.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'entidad/'+suggestion.id+'/localidades');
});




//---LOCALIDAD------------
var localidad= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/localidades/%QUERY',
        wildcard: '%QUERY'
    }
});

$('#localidad-especies.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'localidad',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una localidad</h6>'
    },
    source: localidad.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'localidad/'+suggestion.id+'/especies');
});

$('#localidad.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'localidad',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una localidad</h6>'
    },
    source: localidad.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'localidad/'+suggestion.id+'/lugares');
});




//---Lugar------------
var lugar= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/lugares/%QUERY',
        wildcard: '%QUERY'
    }
});

$('#lugar-especies.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'lugar',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione un lugar</h6>'
    },
    source: lugar.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'lugar/'+suggestion.id+'/especies');
});

$('#lugar.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'lugar',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione un lugar</h6>'
    },
    source: lugar.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'lugar/'+suggestion.id+'/sitios');
});




//---Lugar------------
var sitio= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/sitios/%QUERY',
        wildcard: '%QUERY'
    }
});



$('#sitio.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'sitio',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione un sitio</h6>'
    },
    source: sitio.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'sitio/'+suggestion.id+'/especies');
});

