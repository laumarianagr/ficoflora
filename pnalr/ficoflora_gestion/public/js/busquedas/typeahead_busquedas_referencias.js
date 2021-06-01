

//---Lugar------------
var autor_libro= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('autores'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/libros/autores/%QUERY',
        wildcard: '%QUERY'
    }
});

$('#autor_libro.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'autor_libro',
    displayKey: 'autores',
    templates: {
        header: '<h6 class="type-header">Seleccione un autor</h6>'
    },
    source: autor_libro.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/libros/'+suggestion.id);
});




//---Lugar------------
var titulo_libro= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('titulo'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/libros/titulos/%QUERY',
        wildcard: '%QUERY'
    }
});

$('#titulo_libro.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'titulo_libro',
    displayKey: 'titulo',
    templates: {
        header: '<h6 class="type-header">Seleccione un tíutlo</h6>'
    },
    source: titulo_libro.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/libros/'+suggestion.id);
});







//---Lugar------------
var autor_revista= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('autores'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/revistas/autores/%QUERY',
        wildcard: '%QUERY'
    }
});

$('#autor_revista.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'autor_revista',
    displayKey: 'autores',
    templates: {
        header: '<h6 class="type-header">Seleccione un autor</h6>'
    },
    source: autor_revista.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/revistas/'+suggestion.id);
});



//---Lugar------------
var titulo_revista= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('titulo'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/revistas/titulos/%QUERY',
        wildcard: '%QUERY'
    }
});

$('#titulo_revista.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'titulo_revista',
    displayKey: 'titulo',
    templates: {
        header: '<h6 class="type-header">Seleccione un tíutlo</h6>'
    },
    source: titulo_revista.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/revistas/'+suggestion.id);
});








//---Lugar------------
var autor_trabajo= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('autores'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/trabajos/autores/%QUERY',
        wildcard: '%QUERY'
    }
});

$('#autor_trabajo.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'autor_trabajo',
    displayKey: 'autores',
    templates: {
        header: '<h6 class="type-header">Seleccione un autor</h6>'
    },
    source: autor_trabajo.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/trabajos/'+suggestion.id);
});



//---Lugar------------
var titulo_trabajo= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('titulo'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/trabajos/titulos/%QUERY',
        wildcard: '%QUERY'
    }
});

$('#titulo_trabajo.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'titulo_trabajo',
    displayKey: 'titulo',
    templates: {
        header: '<h6 class="type-header">Seleccione un tíutlo</h6>'
    },
    source: titulo_trabajo.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/trabajos/'+suggestion.id);
});
