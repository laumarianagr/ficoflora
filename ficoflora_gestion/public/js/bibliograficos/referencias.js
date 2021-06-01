/**
 * Created by Lupita on 11/08/2015.
 */


    $(function () {
        $('#ref_libro [data-toggle="popover"]').popover({
            trigger: 'focus'
        })
    })


    $(".cita").change(function(){

        //Obtengo el value del select de la cita
        var value = $('option:selected', this).val();
        var tipo = this.id.split('_')[1];
        var id_autores = '#autores_'+tipo;
        var class_span = '.cita_'+tipo;
        var cita;

        var autores = $(id_autores).val();

        if($(id_autores).val()){

            $(class_span).parents(".wrap").show();

            switch(value){
                case '1':
                    cita = autores.split(',')[0];
                    break;

                case '2':
                    cita = autores.split(',')[0]+' & '+ autores.split(' ').pop();
                    break;

                case '3':
                    cita = autores.split(',')[0]+' <em>et al.</em>'
                    break;

            }
        }else{
            $(class_span).parents(".wrap").hide();
        }

        $(class_span).html(cita);
    });



    //TEXTAREA plugin
    tinymce.init({
        selector: ".tinymce",
        min_height: 60,
        fontsize_formats: "18pt 24pt 36pt",
        menubar : false,
        language : 'es',
        plugins: "charmap paste code",
        valid_elements: "p,b,i,strong,em,span[style]",
        paste_word_valid_elements: "p,b,i,strong,em,span",
        forced_root_block: '',

        toolbar: [
            "undo redo | copy paste | bold italic underline | charmap  code"
        ],
        setup: function(editor) {

            editor.on('keyup change', function(e) {
    //                            console.log( tinyMCE.activeEditor.getContent({format : 'html'}));
    //                            console.log( tinyMCE.activeEditor.getContent());

                //obtengo el contenido del texarea tinymce
                var p = tinyMCE.activeEditor.getContent();

                //tranformo el id en la clase que tiene el span de resultado
                var class_span = '.'+this.id;

                if( p != ''){
                    $(class_span).parents(".wrap").show();
                }else{
                    $(class_span).parents(".wrap").hide();
                }
                //adjunto el contenido del textarea a el span de resultado
                $(class_span).html(p);

            });

            editor.on('init', function()
            {
                this.getDoc().body.style.fontSize = '14px';
            });
        }

    });

