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
////---AUTORES------------
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

$('#autor-especies.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'autor',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una autoridad</h6>'
    },
    //source: autor.ttAdapter()
    source: nombres.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {

    window.location.replace(root_url+'autor/'+suggestion.id+'/especies');
});