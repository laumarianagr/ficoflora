/**
 * Created by maria-pinzon on 04/06/2015.
 */



    function setPhylum(phylum_id){
        var mi_phylum = phylum.get(phylum_id);
        $('#phylum').typeahead('val', mi_phylum[0].nombre);
    }
    function setClase(clase_id){
        var mi_clase = clase.get(clase_id);
        $('#clase').typeahead('val', mi_clase[0].nombre);

        setPhylum(mi_clase[0].phylum_id);
    }
    function setSubclase(subclase_id, clase_id){
        if(subclase_id != null){
            var mi_subclase = subclase.get(subclase_id);
            $('#subclase').typeahead('val', mi_subclase[0].nombre);
        }else{
            $('#subclase').typeahead('val', null);
        }
        setClase(clase_id);
    }
    function setOrden(orden_id){
        var mi_orden = orden.get(orden_id);
        $('#orden').typeahead('val', mi_orden[0].nombre);
        setSubclase(mi_orden[0].subclase_id, mi_orden[0].clase_id);
    }
    function setFamilia(familia_id){
        var mi_familia = familia.get(familia_id);
        $('#familia').typeahead('val', mi_familia[0].nombre);

        setOrden(mi_familia[0].orden_id);
    }

    //function setGenero(genero_id){
    //    var mi_genero = genero.get(genero_id);
    //    $('#genero').typeahead('val', mi_genero[0].nombre);
    //    select2Familia(mi_genero[0].familia_id);
    //
    //    //setFamilia(mi_genero[0].familia_id);
    //}
    //function setVariedad(variedad){
    //    $('#variedad').typeahead('val', variedad);
    //}
    //function setForma(forma){
    //    $('#forma').typeahead('val', forma);
    //}
    //
    //function setAutor(autor_id){
    //    var mi_autor = autor.get(autor_id);
    //    $('#autor').typeahead('val', mi_autor[0].nombre);
    //}

//setGenero(2);


    function select2Familia(familia_id){
        select2.val(familia_id).trigger("change");

    }



//---PHYLUM------------
    var phylum = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
        queryTokenizer: Bloodhound.tokenizers.nonword,
        identify: function (obj) {
            return obj.id;
        },
        local: taxonomia.phylum
    });

    $('#phylum.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'phylum',
        displayKey: 'nombre',
        templates: {
            header: '<h5 class="type-header">Phylums registrados</h5>'
        },
        source: phylum.ttAdapter()

    });

//---CLASE------------

    var clase = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
        queryTokenizer: Bloodhound.tokenizers.nonword,
        identify: function (obj) {
            return obj.id;
        },
        local: taxonomia.clase
    });

    $('#clase.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'clase',
        displayKey: 'nombre',
        templates: {
            header: '<h5 class="type-header">Clases registradas</h5>'
        },
        source: clase.ttAdapter()

    }).bind('typeahead:select', function (ev, suggestion) {
        if($(this).hasClass('type-complete')) {

            setPhylum(suggestion.phylum_id);
        }

    });

//---SUBCLASE------------
    var subclase = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
        queryTokenizer: Bloodhound.tokenizers.nonword,
        identify: function (obj) {
            return obj.id;
        },
        local: taxonomia.subclase
    });

    $('#subclase.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'subclase',
        displayKey: 'nombre',
        templates: {
            header: '<h5 class="type-header">Subclases registradas</h5>'
        },
        source: subclase.ttAdapter()

    }).bind('typeahead:select', function (ev, suggestion) {
        if($(this).hasClass('type-complete')) {
            setClase(suggestion.clase_id);
        }

    });


//---ORDEN------------
    var orden= new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
        queryTokenizer: Bloodhound.tokenizers.nonword,
        identify: function (obj) {
            return obj.id;
        },
        local: taxonomia.orden
    });

    $('#orden.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'orden',
        displayKey: 'nombre',
        templates: {
            header: '<h5 class="type-header">Órdenes registrados</h5>'
        },
        source: orden.ttAdapter()

    }).bind('typeahead:select', function (ev, suggestion) {
        if($(this).hasClass('type-complete')) {

            setSubclase(suggestion.subclase_id, suggestion.clase_id);
        }
    });


//---FAMILIA------------
    var familia= new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
        queryTokenizer: Bloodhound.tokenizers.nonword,
        identify: function (obj) {
            return obj.id;
        },
        local: taxonomia.familia
    });

    $('#familia.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'familia',
        displayKey: 'nombre',
        templates: {
            header: '<h5 class="type-header">Familias registradas</h5>'
        },
        source: familia.ttAdapter()

    }).bind('typeahead:select', function (ev, suggestion) {
       if($(this).hasClass('type-complete')){
           console.log(suggestion.orden_id);
           setOrden(suggestion.orden_id);
       }
    });


//---GENERO------------
    var genero= new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
        queryTokenizer: Bloodhound.tokenizers.nonword,
        identify: function (obj) {
            return obj.id;
        },
        local: taxonomia.genero
    });

//genero solo completa los formularios de typeahead
//el s-genero es por el catalogo que tengo la especie y la sinonimia en la misma pagina y hacien conflicto con el span
//console.log( taxonomia.genero);

    $('#genero.typeahead, #s-genero.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        limit: 50,
        name: 'genero',
        displayKey: 'nombre',
        templates: {
            header: '<h5 class="type-header">Géneros registrados</h5>'
        },
        source: genero.ttAdapter()

    }).bind('typeahead:select', function (ev, suggestion) {
        //console.log( taxonomia.genero);

        console.log('CLAS'+$(this).hasClass('to-select'));
        //console.log(suggestion);

        if($(this).hasClass('to-select')){
            select2Familia(suggestion.familia_id);
        }else{

            setFamilia(suggestion.familia_id);
        }

    });


    //---ESPECIE------------

    var especie = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
        queryTokenizer: Bloodhound.tokenizers.nonword,
        identify: function (obj) {
            return obj.id;
        },
        local: taxonomia.especifico
    });


    $('#especie.typeahead, #s-especie.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'especie',
        displayKey: 'nombre',
        templates: {
            header: '<h5 class="type-header">Epítetos registrados</h5>'
        },
        source: especie.ttAdapter()

    }).bind('typeahead:select', function (ev, suggestion) {
        //setGenero(suggestion.genero_id);
        //setVariedad(suggestion.variedad);
        //setForma(suggestion.forma);
        //setAutor(suggestion.autor_id);
    });





//---VARIEDAD------------
    var variedad = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
        queryTokenizer: Bloodhound.tokenizers.nonword,
        identify: function (obj) {
            return obj.id;
        },
        local: taxonomia.varietal
    });

    $('#variedad.typeahead, #s-variedad.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'variedad',
        displayKey: 'nombre',
        templates: {
            header: '<h5 class="type-header">Epítetos registrados</h5>'
        },
        source: variedad.ttAdapter()

    });

//---FORMA------------
    var forma = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
        queryTokenizer: Bloodhound.tokenizers.nonword,
        identify: function (obj) {
            return obj.id;
        },
        local: taxonomia.forma
    });

    $('#forma.typeahead, #s-forma.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'forma',
        displayKey: 'nombre',
        templates: {
            header: '<h5 class="type-header">Epítetos registrados</h5>'
        },
        source: forma.ttAdapter()

    });

//---AUTOR------------





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
    console.log('akii' +q);
    var normalized = normalize(q);
    return Bloodhound.tokenizers.nonword(normalized);
};


var nombres = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.nonword('value'),
    queryTokenizer: queryTokenizer,
    local: $.map(taxonomia.autor, function (name) {
        // Normalize the name - use this for searching
        var normalized = normalize(name);
        return {
            value: normalized,
            // Include the original name - use this for display purposes
            displayValue: name
        };
    })
});




    var substringMatcher = function (strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                //console.log(str.nombre);

                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };

    var autor = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
        queryTokenizer: Bloodhound.tokenizers.nonword,

        local: taxonomia.autor
    });

    $('#autor.typeahead, #s-autor.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'autor',
        displayKey: 'displayValue',
        //displayKey: 'autor',
        //source: autor.ttAdapter()
        //source: substringMatcher(taxonomia.autor)
        source: nombres.ttAdapter()
    });

//---CITA AUTOR------------

    var cita_autor = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.nonword('nombre'),
        queryTokenizer: Bloodhound.tokenizers.nonword,

        local: taxonomia.cita_autor
    });

    $('#cita_autor.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'cita_autor',
        //displayKey: 'nombre',
        source: substringMatcher(taxonomia.cita_autor) //autor.ttAdapter()

    });

