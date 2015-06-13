$(document).ready( function() {
    $('a').mouseenter(function(){
	$(this).animate({color:'red'}, 'fast');
    })
    $('a').mouseleave(function(){
	$(this).animate({color:'black'}, 'slow');
    })
    $('html').mousemove(function() {
	$('html').animate({backgroundColor:'#FFD1DC'}, 10000);
	$('html').animate({backgroundColor:'#D1FFF4'}, 10000);
	$('html').animate({backgroundColor:'#FFF4D1'}, 10000);
	$('html').animate({backgroundColor:'#F4D1FF'}, 10000);
	});
});
