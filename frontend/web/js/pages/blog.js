$(document).ready(function(){
    $('.sidebar li.list-group-item').click(function(){
    	if(menu_unblock == false) return false;

    	var template_name = $(this).attr('data-ajax');

    	$('.sidebar li.list-group-item').removeClass('active');
    	$(this).addClass('active');

        $.ajax({
			url: '/template/ajax/blog.php',
			dataType: 'html',
			type: 'post',
			data: { 'template_name' : template_name },
			beforeSend: function() {
				$('.ajax_loader.fixed').css({'display':'block'});
				menu_unblock = false;
			},
			complete: function() {
				
			},
			success: function(html) {
				$('.content').html(html);
				$('.ajax_loader.fixed').fadeOut(1000);
				menu_unblock = true;
			}
		});

		window.history.pushState('', '', '/blog/'+template_name+'/');

        return false;
    });
});