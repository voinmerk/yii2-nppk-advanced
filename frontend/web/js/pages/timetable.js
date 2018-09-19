$(document).ready(function(){
    $('.sidebar li.list-group-item').click(function(){
    	if(menu_unblock == false) return false;

    	var group_id = $(this).attr('data-ajax');

    	$('.sidebar li.list-group-item').removeClass('active');
    	$(this).addClass('active');

        $.ajax({
			url: '/template/ajax/timetable.php',
			dataType: 'html',
			type: 'post',
			data: { 'group_id' : group_id },
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

		window.history.pushState('', '', '/timetable/group_'+group_id+'/');

        return false;
    });
});