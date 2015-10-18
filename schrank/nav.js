var winhgt = $(window).height();
$(document).ready(function(){
  $('#scroll1').click(function(){
    $('html, body').animate({scrollTop:winhgt},'slow');
  });
  $('#scroll2').click(function(){
    $('html, body').animate({scrollTop:winhgt * 2},'slow');
  });
  
  $('#scroll3').click(function(){
    $('html, body').animate({scrollTop:winhgt * 4},'slow');
  });
  $('#scroll4').click(function(){
    $('html, body').animate({scrollTop:winhgt * 5},'slow');
  });
  $(window).scroll(function(){
	$('.fade').each(function(){
	  var obj_bottom = $(this).position().top + $(this).outerHeight();
	  var win_bottom = $(window).scrollTop() + $(window).height();
	
	  if (win_bottom > obj_bottom){
		$(this).animate({'opacity':'1'}, 200);
	}
	});
  });
});