// Codificación y decodificación de caracteres HTML y comentarios PHP

// encode(decode) html text into html entity
var decodeHtmlEntity = function(str) {
    return str.replace(/&#(\d+);/g, function(match, dec) {
        return String.fromCharCode(dec);
    });
};

var encodeHtmlEntity = function(str) {
    var buf = [];
    for (var i=str.length-1;i>=0;i--) {
        buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
    }
    return buf.join('');
};


function strip_tags(input, allowed) {
    //  discuss at: http://phpjs.org/functions/strip_tags/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Luke Godfrey
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

    allowed = (((allowed || '') + '')
        .toLowerCase()
        .match(/<[a-z][a-z0-9]*>/g) || [])
        .join('') // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
        commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi
    return input.replace(commentsAndPhpTags, '')
        .replace(tags, function ($0, $1) {
            return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : ''
        })
}

// ^^^^^  - - - - - - - - - - - - - - ^^^^



//--- LIBROS ------------
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

//--- por AUTOR ------------

$('#autor_libro.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'autor_libro',
    displayKey: function($keys){
        if($keys['letra'] != null){
            return $keys['autores'] + ', '+$keys['fecha'] + $keys['letra'];
        }else{
            return $keys['autores'] + ', '+$keys['fecha'];
        }
    },    templates: {
        header: '<h6 class="type-header">Seleccione un autor</h6>'
    },
    source: autor_libro.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/libros/'+suggestion.id);
});

//--- por TÍTULO ------------
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
    displayKey: function($keys){ return strip_tags($keys['titulo']);
    },
    templates: {
        header: '<h6 class="type-header">Seleccione un título</h6>'
    },
    source: titulo_libro.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/libros/'+suggestion.id);
});


//--- REVISTAS ------------
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

//--- por AUTOR ------------

$('#autor_revista.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'autor_revista',
    displayKey: function($keys){
        if($keys['letra'] != null){
            return $keys['autores'] + ', '+$keys['fecha'] + $keys['letra'];
        }else{
            return $keys['autores'] + ', '+$keys['fecha'];
        }
    },    templates: {
        header: '<h6 class="type-header">Seleccione un autor</h6>'
    },
    source: autor_revista.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/revistas/'+suggestion.id);
});


//--- por  TÍTULO------------
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
    limit: 100,
    name: 'titulo_revista',
    displayKey: function($keys){ return strip_tags($keys['titulo']);
    },
    templates: {
        header: '<h6 class="type-header">Seleccione un título</h6>'
    },
    source: titulo_revista.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/revistas/'+suggestion.id);
});



//--- TRABAJOS ACADÉMICOS ------------
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

//--- por AUTOR ------------
$('#autor_trabajo.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'autor_trabajo',
    displayKey: function($keys){
        if($keys['letra'] != null){
            return $keys['autores'] + ', '+$keys['fecha'] + $keys['letra'];
        }else{
            return $keys['autores'] + ', '+$keys['fecha'];
        }
    },    templates: {
        header: '<h6 class="type-header">Seleccione un autor</h6>'
    },
    source: autor_trabajo.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/trabajos/'+suggestion.id);
});


//--- por TÍTULO------------
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
    displayKey: function($keys){ return strip_tags($keys['titulo']);
    },
    templates: {
        header: '<h6 class="type-header">Seleccione un título</h6>'
    },
    source: titulo_trabajo.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'referencias/trabajos/'+suggestion.id);
});