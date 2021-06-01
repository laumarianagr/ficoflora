/**
 * Created by maria-pinzon on 22/06/2015.
 */

$(document).ready(function() {


    var jvalidate = $("#jvalidate").validate({
        rules: {
            cita_autor: "required",
            cita_fecha: "required"

        },
        messages: {
            cita_autor: "Debe especifica un autor para la cita",
            cita_fecha: "Debe especifica una fecha para la cita"
        }
    });

//---CITA------------

    var substringMatcher = function (strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function (i, str) {
                //console.log(str.nombre);

                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };


    $('#cita_autor.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'cita_autor',
        source: substringMatcher(cita_autores) //autor.ttAdapter()

    });

});
