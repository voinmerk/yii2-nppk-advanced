$(document).ready(function(){
	var timer1 = $.timer(timer_fun1, 30000, true);
	var el_vis = 1;
	
	function timer_fun1() {
		if(el_vis == 1) {
			$('#content').delay(700).css({'padding' : '0'});
			$('#home-banner > .flexslider > ul.slides').addClass('full');
			$('#header').fadeOut(700);
			
			el_vis = 0;
		}
	}
	
	$(window).mousemove(function(){
		if(el_vis == 0) {
			$('#header').fadeIn(700);
			$('#home-banner > .flexslider > ul.slides').removeClass('full');
			$('#content').delay(700).css({'padding' : ''});
			
			el_vis = 1;
		}
	});
});