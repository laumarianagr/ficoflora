
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




//---Sitio------------
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




//---UBICACIÓN------------
var ubicacion= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/ubicaciones/%QUERY',
        wildcard: '%QUERY'
    }
});


$('#ubicacion.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'ubicacion',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una ubicación</h6>'
    },
    source: ubicacion.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {

    if(suggestion.tipo == 'e'){
        window.location.replace(root_url+'entidad/'+suggestion.id+'/localidades');
    }
    if(suggestion.tipo == 'lo'){
        window.location.replace(root_url+'localidad/'+suggestion.id+'/lugares');
    }
    if(suggestion.tipo == 'lu'){
        window.location.replace(root_url+'lugar/'+suggestion.id+'/sitiosyespecies');
     }
    if(suggestion.tipo == 's'){
        window.location.replace(root_url+'sitio/'+suggestion.id+'/especies');
    }
});


$('#ubicacion-especie.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 20,
    name: 'ubicacion',
    displayKey: 'nombre',
    templates: {
        header: '<h6 class="type-header">Seleccione una ubicación</h6>'
    },
    source: ubicacion.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {

    if(suggestion.tipo == 'e'){
        window.location.replace(root_url+'entidad/'+suggestion.id+'/especies');
    }
    if(suggestion.tipo == 'lo'){
        window.location.replace(root_url+'localidad/'+suggestion.id+'/especies');
    }
    if(suggestion.tipo == 'lu'){
        window.location.replace(root_url+'lugar/'+suggestion.id+'/especies');
     }
    if(suggestion.tipo == 's'){
        window.location.replace(root_url+'sitio/'+suggestion.id+'/especies');
    }
});



//--- REFERENCIA, solo por INVESTIGADOR (autor) o por TÍTULO DEL TRABAJO  ------------
var referencia= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('autores'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/referencia/%QUERY',
        wildcard: '%QUERY'
    }
});

/******   ESTE BLOQUE LO ESTÁ USANDO TAMBIEN referencia2   *****/
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


function strip_tags (input, allowed) {
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

/******   ^^^ ESTE BLOQUE LO ESTÁ USANDO TAMBIEN referencia2   *****/


$('#referencia.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 100,
    name: 'referencia',
    displayKey: function($keys){
        if($keys['letra'] != null){
            return $keys['autores'] + ', '+$keys['fecha'] + $keys['letra'] + ': ' + strip_tags($keys['titulo']);
        }else{
            return $keys['autores'] + ', '+$keys['fecha'] +  ': ' + strip_tags($keys['titulo']);
        }
    },
    templates: {
        header: '<h6 class="type-header">Seleccione una referencia</h6>'
    },
    source: referencia.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'listado/'+suggestion.id +'/'+suggestion.tipo +'/referencia');

});



//--- REFERENCIAS, por nombre del INVESTIGADOR (autor) ------------
var referencia2= new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('autores'),
    queryTokenizer: Bloodhound.tokenizers.nonword,
    identify: function (obj) {
        return obj.id;
    },
    remote: {
        url: root_url+'buscar/referenciasInvestigador/%QUERY',
        wildcard: '%QUERY'
    }
});


$('#referencia2.typeahead').typeahead({
    hint: false,
    highlight: true,
    minLength: 1

}, {
    limit: 100,
    name: 'referencia2',
    displayKey: function($keys){
        if($keys['letra'] != null){
            return $keys['autores'] + ', '+$keys['fecha'] + $keys['letra'] + strip_tags($keys['titulo']);
        }else{
            return $keys['autores'] + ', '+$keys['fecha'] +  ': ' + strip_tags($keys['titulo']);
        }
    },
    templates: {
        header: '<h6 class="type-header">Seleccione un autor</h6>'
    },
    source: referencia2.ttAdapter()

}).bind('typeahead:select', function (ev, suggestion) {
    window.location.replace(root_url+'investigador/'+suggestion.id +'/'+suggestion.tipo +'/referencias');

});