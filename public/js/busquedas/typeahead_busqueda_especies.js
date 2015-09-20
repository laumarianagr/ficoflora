
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
    }else{
        window.location.replace(root_url+'sinonimia/'+suggestion.id+'/especies');

    }
    console.log($(this) );
    console.log(suggestion.id );
    console.log(suggestion);


});
