function initPage() {
	initInputs();
}
// clear inputs on focus
function initInputs() {
	// replace options
	var opt = {
		clearInputs: true,
		clearTextareas: true,
		clearPasswords: true
	}
	// collect all items
	var inputs = [].concat(
		PlaceholderInput.convertToArray(document.getElementsByTagName('input')),
		PlaceholderInput.convertToArray(document.getElementsByTagName('textarea'))
	);
	// apply placeholder class on inputs
	for(var i = 0; i < inputs.length; i++) {
		if(inputs[i].className.indexOf('default') < 0) {
			var inputType = PlaceholderInput.getInputType(inputs[i]);
			if((opt.clearInputs && inputType === 'text') ||
				(opt.clearTextareas && inputType === 'textarea') || 
				(opt.clearPasswords && inputType === 'password')
			) {
				new PlaceholderInput({
					element:inputs[i],
					wrapWithElement:false,
					showUntilTyping:false,
					getParentByClass:false,
					placeholderAttr:'value'
				});
			}
		}
	}
}

// input type placeholder class
;(function(){
	PlaceholderInput = function() {
		this.options = {
			element:null,
			showUntilTyping:false,
			wrapWithElement:false,
			getParentByClass:false,
			placeholderAttr:'value',
			inputFocusClass:'focus',
			inputActiveClass:'text-active',
			parentFocusClass:'parent-focus',
			parentActiveClass:'parent-active',
			labelFocusClass:'label-focus',
			labelActiveClass:'label-active',
			fakeElementClass:'input-placeholder-text'
		}
		this.init.apply(this,arguments);
	}
	PlaceholderInput.convertToArray = function(collection) {
		var arr = [];
		for (var i = 0, ref = arr.length = collection.length; i < ref; i++) {
		 arr[i] = collection[i];
		}
		return arr;
	}
	PlaceholderInput.getInputType = function(input) {
		return (input.type ? input.type : input.tagName).toLowerCase();
	}
	PlaceholderInput.prototype = {
		init: function(opt) {
			this.setOptions(opt);
			if(this.element && this.element.PlaceholderInst) {
				this.element.PlaceholderInst.refreshClasses();
			} else {
				this.element.PlaceholderInst = this;
				if(this.elementType == 'text' || this.elementType == 'password' || this.elementType == 'textarea') {
					this.initElements();
					this.attachEvents();
					this.refreshClasses();
				}
			}
		},
		setOptions: function(opt) {
			for(var p in opt) {
				if(opt.hasOwnProperty(p)) {
					this.options[p] = opt[p];
				}
			}
			if(this.options.element) {
				this.element = this.options.element;
				this.elementType = PlaceholderInput.getInputType(this.element);
				this.wrapWithElement = (this.elementType === 'password' || this.options.showUntilTyping ? true : this.options.wrapWithElement);
				this.setOrigValue( this.options.placeholderAttr == 'value' ? this.element.defaultValue : this.element.getAttribute(this.options.placeholderAttr) );
			}
		},
		setOrigValue: function(value) {
			this.origValue = value;
		},
		initElements: function() {
			// create fake element if needed
			if(this.wrapWithElement) {
				this.element.value = '';
				this.element.removeAttribute(this.options.placeholderAttr);
				this.fakeElement = document.createElement('span');
				this.fakeElement.className = this.options.fakeElementClass;
				this.fakeElement.innerHTML += this.origValue;
				this.fakeElement.style.color = getStyle(this.element, 'color');
				this.fakeElement.style.position = 'absolute';
				this.element.parentNode.insertBefore(this.fakeElement, this.element);
			}
			// get input label
			if(this.element.id) {
				this.labels = document.getElementsByTagName('label');
				for(var i = 0; i < this.labels.length; i++) {
					if(this.labels[i].htmlFor === this.element.id) {
						this.labelFor = this.labels[i];
						break;
					}
				}
			}
			// get parent node (or parentNode by className)
			this.elementParent = this.element.parentNode;
			if(typeof this.options.getParentByClass === 'string') {
				var el = this.element;
				while(el.parentNode) {
					if(hasClass(el.parentNode, this.options.getParentByClass)) {
						this.elementParent = el.parentNode;
						break;
					} else {
						el = el.parentNode;
					}
				}
			}
		},
		attachEvents: function() {
			this.element.onfocus = bindScope(this.focusHandler, this);
			this.element.onblur = bindScope(this.blurHandler, this);
			if(this.options.showUntilTyping) {
				this.element.onkeydown = bindScope(this.typingHandler, this);
				this.element.onpaste = bindScope(this.typingHandler, this);
			}
			if(this.wrapWithElement) this.fakeElement.onclick = bindScope(this.focusSetter, this);
		},
		togglePlaceholderText: function(state) {
			if(this.wrapWithElement) {
				this.fakeElement.style.display = state ? '' : 'none';
			} else {
				this.element.value = state ? this.origValue : '';
			}
		},
		focusSetter: function() {
			this.element.focus();
		},
		focusHandler: function() {
			this.focused = true;
			if(!this.element.value.length || this.element.value === this.origValue) {
				if(!this.options.showUntilTyping) {
					this.togglePlaceholderText(false);
				}
			}
			this.refreshClasses();
		},
		blurHandler: function() {
			this.focused = false;
			if(!this.element.value.length || this.element.value === this.origValue) {
				this.togglePlaceholderText(true);
			}
			this.refreshClasses();
		},
		typingHandler: function() {
			setTimeout(bindScope(function(){
				if(this.element.value.length) {
					this.togglePlaceholderText(false);
					this.refreshClasses();
				}
			},this), 10);
		},
		refreshClasses: function() {
			this.textActive = this.focused || (this.element.value.length && this.element.value !== this.origValue);
			this.setStateClass(this.element, this.options.inputFocusClass,this.focused);
			this.setStateClass(this.elementParent, this.options.parentFocusClass,this.focused);
			this.setStateClass(this.labelFor, this.options.labelFocusClass,this.focused);
			this.setStateClass(this.element, this.options.inputActiveClass, this.textActive);
			this.setStateClass(this.elementParent, this.options.parentActiveClass, this.textActive);
			this.setStateClass(this.labelFor, this.options.labelActiveClass, this.textActive);
		},
		setStateClass: function(el,cls,state) {
			if(!el) return; else if(state) addClass(el,cls); else removeClass(el,cls);
		}
	}
	
	// utility functions
	function hasClass(el,cls) {
		return el.className ? el.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)')) : false;
	}
	function addClass(el,cls) {
		if (!hasClass(el,cls)) el.className += " "+cls;
	}
	function removeClass(el,cls) {
		if (hasClass(el,cls)) {el.className=el.className.replace(new RegExp('(\\s|^)'+cls+'(\\s|$)'),' ');}
	}
	function bindScope(f, scope) {
		return function() {return f.apply(scope, arguments)}
	}
	function getStyle(el, prop) {
		if (document.defaultView && document.defaultView.getComputedStyle) {
			return document.defaultView.getComputedStyle(el, null)[prop];
		} else if (el.currentStyle) {
			return el.currentStyle[prop];
		} else {
			return el.style[prop];
		}
	}
}());

if (window.addEventListener)
	window.addEventListener("load", initPage, false);
else if (window.attachEvent)
	window.attachEvent("onload", initPage);

/*
 * jQuery.appear
 * http://code.google.com/p/jquery-appear/
 *
 * Copyright (c) 2009 Michael Hixson
 * Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
*/
(function($){$.fn.appear=function(f,o){var s=$.extend({one:true},o);return this.each(function(){var t=$(this);t.appeared=false;if(!f){t.trigger('appear',s.data);return;}var w=$(window);var c=function(){if(!t.is(':visible')){t.appeared=false;return;}var a=w.scrollLeft();var b=w.scrollTop();var o=t.offset();var x=o.left;var y=o.top;if(y+t.height()>=b&&y<=b+w.height()&&x+t.width()>=a&&x<=a+w.width()){if(!t.appeared)t.trigger('appear',s.data);}else{t.appeared=false;}};var m=function(){t.appeared=true;if(s.one){w.unbind('scroll',c);var i=$.inArray(c,$.fn.appear.checks);if(i>=0)$.fn.appear.checks.splice(i,1);}f.apply(this,arguments);};if(s.one)t.one('appear',s.data,m);else t.bind('appear',s.data,m);w.scroll(c);$.fn.appear.checks.push(c);(c)();});};$.extend($.fn.appear,{checks:[],timeout:null,checkAll:function(){var l=$.fn.appear.checks.length;if(l>0)while(l--)($.fn.appear.checks[l])();},run:function(){if($.fn.appear.timeout)clearTimeout($.fn.appear.timeout);$.fn.appear.timeout=setTimeout($.fn.appear.checkAll,20);}});$.each(['append','prepend','after','before','attr','removeAttr','addClass','removeClass','toggleClass','remove','css','show','hide'],function(i,n){var u=$.fn[n];if(u){$.fn[n]=function(){var r=u.apply(this,arguments);$.fn.appear.run();return r;}}});})(jQuery);

jQuery(window).load(function() {
	jQuery('.portfolio-one .portfolio-wrapper').isotope({
		// options
		itemSelector: '.portfolio-item',
		layoutMode: 'straightDown'
	});

	jQuery('.portfolio-two .portfolio-wrapper, .portfolio-three .portfolio-wrapper, .portfolio-four .portfolio-wrapper').isotope({
		// options
		itemSelector: '.portfolio-item',
		layoutMode: 'fitRows'
	});
});
jQuery(document).ready(function($) {
	// Tabs
	//When page loads...
	$('.tabs-wrapper').each(function() {
		$(this).find(".tab_content").hide(); //Hide all content
		$(this).find("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$(this).find(".tab_content:first").show(); //Show first tab content
	});
	
	//On Click Event
	$("ul.tabs li").click(function(e) {
		$(this).parents('.tabs-wrapper').find("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(this).parents('.tabs-wrapper').find(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(this).parents('.tabs-wrapper').find(activeTab).fadeIn(); //Fade in the active ID content
		
		e.preventDefault();
	});
	
	$("ul.tabs li a").click(function(e) {
		e.preventDefault();
	})

	$('#footer .social-networks li, .share-box li, .social-icon, .social li').mouseenter(function(){
		$(this).find('.popup').fadeIn();
	});

	$('#footer .social-networks li, .share-box li, .social-icon, .social li').mouseleave(function(){
		$(this).find('.popup').fadeOut();
	});

	$('.clients-carousel').each(function() {
		$(this).elastislide({
		    imageW: 159,
		    margin: 13,
			border: 0,
			minItems:0,
			easing: 'easeInBack'
		});
	});

	$('.es-carousel-wrapper').each(function() {
		$(this).elastislide({
		    imageW: 180,
			margin: 44,
			border: 0,
			easing: 'easeInBack'
		});
	});

	$('.portfolio-tabs a').click(function(e){
		e.preventDefault();

		var selector = $(this).attr('data-filter');
		$('.portfolio-wrapper').isotope({ filter: selector });

		$(this).parents('ul').find('li').removeClass('active');
		$(this).parent().addClass('active');
	});

	$('.faq-tabs a').click(function(e){
		e.preventDefault();

		var selector = $(this).attr('data-filter');

		$('.faqs .portfolio-wrapper .faq-item').fadeOut();
		$('.faqs .portfolio-wrapper .faq-item'+selector).fadeIn();

		$(this).parents('ul').find('li').removeClass('active');
		$(this).parent().addClass('active');
	});

	$('.toggle-content').each(function() {
		if(!$(this).hasClass('default-open')){
			$(this).hide();
		}
	});

	$("h5.toggle").click(function(){
		if($(this).parents('.accordian').length >=1){
			var accordian = $(this).parents('.accordian');

			if($(this).hasClass('active')){
				$(accordian).find('h5.toggle').removeClass('active');
				$(accordian).find(".toggle-content").slideUp();
			} else {
				$(accordian).find('h5.toggle').removeClass('active');
				$(accordian).find(".toggle-content").slideUp();

				$(this).addClass('active');
				$(this).next(".toggle-content").slideToggle();
			}
		} else {
			if($(this).hasClass('active')){
				$(this).removeClass("active");
			}else{
				$(this).addClass("active");
			}
		}

		return false;
	});

	$("h5.toggle").click(function(){
		if(!$(this).parents('.accordian').length >=1){
			$(this).next(".toggle-content").slideToggle();
		}
	});
	
	// Scroll to Top
		if($(window).width() > 979) {        
			$(window).scroll(function() {
				if($(this).scrollTop() > 450) {
					$('#gotoTop').fadeIn();
				} else {
					$('#gotoTop').fadeOut();
				}
			});
			
			
			$('#gotoTop').click(function() {
				$('body,html').animate({scrollTop:0},400);
				return false;
			});
        
		}

	function isScrolledIntoView(elem)
	{
	    var docViewTop = $(window).scrollTop();
	    var docViewBottom = docViewTop + $(window).height();

	    var elemTop = $(elem).offset().top;
	    var elemBottom = elemTop + $(elem).height();

	    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
	}

	$('#progress-bars').appear(function() {
		$('.progress-bar').each(function() {
			var percentage = $(this).find('.progress-bar-content').data('percentage');
			$(this).find('.progress-bar-content').css('width', '0%');
			$(this).find('.progress-bar-content').animate({
				width: percentage+'%'
			}, '5000');
		});
	});

	$('.toggle-alert').click(function(e) {
		e.preventDefault();

		$(this).parents('.alert').slideUp();

	});

	// Create the dropdown base
	$('<select />').appendTo('.nav-holder');

	// Create default option 'Go to...'
	$('<option />', {
		'selected': 'selected',
		'value'   : '',
		'text'    : 'Go to...'
	}).appendTo('.nav-holder select');

	// Populate dropdown with menu items
	$('.nav-holder a').each(function() {
		var el = $(this);

		if($(el).parents('.sub-menu .sub-menu').length >= 1) {
			$('<option />', {
			 'value'   : el.attr('href'),
			 'text'    : '-- ' + el.text()
			}).appendTo('.nav-holder select');
		}
		else if($(el).parents('.sub-menu').length >= 1) {
			$('<option />', {
			 'value'   : el.attr('href'),
			 'text'    : '- ' + el.text()
			}).appendTo('.nav-holder select');
		}
		else {
			$('<option />', {
			 'value'   : el.attr('href'),
			 'text'    : el.text()
			}).appendTo('.nav-holder select');
		}
	});

	$('.nav-holder select').change(function() {
		window.location = $(this).find('option:selected').val();
	});

	$('.project-content .tabset,.post-content .tabset').each(function() {
		var menuWidth = $(this).width();
	    var menuItems = $(this).find('li').size();
	    var itemWidth = (menuWidth/menuItems);

	    $(this).css({'width': menuWidth +'px'});
	    $(this).find('li').css({'width': itemWidth +'px'});
	});

	$('#sidebar .tabset').each(function() {
		var menuWidth = $(this).width();
	    var menuItems = $(this).find('li').size();
	    var itemWidth = (menuWidth/menuItems)-2;

	    $(this).css({'width': menuWidth +'px'});
	    $(this).find('li').css({'width': itemWidth +'px'});
	});

	$('.side-nav li').each(function() {
		if($(this).find('> .children').length >=1) {
			$(this).find('> a').append('<span class="arrow"></span>');
		}
	});

	$('.side-nav li').mouseenter(function() {
		if($(this).find('> .children').length >= 1) {
			$(this).find('> .children').stop(true, true).slideDown();
		}
	});
	
	$('.side-nav li').mouseleave(function() {
		if(!$(this).find('.current_page_item').length) {
			$(this).find('.children').stop(true, true).slideUp();
		}
	});

	$('.side-nav .current_page_item').each(function() {
		if($(this).parent().hasClass('children')){
			$(this).parent().show();
		}
	});

	$('.content-boxes').each(function() {
		var cols = $(this).find('.col').length;
		$(this).addClass('columns-'+cols);
	});
});

 		topSocialExpander=function(){
            
            var windowWidth = jQuery(window).width();
        
            if( windowWidth > 767 ) {
                jQuery("#style_selector").show();                
            } else {                    
	            jQuery("#style_selector").hide();
            }
        
        };
		topSocialExpander();
        
        jQuery(window).resize(function() {
            topSocialExpander();
        });
 
		
jQuery(window).load(function() {
    jQuery('.flexslider').each(function() {
        var this_element = jQuery(this);
        var sliderSpeed = 800,
            sliderTimeout = parseInt(this_element.attr('data-interval'))*1000,
            sliderFx = this_element.attr('data-flex_fx'),
            slideshow = true;
        if ( (sliderTimeout == 0) || (!sliderTimeout) ) slideshow = false;

        this_element.flexslider({
            animation: sliderFx,
            slideshow: slideshow,
            slideshowSpeed: sliderTimeout,
            sliderSpeed: sliderSpeed,
            smoothHeight: false,
			directionNav: true,
			controlNav: false

        });
    });

});		