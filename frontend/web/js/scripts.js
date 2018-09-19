// GLOBAL VARS
var menu_unblock = true;

// LOADER/SPINNER
$(window).bind("load", function() {

	"use strict";
	
	$(".spn_hol").fadeOut(1000);
});

// Flexslider
$(window).load(function() {
    $('#gallery.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        start: function(slider){
            $('body').removeClass('loading');
        }
    });
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

// CHANGE LANGUAGES
/*$(document).ready(function(){
	$('#lang_change > ul > li > a').click(function(){
        var lang = $(this).attr('data-ajax');
        var page = $('body').attr('data-ajax');

        $.post('/template/ajax/change-lang.php', {lang_id : lang, page_id : page}, function(data){
            if(data != 0) {
                document.location.href = data;
            }
        });

        return false;
    });
});*/