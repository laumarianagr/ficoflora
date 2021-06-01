/**
 * Created by maria-pinzon on 22/06/2015.
 */

$(document).ready(function() {

//---AUTOR------------

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


    $('#autor.typeahead').typeahead({
        hint: false,
        highlight: true,
        minLength: 1

    }, {
        name: 'autor',
        source: substringMatcher(autores) //autor.ttAdapter()

    });

});
