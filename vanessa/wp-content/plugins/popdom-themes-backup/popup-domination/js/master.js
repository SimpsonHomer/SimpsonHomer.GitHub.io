;(function($){
	$(document).ready(function(){
		$('.spacing').hover(function(){
			$(this).children('.slider').stop().animate({left:'0%'},{queue:false,duration:150});
		},function(){
			$(this).children('.slider').stop().animate({left:'100%'},{queue:false,duration:150});
		});
		
		$('.help').click(function(){
			$(this).parent().find('.popdom_contentbox_inside').toggle('height');
		});
		$('#message').css('margin-top','30px').css('width','920px');
		$('#message:visible').delay(6000).fadeOut();
	});
})(jQuery);