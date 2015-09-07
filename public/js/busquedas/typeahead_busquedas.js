
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
    window.location.replace(root_url+'familia/'+suggestion.id+'/especies');
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

$('#genero.typeahead').typeahead({
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



//---Especie------------
var especie= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    //local: especies
    remote: {
        url: root_url+'buscar/especies-sinonimias/%QUERY',
        wildcard: '%QUERY'
    }
});

//genero solo completa los formularios de typeahead
//el s-genero es por el catalogo que tengo la especie y la sinonimia en la misma pagina y hacien conflicto con el span

$('#especie.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 3

}, {
    limit: 50,
    name: 'especie',
    displayKey: function($keys){

        if(($keys['varietal'] == null) && ($keys['forma'] == null)){
            return $keys['genero']+' '+$keys['especifico'];
        }else{
            if(($keys['varietal'] != null) && ($keys['forma'] == null)) {
                return $keys['genero'] + ' ' + $keys['especifico'] + ' var. ' + $keys['varietal'];
            }else{
                if(($keys['varietal'] == null) && ($keys['forma'] != null)) {
                    return $keys['genero'] + ' ' + $keys['especifico'] + ' f. ' + $keys['forma'];
                }else{
                    return $keys['genero'] + ' ' + $keys['especifico']+ ' var. ' + $keys['varietal'] + ' f. ' + $keys['forma'];
                }
            }
        }
    },
    templates: {
        empty: function(){
            return '<p>No se encontro ninguna especie</p>'
        }
        //suggestion: function ($keys) {
        //    return '<div><strong>'+$keys.nombre+'</strong></div>'
        //}
    },
    source: especie.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {

    if(suggestion.tipo == 'e'){

        window.location.replace(root_url+'especie/'+suggestion.id);
    }
    console.log($(this) );
    console.log(suggestion.id );
    console.log(suggestion);


});





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

$('#entidad.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'entidad',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una entidad</h6>'
    },
    source: entidad.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'entidad/'+suggestion.id+'/especies');
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
    window.location.replace(root_url+'localidad/'+suggestion.id+'/especies');
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

$('#lugar.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'lugar',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una lugar</h6>'
    },
    source: lugar.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'lugar/'+suggestion.id+'/especies');
});


