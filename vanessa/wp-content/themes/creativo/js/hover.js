(function($){
	$(document).ready(function(){
		var $gallery_image1 = $('.one-fourth');	$gallery_image2 = $('.one-third'); $gallery_image3 = $('.one-half');$gallery_image4 = $('.full'); $gallery_image5 = $('.one-fifth'); $gallery_image6 = $('.full-blog');	$gallery_image7 = $('.one-fourth-recent');				
		$gallery_image1.find('a').hover( function(){
			$(this).find('.gallery_zoom').css( { 'display' : 'block', 'opacity' : 0 } ).stop(true,true).fadeTo( 400, 0.8 );
		}, function(){
			$(this).find('.gallery_zoom').stop(true,true).fadeTo( 400, 0 );
		} );
		$gallery_image2.find('a').hover( function(){
			$(this).find('.gallery_zoom').css( { 'display' : 'block', 'opacity' : 0 } ).stop(true,true).fadeTo( 400, 0.8 );
		}, function(){
			$(this).find('.gallery_zoom').stop(true,true).fadeTo( 400, 0 );
		} );
		$gallery_image3.find('a').hover( function(){
			$(this).find('.gallery_zoom').css( { 'display' : 'block', 'opacity' : 0 } ).stop(true,true).fadeTo( 400, 0.8 );
		}, function(){
			$(this).find('.gallery_zoom').stop(true,true).fadeTo( 400, 0 );
		} );
		$gallery_image4.find('a').hover( function(){
			$(this).find('.gallery_zoom').css( { 'display' : 'block', 'opacity' : 0 } ).stop(true,true).fadeTo( 400, 0.8 );
		}, function(){
			$(this).find('.gallery_zoom').stop(true,true).fadeTo( 400, 0 );
		} );
		$gallery_image5.find('a').hover( function(){
			$(this).find('.gallery_zoom').css( { 'display' : 'block', 'opacity' : 0 } ).stop(true,true).fadeTo( 400, 0.8 );
		}, function(){
			$(this).find('.gallery_zoom').stop(true,true).fadeTo( 400, 0 );
		} );
		$gallery_image6.find('a').hover( function(){
			$(this).find('.gallery_zoom').css( { 'display' : 'block', 'opacity' : 0 } ).stop(true,true).fadeTo( 400, 0.8 );
		}, function(){
			$(this).find('.gallery_zoom').stop(true,true).fadeTo( 400, 0 );
		} );
		$gallery_image7.find('a').hover( function(){
			$(this).find('.gallery_zoom').css( { 'display' : 'block', 'opacity' : 0 } ).stop(true,true).fadeTo( 400, 0.8 );
		}, function(){
			$(this).find('.gallery_zoom').stop(true,true).fadeTo( 400, 0 );
		} );
	});
    

})(jQuery)