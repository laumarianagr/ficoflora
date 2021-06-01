/**
 * Created by maria-pinzon on 12/07/2015.
 */
/*
 Name: 			Theme Base
 Written by: 	Okler Themes - (http://www.okler.net)
 Theme Version: 	1.3.0
 */


// Navigation
(function( $ ) {

    'use strict';

    var $items = $( '.nav-main li.nav-parent' );

    function expand( li ) {
        li.children( 'ul.nav-children' ).slideDown( 'fast', function() {
            li.addClass( 'nav-expanded' );
            $(this).css( 'display', '' );
            ensureVisible( li );
        });
    }

    function collapse( li ) {
        li.children('ul.nav-children' ).slideUp( 'fast', function() {
            $(this).css( 'display', '' );
            li.removeClass( 'nav-expanded' );
        });
    }

    function ensureVisible( li ) {
        var scroller = li.offsetParent();
        if ( !scroller.get(0) ) {
            return false;
        }

        var top = li.position().top;
        if ( top < 0 ) {
            scroller.animate({
                scrollTop: scroller.scrollTop() + top
            }, 'fast');
        }
    }

    $items.find('> a').on('click', function() {
        var prev = $( this ).closest('ul.nav').find('> li.nav-expanded' ),
            next = $( this ).closest('li');

        if ( prev.get( 0 ) !== next.get( 0 ) ) {
            collapse( prev );
            expand( next );
        } else {
            collapse( prev );
        }
    });

}).apply( this, [ jQuery ]);


// Bootstrap Toggle
(function( $ ) {

    'use strict';

    var $window = $( window );

    var toggleClass = function( $el ) {
        if ( !!$el.data('toggleClassBinded') ) {
            return false;
        }

        var $target,
            className,
            eventName;

        $target = $( $el.attr('data-target') );
        className = $el.attr('data-toggle-class');
        eventName = $el.attr('data-fire-event');


        $el.on('click.toggleClass', function(e) {
            e.preventDefault();
            $target.toggleClass( className );

            var hasClass = $target.hasClass( className );

            if ( !!eventName ) {
                $window.trigger( eventName, {
                    added: hasClass,
                    removed: !hasClass
                });
            }
        });

        $el.data('toggleClassBinded', true);

        return true;
    };

    $(function() {
        $('[data-toggle-class][data-target]').each(function() {
            toggleClass( $(this) );
        });
    });

}).apply( this, [ jQuery ]);
