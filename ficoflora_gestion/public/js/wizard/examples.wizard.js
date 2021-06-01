/*
Name: 			Forms / Wizard - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.3.0
*/

(function( $ ) {

	'use strict';

	/*
	Wizard #1
	*/
	var $w1finish = $('#jv_ubicacion').find('#crear'),

        $w1validator = $("#jv_ubicacion").validate({
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
                $(element).remove();
            },
            errorPlacement: function( error, element ) {
                element.parent().append( error );
            },
            rules: {
                entidad: {
                    required: true
                },
                //localidad: {
                //    required: true
                //},
                //lugar: {
                //    required: true
                //},
                //sitio: {
                //    required: true
                //},
                //latitud_entidad: "required",
                //longitud_entidad: "required",
                //latitud_localidad: "required",
                //longitud_localidad: "required",
                //latitud_lugar: "required",
                //longitud_lugar: "required",
                //latitud_sitio: "required",
                //longitud_sitio: "required"
            },

            messages: {
                entidad: "Debe especificar una Entidad",
                localidad: "Debe especificar una Localidad",
                lugar: "Debe especificar un Lugar",
                sitios: "Debe especificar un Sitio",

                latitud_entidad: "Debe especificar la Latidud",
                longitud_entidad: "Debe especificar la Longitud",
                latitud_localidad: "Debe especificar la Latidud",
                longitud_localidad: "Debe especificar la Longitud",
                latitud_lugar: "Debe especificar la Latidud",
                longitud_lugar: "Debe especificar la Longitud",
                latitud_sitio: "Debe especificar la Latidud",
                longitud_sitio: "Debe especificar la Longitud"

            }

	    });


	$('#ubicacion').bootstrapWizard({
        tabClass: 'wizard-steps',
        previousSelector: '#anterior',
        nextSelector: '#siguiente',
        //nextSelector: 'ul.pager li.next',
        //previousSelector: 'ul.pager li.previous',
		firstSelector: null,
		lastSelector: null,
		onNext: function( tab, navigation, index, newindex ) {
			var validated = $('#jv_ubicacion').valid();
			if( !validated ) {
				$w1validator.focusInvalid();
				return false;
			}
		},
		onTabClick: function( tab, navigation, index, newindex ) {
			if ( newindex == index + 1 ) {
				return this.onNext( tab, navigation, index, newindex);
			} else if ( newindex > index + 1 ) {
				return false;
			} else {
				return true;
			}
		},
		onTabChange: function( tab, navigation, index, newindex ) {
			var totalTabs = navigation.find('li').size() - 1;
			var flagTabs = 1;
            //console.log(newindex, totalTabs);
            //$w1finish[ newindex == totalTabs ? 'addClass' : 'removeClass' ]( 'hidden' );
            $('#ubicacion').find(this.nextSelector)[ newindex == totalTabs ? 'addClass' : 'removeClass' ]( 'hidden' );
		}
	});


	/*----------------------------------------
	referencia de LIBROS
	*/
	var $crear_libro = $('#ref_libro').find('#crear_libro'),

		$libro_validator = $("#ref_libro form").validate({
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
			$(element).remove();
		},
		errorPlacement: function( error, element ) {
			element.parent().append( error );
		},

        rules: {
            autores: {
                required: true
            },
            fecha: "required",
            cita: "required",
            titulo: "required",
            lugar: "required",
            paginas:{
                required: true,
                digits: true
            },
            enlace:"url"
        },

        messages: {
            autores: "Debe especificar el autor o los autores del libro",
            fecha: "Debe especificar una fecha",
            cita: "Especifique la cantidad de autores para la cita",
            titulo: "Debe especificar el título del libro",
            lugar: "Debe especificar el lugar",
            paginas: {
                required: "Especifique la cantidad de páginas del libro",
                digits: "En este campo solo pueden ir números"
            },
            enlace: "Debe especificar un dirección válida"
        }
	});
/*
	$crear_libro.on('click', function( ev ) {
		ev.preventDefault();
		var validated = $('#w3 form').valid();
		if ( validated ) {
			new PNotify({
				title: 'Congratulations',
				text: 'You completed the wizard form.',
				type: 'custom',
				addclass: 'notification-success',
				icon: 'fa fa-check'
			});
		}
	});
*/
	$('#ref_libro').bootstrapWizard({
		tabClass: 'wizard-steps',
        previousSelector: '#anterior',
        nextSelector: '#siguiente',
		firstSelector: null,
		lastSelector: null,
		onNext: function( tab, navigation, index, newindex ) {
			var validated = $('#ref_libro form').valid();
			if( !validated ) {
				$libro_validator.focusInvalid();
				return false;
			}
		},
		onTabClick: function( tab, navigation, index, newindex ) {
			if ( newindex == index + 1 ) {
				return this.onNext( tab, navigation, index, newindex);
			} else if ( newindex > index + 1 ) {
				return false;
			} else {
				return true;
			}
		},
		onTabChange: function( tab, navigation, index, newindex ) {
			var $total = navigation.find('li').size() - 1;
			$crear_libro[ newindex != $total ? 'addClass' : 'removeClass' ]( 'hidden' );
			$('#ref_libro').find(this.nextSelector)[ newindex == $total ? 'addClass' : 'removeClass' ]( 'hidden' );
		},
		onTabShow: function( tab, navigation, index ) {
			var $total = navigation.find('li').length - 1;
			var $current = index;
			var $percent = Math.floor(( $current / $total ) * 100);
			$('#ref_libro').find('.progress-indicator').css({ 'width': $percent + '%' });
			tab.prevAll().addClass('completed');
			tab.nextAll().removeClass('completed');
		}
	});



    /*----------------------------------------
     referencia de REVISTAS
     */

	var $crear_revista = $('#ref_revista').find('#crear_revista'),
		$revista_validator = $("#ref_revista form").validate({
		highlight: function(element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
			$(element).remove();
		},
		errorPlacement: function( error, element ) {
			element.parent().append( error );
		},

        rules: {
            autores: {
                required: true
            },
            fecha: "required",
            cita: "required",
            titulo: "required",
            nombre: "required",
            volumen:{
                required: true,
                digits: true
            },
            intervalo_1:{
                required: true,
                digits: true
            },
            intervalo_2:{
                required: true,
                digits: true
            },
            enlace:"url"
        },

        messages: {
            autores: "Debe especificar el autor o los autores del libro",
            fecha: "Debe especificar una fecha",
            cita: "Especifique la cantidad de autores para la cita",
            titulo: "Debe especificar el título del libro",
            nombre: "Debe especificar el nombre de la revista",
            volumen: {
                required: "Especifique el volumen de la revista",
                digits: "En este campo solo pueden ir números"
            },
            intervalo_1: {
                required: "Especifique el fin del intérvalo de páginas",
                digits: "En este campo solo pueden ir números"
            },
            intervalo_2: {
                required: "Especifique el comienzó del intérvalo de páginas",
                digits: "En este campo solo pueden ir números"
            },
            enlace: "Debe especificar un dirección válida"
        }
	});

	//$crear_revista.on('click', function( ev ) {
	//	ev.preventDefault();
	//	var validated = $('#w4 form').valid();
	//	if ( validated ) {
	//		new PNotify({
	//			title: 'Congratulations',
	//			text: 'You completed the wizard form.',
	//			type: 'custom',
	//			addclass: 'notification-success',
	//			icon: 'fa fa-check'
	//		});
	//	}
	//});

	$('#ref_revista').bootstrapWizard({
		tabClass: 'wizard-steps',
        previousSelector: '#anterior',
        nextSelector: '#siguiente',
		firstSelector: null,
		lastSelector: null,
		onNext: function( tab, navigation, index, newindex ) {
			var validated = $('#ref_revista form').valid();
			if( !validated ) {
				$revista_validator.focusInvalid();
				return false;
			}
		},
		onTabClick: function( tab, navigation, index, newindex ) {
			if ( newindex == index + 1 ) {
				return this.onNext( tab, navigation, index, newindex);
			} else if ( newindex > index + 1 ) {
				return false;
			} else {
				return true;
			}
		},
		onTabChange: function( tab, navigation, index, newindex ) {
			var $total = navigation.find('li').size() - 1;
			$crear_revista[ newindex != $total ? 'addClass' : 'removeClass' ]( 'hidden' );
			$('#ref_revista').find(this.nextSelector)[ newindex == $total ? 'addClass' : 'removeClass' ]( 'hidden' );
		},
		onTabShow: function( tab, navigation, index ) {
			var $total = navigation.find('li').length - 1;
			var $current = index;
			var $percent = Math.floor(( $current / $total ) * 100);
			$('#ref_revista').find('.progress-indicator').css({ 'width': $percent + '%' });
			tab.prevAll().addClass('completed');
			tab.nextAll().removeClass('completed');
		}
	});


    /*----------------------------------------
     referencia de TRABAJOS
     */

    var $crear_trabajos = $('#ref_trabajos').find('#crear_trabajo'),
        $trabajos_validator = $("#ref_trabajos form").validate({
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
                $(element).remove();
            },
            errorPlacement: function( error, element ) {
                element.parent().append( error );
            },
            rules: {
                autores: {
                    required: true
                },
                tipo: "required",
                fecha: "required",
                cita: "required",
                titulo: "required",
                intitucion: "required",
                lugar: "required",
                paginas:{
                    required: true,
                    digits: true
                },
                intervalo_1:{
                    required: true,
                    digits: true
                },
                intervalo_2:{
                    required: true,
                    digits: true
                },
                enlace:"url"
            },

            messages: {
                autores: "Debe especificar el autor o los autores del libro",
                tipo: "Especifique el tipo de trabajo académico",
                fecha: "Debe especificar una fecha",
                cita: "Eespecifique la cantidad de autores para la cita",
                titulo: "Debe especificar el título del libro",
                intitucion: "Debe especificar la institución",
                lugar: "Debe especificar el lugar",
                paginas: {
                    required: "Especifique la cantidad de páginas del libro",
                    digits: "En este campo solo pueden ir números"
                },
                enlace: "Debe especificar un dirección válida"
            }
        });

    $('#ref_trabajos').bootstrapWizard({
		tabClass: 'wizard-steps',
        previousSelector: '#anterior',
        nextSelector: '#siguiente',
		firstSelector: null,
		lastSelector: null,
		onNext: function( tab, navigation, index, newindex ) {
			var validated = $('#ref_trabajos form').valid();
			if( !validated ) {
				$trabajos_validator.focusInvalid();
				return false;
			}
		},
		onTabClick: function( tab, navigation, index, newindex ) {
			if ( newindex == index + 1 ) {
				return this.onNext( tab, navigation, index, newindex);
			} else if ( newindex > index + 1 ) {
				return false;
			} else {
				return true;
			}
		},
		onTabChange: function( tab, navigation, index, newindex ) {
			var $total = navigation.find('li').size() - 1;
			$crear_trabajos[ newindex != $total ? 'addClass' : 'removeClass' ]( 'hidden' );
			$('#ref_trabajos').find(this.nextSelector)[ newindex == $total ? 'addClass' : 'removeClass' ]( 'hidden' );
		},
		onTabShow: function( tab, navigation, index ) {
			var $total = navigation.find('li').length - 1;
			var $current = index;
			var $percent = Math.floor(( $current / $total ) * 100);
			$('#ref_trabajos').find('.progress-indicator').css({ 'width': $percent + '%' });
			tab.prevAll().addClass('completed');
			tab.nextAll().removeClass('completed');
		}
	});

    /*
     Wizard #6
     */
    var $w6finish = $('#w6').find('#crear_enlace'),
        $w6validator = $("#w6 form").validate({
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
                $(element).remove();
            },
            errorPlacement: function( error, element ) {
                element.parent().append( error );
            }
        });

    $('#w6').bootstrapWizard({
		tabClass: 'wizard-steps',
        previousSelector: '#anterior',
        nextSelector: '#siguiente',
		firstSelector: null,
		lastSelector: null,
		onNext: function( tab, navigation, index, newindex ) {
			var validated = $('#w6 form').valid();
			if( !validated ) {
				$w6validator.focusInvalid();
				return false;
			}
		},
		onTabClick: function( tab, navigation, index, newindex ) {
			if ( newindex == index + 1 ) {
				return this.onNext( tab, navigation, index, newindex);
			} else if ( newindex > index + 1 ) {
				return false;
			} else {
				return true;
			}
		},
		onTabChange: function( tab, navigation, index, newindex ) {
			var $total = navigation.find('li').size() - 1;
			$w6finish[ newindex != $total ? 'addClass' : 'removeClass' ]( 'hidden' );
			$('#w6').find(this.nextSelector)[ newindex == $total ? 'addClass' : 'removeClass' ]( 'hidden' );
		},
		onTabShow: function( tab, navigation, index ) {
			var $total = navigation.find('li').length - 1;
			var $current = index;
			var $percent = Math.floor(( $current / $total ) * 100);
			$('#w6').find('.progress-indicator').css({ 'width': $percent + '%' });
			tab.prevAll().addClass('completed');
			tab.nextAll().removeClass('completed');
		}
	});






}).apply( this, [ jQuery ]);
