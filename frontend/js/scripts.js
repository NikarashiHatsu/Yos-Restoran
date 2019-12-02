( function( $ ) {
	'use strict';

    var is_rtl = false;
    if ( jQuery( 'body' ).css( 'direction' ) === 'rtl' ) {
        var is_rtl = true;
    }

	 /*===================================================================================*/
    /*  Header Phone Numbers Display
    /*===================================================================================*/

    $("#city-phone-numbers").change(function(){
        var selectedKey = $(this).val();
        $('#city-phone-number-label').html( selectedKey );
    });

	$(window).on("load", function (e) {
        $("#city-phone-numbers").trigger('change');

        /*===================================================================================*/
        /*  Custom Scrollbar Script
        /*===================================================================================*/
        if( typeof mCustomScrollbar !== "undefined" ) {
            $( '.page-template-template-homepage-v6 .site-header' ).mCustomScrollbar();
        }

        // Add focus to cart dropdown
        $( '.site-header-cart' ).find( 'a' ).on( 'focus.pizzaro blur.pizzaro', function() {
            $( this ).parents().toggleClass( 'focus' );
        });

        $( '.phm-close' ).on( 'click', function() {
            $( '.menu-toggle' ).trigger( 'click' );
        } );

        $( document ).on( 'click', function( event ) {
            var menuContainer = $( '.main-navigation' );

            if ( menuContainer.hasClass( 'toggled' ) ) {
                if ( ! menuContainer.is( event.target ) && 0 === menuContainer.has( event.target ).length ) {
                    $( '.menu-toggle' ).trigger( 'click' );
                }
            }
        } );

        // Add class to footer search when clicked
        $( '.pizzaro-handheld-footer-bar .search > a' ).on( 'click', function(e) {
            $( this ).parent().toggleClass( 'active' );
            e.preventDefault();
        });
    });

    // Add focus class to li
    $( '.main-navigation, .secondary-navigation' ).find( 'a' ).on( 'focus.pizzaro blur.pizzaro', function() {
        $( this ).parents().toggleClass( 'focus' );
    });

    /*===================================================================================*/
    /*  OWL CAROUSEL
    /*===================================================================================*/

    $( document ).ready( function() {
        var dragging = true;
        var owlElementID = "#owl-main";

        function fadeInReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3," + owlElementID + " .caption .fadeIn-4").stop().delay(800).animate({ opacity: 0 }, { duration: 400, easing: "easeInCubic" });
            }
            else {
                $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3," + owlElementID + " .caption .fadeIn-4").css({ opacity: 0 });
            }
        }

        function fadeInDownReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3," + owlElementID + " .caption .fadeInDown-4").stop().delay(800).animate({ opacity: 0, top: "-15px" }, { duration: 400, easing: "easeInCubic" });
            }
            else {
                $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3," +  owlElementID + " .caption .fadeInDown-4").css({ opacity: 0, top: "-15px" });
            }
        }

        function fadeInUpReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3," + owlElementID + " .caption .fadeInUp-4").stop().delay(800).animate({ opacity: 0, top: "15px" }, { duration: 400, easing: "easeInCubic" });
            }
            else {
                $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3," + owlElementID + " .caption .fadeInUp-4").css({ opacity: 0, top: "15px" });
            }
        }

        function fadeInLeftReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3, " + owlElementID + " .caption .fadeInLeft-4").stop().delay(800).animate({ opacity: 0, left: "15px" }, { duration: 400, easing: "easeInCubic" });
            }
            else {
                $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3," + owlElementID + " .caption .fadeInLeft-4").css({ opacity: 0, left: "15px" });
            }
        }

        function fadeInRightReset() {
            if (!dragging) {
                $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3," + owlElementID + " .caption .fadeInRight-4").stop().delay(800).animate({ opacity: 0, left: "-15px" }, { duration: 400, easing: "easeInCubic" });
            }
            else {
                $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3," + owlElementID + " .caption .fadeInRight-4").css({ opacity: 0, left: "-15px" });
            }
        }

        function fadeIn() {
            $(owlElementID + " .active .caption .fadeIn-1").stop().delay(500).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeIn-2").stop().delay(700).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeIn-3").stop().delay(1000).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeIn-4").stop().delay(1000).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
        }

        function fadeInDown() {
            $(owlElementID + " .active .caption .fadeInDown-1").stop().delay(500).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInDown-2").stop().delay(700).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInDown-3").stop().delay(1000).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInDown-4").stop().delay(1000).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        }

        function fadeInUp() {
            $(owlElementID + " .active .caption .fadeInUp-1").stop().delay(500).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInUp-2").stop().delay(700).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInUp-3").stop().delay(1000).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInUp-4").stop().delay(1000).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        }

        function fadeInLeft() {
            $(owlElementID + " .active .caption .fadeInLeft-1").stop().delay(500).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInLeft-2").stop().delay(700).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInLeft-3").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInLeft-4").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        }

        function fadeInRight() {
            $(owlElementID + " .active .caption .fadeInRight-1").stop().delay(500).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInRight-2").stop().delay(700).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInRight-3").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
            $(owlElementID + " .active .caption .fadeInRight-4").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        }

        $(owlElementID).owlCarousel({

            animateOut: 'fadeOut',
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: false,
            stopOnHover: true,
            loop: true,
            rtl: is_rtl,
            navRewind: true,
            items: 1,
            dots: true,
            nav:false,
            //navText: ["<i class='icon fa fa-angle-left'></i>", "<i class='icon fa fa-angle-right'></i>"],
            lazyLoad: true,
            stagePadding: 0,
            responsive : {
                0 : {
                    items : 1,
                },
                480: {
                    items : 1,
                },
                768 : {
                    items : 1,
                },
                992 : {
                    items : 1,
                },
                1199 : {
                    items : 1,
                },
                onTranslate : function(){
                      echo.render();
                    }
            },


            onInitialize   : function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onInitialized   : function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onResize   : function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onResized   : function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onRefresh   : function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onRefreshed   : function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onUpdate   : function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onUpdated   : function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onDrag : function() {
                dragging = true;
            },

            onTranslate   : function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },
            onTranslated   : function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onTo   : function() {
                fadeIn();
                fadeInDown();
                fadeInUp();
                fadeInLeft();
                fadeInRight();
            },

            onChanged  : function() {
                fadeInReset();
                fadeInDownReset();
                fadeInUpReset();
                fadeInLeftReset();
                fadeInRightReset();
                dragging = false;
            }
        });

        $('#products-carousel-with-image .owl-carousel').owlCarousel({
            "items":3,
            "nav":true,
            "slideSpeed":300,
            "dots":false,
            "rtl":is_rtl,
            "paginationSpeed":400,
            "navText":['<i class="po po-arrow-left-slider"></i>','<i class="po po-arrow-right-slider"></i>'],
            "margin":0,
            "touchDrag":true,
            "responsive":{
                "0":{
                    "items":1
                },
                "480":{
                    "items":3
                },
                "768":{
                    "items":2
                },
                "992":{
                    "items":3
                },
                "1200":{
                    "items":3
                }
            },

        });

        $('#products-4-1-carousel-1 .owl-carousel').owlCarousel({
            "items":1,
            "nav":true,
            "slideSpeed":300,
            "dots":false,
            "rtl":is_rtl,
            "paginationSpeed":400,
            "navText":['<i class="po po-arrow-left"></i>','<i class="po po-arrow-right"></i>'],
            "margin":0,
            "touchDrag":true,
            "responsive":{
                "0":{
                    "items":1
                },
                "480":{
                    "items":1
                },
                "768":{
                    "items":1
                },
                "992":{
                    "items":1
                },
                "1200":{
                    "items":1
                }
            },

        });

        $('#products-4-1-carousel-2 .owl-carousel').owlCarousel({
            "items":1,
            "nav":true,
            "slideSpeed":300,
            "dots":false,
            "rtl":is_rtl,
            "paginationSpeed":400,
            "navText":['<i class="po po-arrow-left"></i>','<i class="po po-arrow-right"></i>'],
            "margin":0,
            "touchDrag":true,
            "responsive":{
                "0":{
                    "items":1
                },
                "480":{
                    "items":1
                },
                "768":{
                    "items":1
                },
                "992":{
                    "items":1
                },
                "1200":{
                    "items":1
                }
            },

        });

        $('#products-4-1-carousel-3 .owl-carousel').owlCarousel({
            "items":1,
            "nav":true,
            "slideSpeed":300,
            "dots":false,
            "rtl":is_rtl,
            "paginationSpeed":400,
            "navText":['<i class="po po-arrow-left"></i>','<i class="po po-arrow-right"></i>'],
            "margin":0,
            "touchDrag":true,
            "responsive":{
                "0":{
                    "items":1
                },
                "480":{
                    "items":1
                },
                "768":{
                    "items":1
                },
                "992":{
                    "items":1
                },
                "1200":{
                    "items":1
                }
            },

        });

		$('.section-products-with-gallery .owl-carousel').owlCarousel({
            "items":1,
            "nav":true,
            "slideSpeed":300,
            "dots":false,
            "rtl":is_rtl,
            "paginationSpeed":400,
            "navText":['<i class="po po-arrow-left-slider"></i>','<i class="po po-arrow-right-slider"></i>'],
            "margin":0,
            "touchDrag":true,
            "responsive":{
                "0":{
                    "items":1
                },
                "480":{
                    "items":1
                },
                "768":{
                    "items":1
                },
                "992":{
                    "items":1
                },
                "1200":{
                    "items":1
                }
            },

        });
    });

} )( jQuery );

/*===================================================================================*/
/*  HAND HELD HEADER/FOOTER
/*===================================================================================*/
( function() {
    var container, button, menu;

    container = document.getElementById( 'site-navigation' );
    if ( ! container ) {
        return;
    }

    button = container.getElementsByTagName( 'button' )[0];
    if ( 'undefined' === typeof button ) {
        return;
    }

    menu = container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof menu ) {
        button.style.display = 'none';
        return;
    }

    menu.setAttribute( 'aria-expanded', 'false' );

    if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
        menu.className += ' nav-menu';
    }

    button.onclick = function() {
        if ( -1 !== container.className.indexOf( 'toggled' ) ) {
            container.className = container.className.replace( ' toggled', '' );
            button.setAttribute( 'aria-expanded', 'false' );
            menu.setAttribute( 'aria-expanded', 'false' );
        } else {
            container.className += ' toggled';
            button.setAttribute( 'aria-expanded', 'true' );
            menu.setAttribute( 'aria-expanded', 'true' );
        }
    };

} )();