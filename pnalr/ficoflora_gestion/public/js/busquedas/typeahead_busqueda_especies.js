
/**
 * Created by Lupita on 14/09/2015.
 */

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

$('#especie.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 2

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
            return '<p>No se encontró ninguna especie</p>'
        }
        //suggestion: function ($keys) {
        //    return '<div><strong>'+$keys.nombre+'</strong></div>'
        //}
    },
    source: especie.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {

    if(suggestion.tipo == 'e'){
        window.location.replace(root_url+'especies/'+suggestion.id);
    }else{
        window.location.replace(root_url+'sinonimias/'+suggestion.id);

    }
    console.log($(this) );
    console.log(suggestion.id );
    console.log(suggestion);


});


//EPITETO ESPECIFICO


//---Lugar------------
var especifico= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/especificos/%QUERY',
        wildcard: '%QUERY'
    }
});



$('#especifico.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'especifico',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione un epíteto especifico</h6>'
    },
    source: especifico.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'especificos/'+suggestion.id);
});


//---Lugar------------
var varietal= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/varietales/%QUERY',
        wildcard: '%QUERY'
    }
});



$('#varietal.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'varietal',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione un epíteto varietal</h6>'
    },
    source: varietal.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'varietales/'+suggestion.id);
});


//---Lugar------------
var forma= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/formas/%QUERY',
        wildcard: '%QUERY'
    }
});



$('#forma.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'forma',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione un epíteto forma</h6>'
    },
    source: forma.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'formas/'+suggestion.id);
});
















//AUTORIDAD




var charMap = {
    "à": "a", "á": "a","â": "a","é": "e",
    "è": "e", "ê": "e","ë": "e", "É": "e",
    "ï": "i", "î": "i", "í": "i",
    "ô": "o","ö": "o","ø": "o","ó": "o",
    "û": "u","ù": "u", "ü": "u","ú": "u",
    "ñ": "n"
};


var normalize = function (input) {
    $.each(charMap, function (unnormalizedChar, normalizedChar) {
        var regex = new RegExp(unnormalizedChar, 'gi');
        input = input.replace(regex, normalizedChar);
    });
    return input;
};

var queryTokenizer = function (q) {
    var normalized = normalize(q);
    return Bloodhound.tokenizers.nonword(normalized);
};


var nombres = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('value'),
    queryTokenizer: queryTokenizer,
    local: $.map(autores, function (name) {
        // Normalize the name - use this for searching
        var normalized = normalize(name.nombre);
        return {
            value: normalized,
            // Include the original name - use this for display purposes
            nombre: name.nombre,
            id: name.id
        };
    })
});



//
////---ATORES------------
//var autor= new Bloodhound({
//    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
//    queryTokenizer: Bloodhound.tokenizers.nonword,
//    identify: function (obj) {
//        return obj.id;
//    },
//    remote: {
//        url: root_url+'buscar/autores/%QUERY',
//        wildcard: '%QUERY'
//    }
//});

$('#autor.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'autor',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione un autor</h6>'
    },
    //source: autor.ttAdapter()
    source: nombres.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {

    //console.log(suggestion);
    window.location.replace(root_url+'autores/'+suggestion.id);
});



