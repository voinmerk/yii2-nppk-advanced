// GLOBAL VARS
var menu_unblock = true;

// LOADER/SPINNER
$(window).bind("load", function() {

	"use strict";
	
	$(".spn_hol").fadeOut(1000);
});

// Flexslider
$('#gallery.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails",
    start: function(slider){
        $('body').removeClass('loading');
    }
});

// WOW JS
$(document).ready(function() {
	
	"use strict";
	
	new WOW().init();
});

/// SMOOTH SCROLL
$(function() {
    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();   
        } else {
            $('#toTop').fadeOut();
        }
    });
 
    $('#toTop').click(function() {
        $('body,html').animate({scrollTop:0},800);
    }); 
});

// SITE MAIN SCRIPTS
$('#home-banner > .flexslider').flexslider({
    animation: "fade",
    controlNav: false,
    directionNav: false,
    multipleKeyboard: true,
});

$(document).ready(function() {
    /*$('.thumbnails').magnificPopup({
        delegate: 'a.thumbnail',
        type: 'image',
        removalDelay: 500,
        callbacks: {
            beforeOpen: function() {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        },
        closeOnContentClick: true,
        midClick: true
    });*/

    $('.ajax-popup').magnificPopup({
        type: 'ajax',
        alignTop: true,
        overflowY: 'scroll',
        fixedContentPos: true,
        fixedBgPos: true,
        closeBtnInside: true,
        preloader: true,
        removalDelay: 500,
        callbacks: {
            beforeOpen: function() {
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        },
        midClick: true
    });

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: true,
        centerMode: true,
        focusOnSelect: true
    });
});