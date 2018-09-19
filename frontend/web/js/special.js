//------------------------------------------------------------------------------------------------------------------------
// Points

var sel_contrast = 0;
var sel_font = 0;
var sel_img = 1;

var spec_show = 0;

//------------------------------------------------------------------------------------------------------------------------
// Special Styles

var style_contrast = ['', 'comfortable/black-style.css','comfortable/white-style.css','comfortable/blue-style.css','comfortable/brown-style.css'];

//------------------------------------------------------------------------------------------------------------------------
// Special Function

// Panel Show/Hide
function special_panel() {
	if(spec_show == 0) {
		$('#spec_tools').fadeOut(700, function(){
			$('#footer').css({ 'padding' : '25px 0 25px 0' });
			$('.content, .sidebar').removeClass('sc-dop');
			special_refrash();
		});

		$('#spec_show').removeClass('active');
	} else {
		$('#spec_tools').fadeIn(700, function(){
			$('#footer').css({ 'padding' : '25px 0 75px 0' });
			$('.content, .sidebar').addClass('sc-dop');
		});

		$('#spec_show').addClass('active');
	}
}

// Image Off/On
function special_image() {
	$('a.thumbnail').each(function () {
		if(sel_img == 0) {
			$(this).css({ 'display' : 'none' });
		} else {
			$(this).css({ 'display' : 'block' });
		}
	});
}

// Fonts (0,1,2)
function special_fonts() {
	var normal_size = 0;
	var size = 0;
	
	if(sel_font > 0) {
		$('.content p, .content a, .content li, .content td, \
		   .sidebar p, .sidebar a, .sidebar li, .sidebar td, \
		   .content h1, .content h2, .content h3, \
		   .content h4, .content h5, .content h6, \
		   .teachers-page p, .teachers-page h1, .teachers-page h2, .teachers-page h3, .teachers-page a, #footer .nav > li > a').each(function(index) {
			if(!$(this).attr('original-font')) {
				normal_size = parseInt($(this).css('font-size'), 10);
				$(this).attr('original-font', normal_size);
			} else {
				normal_size = parseInt($(this).attr('original-font'));
			}
			
			size = parseInt(sel_font, 10);
			size = normal_size + (size * 2);
			
			$(this).css({ 'font-size' : size + 'px' });
		});
	} else {
		$('*').each(function() {
			$(this).css({ 'font-size' : '' });
		});
	}
}

function special_refrash() {

	if(sel_contrast > 0) {
		$('li.sp-contrast > a').removeClass('active');
		$('#spec_contrast_0').addClass('active');

		sel_contrast = 0;

		if($('#special-style')) $('#special-style').remove();
		$('head').append('<link href="/web/css/' + style_contrast[sel_contrast] + '" id="special-style" rel="stylesheet" type="text/css" />');

		$.cookie('special-select-contrast', sel_contrast, { path: '/' });
	}

	if(sel_font > 0) {
		$('li.sp-font > a').removeClass('active');
		$('#spec_font_0').addClass('active');

		$('*').each(function() {
			$(this).css({ 'font-size' : '' });
		});

		sel_font = 0;

		$.cookie('special-select-font', sel_font, { path: '/' });
	}

	if(sel_img == 0) {
		$('a.thumbnail').each(function () {
			if($(this).css('display')=='none') {
				$(this).css({ 'display' : 'block' });

				sel_img = 1;

				$.cookie('special-select-image', sel_img, { path: '/' });
			}
		});

		$('#spec_image_0').html(lang_hide);
	}
}

//------------------------------------------------------------------------------------------------------------------------
// Загрузка страницы

// Special Panel
if($.cookie('special-show')) {
	spec_show = $.cookie('special-show');
}

if(spec_show == 0) {
	$('#spec_tools').css('display', 'none');
} else {
	special_panel();
}

// Contrast
if($.cookie('special-select-contrast')) {
	sel_contrast = $.cookie('special-select-contrast');
}

$('li.sp-contrast > a').removeClass('active');
$('#spec_contrast_'+sel_contrast).addClass('active');

if($('#special-style')) $('#special-style').remove();
$('head').append('<link href="/web/css/' + style_contrast[sel_contrast] + '" id="special-style" rel="stylesheet" type="text/css" />');

// Font
if($.cookie('special-select-font')) {
	sel_font = $.cookie('special-select-font');
}

$('li.sp-font > a').removeClass('active');
$('#spec_font_'+sel_font).addClass('active');

special_fonts();

// Image Off/On
if($.cookie('special-select-image')) {
	sel_img = $.cookie('special-select-image');
}

if(sel_img == 0) $('li.sp-img > a').html(lang_show);
else $('li.sp-img > a').html(lang_hide);

special_image();


//------------------------------------------------------------------------------------------------------------------------
// Управление элементами

$(document).ready(function(){
	
	// Panel Show/Hide
	$('#spec_show').on('click', function(){
		if(spec_show == 0)
		{
			spec_show = 1;
			$('#spec_show').addClass('active');
		}
		else
		{
			spec_show = 0;
			$('#spec_show').removeClass('active');
		}

		$.cookie('special-show', spec_show, { path: '/' });
		
		special_panel();

		return false;
	});

	// Contrast (0,1,2,3,4)
	$('li.sp-contrast > a').click(function(){
		$('li.sp-contrast > a').removeClass('active');
		$(this).addClass('active');
		
		sel_contrast = $(this).attr('spec-number');
		
		if(style_contrast[sel_contrast] == '') {

			if($('#special-style')) $('#special-style').remove();

		} else {
			if($('#special-style')) $('#special-style').remove();

			$('head').append('<link href="/web/css/' + style_contrast[sel_contrast] + '" id="special-style" rel="stylesheet" type="text/css" />');
		}
		
		$.cookie('special-select-contrast', sel_contrast, { path: '/' });

		return false;
	});

	// Font (0,1,2)
	$('li.sp-font > a').click(function(){
		$('li.sp-font > a').removeClass('active');
		$(this).addClass('active');
		
		sel_font = $(this).attr('spec-number');
		
		special_fonts();
		
		$.cookie('special-select-font', sel_font, { path: '/' });
		
		return false;
	});

	// Image Off/On
	$('li.sp-img > a').click(function(){
		if(sel_img == 0) sel_img = 1;
		else sel_img = 0;
		
		if(sel_img == 0) $(this).html(lang_show);
		else $(this).html(lang_hide);
		
		special_image();
		
		$.cookie('special-select-image', sel_img, { path: '/' });
		
		return false;
	});
});