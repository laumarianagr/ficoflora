/**
 * Created by maria-pinzon on 20/07/2015.
 */

    //Configuración de Notificaciones
    toastr.options = {
        "closeButton": true,
        "positionClass": "toast-top-center"
    }

    // Inicialización del tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });


    // Paneles Abrir, Cerrar, Eliminar
    (function( $ ) {

        $(function() {
            $('.panel')
                .on( 'click', '.panel-actions a.fa-caret-down', function( e ) {
                    e.preventDefault();

                    var $this,
                        $panel;

                    $this = $( this );
                    $panel = $this.closest( '.panel' );

                    $this
                        .removeClass( 'fa-caret-down' )
                        .addClass( 'fa-caret-up' );

                    $panel.find('.panel-body, .panel-footer').slideDown( 200 );
                })
                .on( 'click', '.panel-actions a.fa-caret-up', function( e ) {
                    e.preventDefault();

                    var $this,
                        $panel;

                    $this = $( this );
                    $panel = $this.closest( '.panel' );

                    $this
                        .removeClass( 'fa-caret-up' )
                        .addClass( 'fa-caret-down' );

                    $panel.find('.panel-body, .panel-footer').slideUp( 200 );
                })
                .on( 'click', '.panel-actions a.fa-times', function( e ) {
                    e.preventDefault();

                    var $panel,
                        $row;

                    $panel = $(this).closest('.panel');

                    if ( !!( $panel.parent('div').attr('class') || '' ).match( /col-(xs|sm|md|lg)/g ) && $panel.siblings().length === 0 ) {
                        $row = $panel.closest('.row');
                        $panel.parent('div').remove();
                        if ( $row.children().length === 0 ) {
                            $row.remove();
                        }
                    } else {
                        $panel.remove();
                    }
                });
        });

    })( jQuery );

