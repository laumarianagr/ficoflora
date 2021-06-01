
/**
 * Created by Lupita on 14/09/2015.
 * Modify María Pinzón y Yusneyi Carballo Barrera, 2016-2017
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

        var $esp = ' ';

        if($keys['subespecie'] != null) {
            $esp = $esp + ' subsp. ' + $keys['subespecie'];
        }

        if($keys['varietal'] != null) {
            $esp = $esp + ' var. ' + $keys['varietal'];
        }

        if($keys['forma'] != null) {
            $esp = $esp + ' f. ' + $keys['forma'];
        }

        return $keys['genero'] + ' ' + $keys['especifico'] + $esp + ' ' + $keys['autor'];
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
        window.location.replace(root_url+'especie/'+suggestion.id);
    }else{
        window.location.replace(root_url+'sinonimia/'+suggestion.id+'/especies');

    }
    console.log($(this) );
    console.log(suggestion.id );
    console.log(suggestion);
});