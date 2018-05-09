function em_search_bar(){
	jQuery(".search-input").val('Search');
	searchinput = jQuery(".search-input"),
	searchvalue = searchinput.val();
	searchinput.on('click', function(){
		if (jQuery(this).val() === searchvalue) jQuery(this).val("");
	});
	searchinput.blur(function(){
		if (jQuery(this).val() === "") jQuery(this).val(searchvalue);
	});
}
// **********************************************************************// 
// ! Full width section
// **********************************************************************//
function em_sections(){ 
	jQuery('.em_section, .stripe-style-full').each(function(){
		
		if( !jQuery('body').hasClass('rtl') ){
			jQuery(this).css({'left': ''});
			jQuery(this).css({
				'width': jQuery('body').width(),
				'left': - (jQuery(this).offset().left),
				'visibility': 'visible',
				'position': 'relative'
			});
		}
		else{
			jQuery(this).css({'left': 'auto'});
			jQuery(this).css({'right': 'auto'});
			var rt = (jQuery(window).width() - (jQuery(this).offset().left + jQuery(this).outerWidth()));
			jQuery(this).css({
				'right': - (rt),
				'width': jQuery(window).width(),
				'visibility': 'visible',
				'position': 'relative'
			});
		}
		
		var min_hei = jQuery(this).attr('data-min-height');
		jQuery(this).css({"min-height": min_hei});
		
		var videoTag = jQuery(this).find('.section-back-video video');
		videoTag.css({
			'width': jQuery(window).width()
		});
	});
}
function dataAnimate(){
	jQuery('[data-animate]').appear();
	
	jQuery('body').on('appear', '[data-animate]', function(event, elements) {
		elements.each( function( index ) {
			var elemet = jQuery(this);
			var toAnimateDelay = jQuery(this).attr('data-delay');
			var toAnimateDelayTime = 0;
			if( toAnimateDelay ) { toAnimateDelayTime = Number( toAnimateDelay ); } else { toAnimateDelayTime = 200; }
			if( !jQuery(this).hasClass('animated') ) {
				var elementAnimation = jQuery(this).attr('data-animate');
				
				setTimeout(function() {
					console.log(toAnimateDelayTime);
					elemet.removeClass('not-animated').addClass( elementAnimation + ' animated');
				}, toAnimateDelayTime);
			}
		});
    });
}

function videoAppear(){
	
	jQuery('.video_appear').appear();
	
	jQuery('body').on('appear', '.video_appear', function(event, elements) {
		elements.each( function( index ) {
			var id = jQuery(this).data('id');
			var video_e = document.getElementById( id+'_v');
			if(jQuery(this).hasClass('pause')){
				jQuery(this).removeClass('pause').addClass('play');
				if(video_e.paused) {
					video_e.play();
				}
			}
		});
    });
	
	jQuery('body').on('disappear', '.video_appear', function(event, elements) {
		elements.each( function( index ) {
			var id = jQuery(this).data('id');
			var video_e = document.getElementById( id+'_v');
			if(jQuery(this).hasClass('play')){
				jQuery(this).removeClass('play').addClass('pause');
				if(!video_e.paused) {
					video_e.pause();
				}
			}
		});
    });
	
}


if (typeof checkIfTouchDevice != 'function') { 
    function checkIfTouchDevice(){
        touchDevice = !!("ontouchstart" in window) ? 1 : 0; 
		if( jQuery.browser.wd_mobile ) {
			touchDevice = 1;
		}
		return touchDevice;      
    }
}

function get_layout_config( container_width, number_item){
	ret_value = new Array(283,'100%',number_item);
	if( container_width >= 960 ){
		var _num_show = Math.min(number_item,4);
		ret_value[1] = _num_show*25 + "%";
		ret_value[2] = _num_show;
		return ret_value;
	}
	if( container_width > 600 && container_width < 960 ){
		var _num_show = Math.min(number_item,3);
		ret_value[0] = 380;
		ret_value[1] = _num_show*33.3333333333 + "%";
		ret_value[2] = _num_show;
		return ret_value;
	}
	if( container_width <= 600 && container_width > 380 ){
		ret_value[0] = 380;
		var _num_show = Math.min(number_item,2);
		ret_value[1] = _num_show*50 + "%";
		ret_value[2] = _num_show;
		return ret_value;
	}
	if( container_width < 380 ){
		ret_value[2] = 1;
	}
	//ret_value[0] = 380;
	return ret_value;
}

function number_animate(val_){
	var	text	= jQuery(val_),endVal	= 0,currVal	= 0,obj	= {};
	var value = jQuery(val_).text();
	obj.getTextVal = function() {
		return parseInt(currVal, 10);
	};

	obj.setTextVal = function(val) {
		currVal = parseInt(val, 10);
		text.text(currVal);
	};

	obj.setTextVal(0);
	currVal = 0; // Reset this every time
	endVal = value;

	TweenLite.to(obj, 2, {setTextVal: endVal, ease: Power2.easeInOut});
}

function sticky_main_menu( on_touch ){
		var _topSpacing = 0;
		if( jQuery('body').hasClass('logged-in') && jQuery('body').hasClass('admin-bar') && jQuery('#wpadminbar').length > 0 ){
			_topSpacing = jQuery('#wpadminbar').height();
		}
		if( !on_touch && jQuery(window).width() > 1024 ){
			jQuery("#header.header_v1, #header.header_v2, #header.header_v3").sticky({topSpacing: _topSpacing});
		}
}



function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

function set_header_bottom(){
    var header_height = jQuery(window).innerHeight();
	var temp = 1;
    
	if(jQuery(".wd_fullwidth_slider_wrapper").length > 0 ){
		if(jQuery("div#wpadminbar").length > 0) {
			jQuery("div#template-wrapper").css("margin-top","-32px");
			//temp = temp + jQuery("div#wpadminbar").height();
		   
		}
		jQuery(".wd_fullwidth_slider_wrapper").height(header_height - temp +"px");		
	}
}

function set_cloud_zoom(){
	var clz_width = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').width();
	var clz_img_width = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').children('img').width();
	var cl_zoom = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').not('.on_pc');
	var temp = (clz_width-clz_img_width)/2;
	if(cl_zoom.length > 0 ){
		cl_zoom.data('zoom',null).siblings('.mousetrap').unbind().remove();
		cl_zoom.CloudZoom({ 
			adjustX:temp	
		});
	}
}
function onSizeChange(windowWidth){

	if( windowWidth >= 768 ) {
		jQuery('a.block-control').removeClass('active').hide();
		jQuery('a.block-control').parent().siblings().show();
		if( jQuery('.toggle-menu-wrapper').hasClass('active') ){
			TweenMax.to( jQuery('.toggle-menu-wrapper'), 0, { css:{ width:"0px",height:"0px"},  ease:Sine.easeInOut });
			TweenMax.to( jQuery('.wd-content,.phone-header-bar-wrapper'), 0, { css:{ left:"0px"},  ease:Sine.easeInOut });
			jQuery('.toggle-menu-wrapper').toggleClass('active');	
		}
	}
	if( windowWidth < 768 ) {
		jQuery('a.block-control').each(function(index){
			if(jQuery(this).hasClass('open_def')) {
				jQuery(this).removeClass('active').addClass('touchDevice').addClass('active').show();
				//jQuery(this).parent().siblings().show();
			} else {
				jQuery(this).removeClass('active').addClass('touchDevice').show();
				jQuery(this).parent().siblings().hide();
			}
		});
		
	}		
}

function custom_mobile_menu(){
    var _li_have_sub_menu_mobile = jQuery(".toggle-menu-wrapper .mobile-main-menu ul.menu ul.sub-menu").parents("li");
    var _button_toggle_menu_html = "<span class='menu-drop-icon-mobile'></span>";
    jQuery(_button_toggle_menu_html).insertAfter(_li_have_sub_menu_mobile.find("a:first"));
    jQuery(".toggle-menu-wrapper .mobile-main-menu ul.menu li.current-menu-item").parents("ul.sub-menu").show();
    jQuery(".toggle-menu-wrapper .mobile-main-menu ul.menu li.current-menu-item").parents("ul.sub-menu").prev().addClass("active");
    jQuery(".toggle-menu-wrapper .mobile-main-menu ul.menu span.menu-drop-icon-mobile").bind("click",function(){
        if(!jQuery(this).hasClass("active")){
            jQuery(this).parents("li:first").find("ul.sub-menu:first").slideDown("slow",function(){toggle_menu_open();});
            jQuery(this).addClass("active");
        }
        else{
            jQuery(this).parents("li:first").find("ul.sub-menu:first").slideUp("slow",function(){toggle_menu_open();});
            jQuery(this).find("ul.sub-menu").hide();
            jQuery(this).removeClass("active");
        }
		
    });
}

function tab_slider(windowWidth){
	var on_touch = checkIfTouchDevice();
	var _bind = 'click';
	if(on_touch & windowWidth >= 768 && windowWidth <= 1024){  // event for ipad
		_bind = 'mouseenter';
	}
	/*mouseenter click.tab.data-api mousedown*/
	jQuery('.wpb_tabs > div > ul.wpb_tabs_nav > li > a').bind(_bind,function(e){
		if(jQuery(this).parent('li').hasClass('active'))	
			return;
		var temp = jQuery(this).attr('href'); //tab select content
		if(jQuery(this).closest('.wpb_tabs').hasClass('has_slider')){
			var doc = jQuery(temp).find('.featured_product_slider_wrapper');
			if(doc.length > 0 ) {	
				var id_shortcode =  doc.attr('id');
				setTimeout(function(){
					jQuery('.wpb_tabs.has_slider #' + id_shortcode).find("div.products").trigger('destroy',true);
					//jQuery("#" + id_shortcode + " div.products").carouFredSel();
					jQuery('.wpb_tabs.has_slider').trigger('tabs_change',[id_shortcode]);
				},200);
			}	
		}
	});
}

function change_cart_items_mobile(){
	var _cart_items = parseInt(jQuery( "#cart_size_value_head" ).text());
	_cart_items = isNaN(_cart_items) ? 0 : _cart_items;
	jQuery('.mobile_cart_container > .mobile_cart_number').text(_cart_items);
}

function home_parallax(){
	if(jQuery(".wd_animate").length > 0 ){
		jQuery(".wd_animate").appear();
	}
}
function toggle_menu_open(){
	var admin_bar_height = 0;
	if( jQuery('#wpadminbar').length > 0 ){
		admin_bar_height = jQuery('#wpadminbar').height(); 
	}
	
	jQuery('.toggle-menu-wrapper').css({'top': admin_bar_height});
	jQuery(window).scroll(function(){
		var window_width = jQuery(window).width();
		if( jQuery(this).scrollTop() == 0 || window_width >= 600 ){
			jQuery('.toggle-menu-wrapper').css({'top': admin_bar_height});
		}
		else{
			jQuery('.toggle-menu-wrapper').css({'top': 0});
		}
	});
	
	var window_height = jQuery(window).height();
	
	jQuery(".mobile-main-menu.toggle-menu").css({'height': window_height - 60 - admin_bar_height, 'overflow-y': 'auto'});
}
function toggle_menu_close(){
	//jQuery("#template-wrapper").removeClass("toggle-menu");
	//jQuery("#footer").removeClass("toggle-menu");
	//jQuery(".body-wrapper").css({"height":"auto"});
}



function wd_custom_yith_compare(){
	if( typeof yith_woocompare !== "object" )
		return;
	jQuery("#cboxOverlay, #cboxClose").live("click",function(){
		jQuery('body').trigger('added_to_cart');
	});
}

jQuery(document).ready(function($) {
		"use strict";
		jQuery('.right-content')
					.theiaStickySidebar({
						additionalMarginTop: 30
					});
		  $("body.home" ).find("#template-wrapper").css("margin-bottom", $("#footer").outerHeight());
		/********************** menu phone ***************************/
		toggle_menu_open();
		jQuery('.toggle-menu-control-open,.toggle-menu-control-close, .page-gray-box').on('click', function(){
			if( !jQuery('.toggle-menu-wrapper').hasClass('active') ){
				jQuery('.toggle-menu-wrapper').css({"width":"80%"});
				jQuery('.page-gray-box').show().animate({'opacity': 1}, 650);
			}else{
				jQuery('.page-gray-box').hide().css('opacity', 0);
			}
			jQuery('.toggle-menu-wrapper').toggleClass('active');
			jQuery('#template-wrapper,.phone-header-bar-wrapper').toggleClass('mb_active');
			jQuery('.phone-header').toggleClass('mb_active');
		});		
		custom_mobile_menu();
		
		/********************** end menu phone ***************************/
		
		
		/********************** one pages ***************************/
		
		
		var on_touch = checkIfTouchDevice();
		
		if (jQuery.browser.msie && jQuery.browser.version <= 10) {
			jQuery("html").addClass('ie' + parseInt(jQuery.browser.version) + " ie");
		} else {
			if (jQuery("html").attr('id') == 'wd_ie' && jQuery.browser.version == 11) {
				jQuery("html").addClass("ie11 ie");
			}
		}

		/*************** Start Woo Add On *****************/
        //social
        jQuery("ul.social-share > li > a > span").css("position","relative").css('display', 'inline-block').css("left","500px").css("visibility","0");
		jQuery("ul.social-share > li > a > span").each(function(index,value){
			TweenMax.to( jQuery(value),0.0, { css:{left:"0px",opacity:1 },  ease:Power2.easeInOut ,delay:index*0.9});
		});
		
		jQuery('#lang_sel > ul > li').hoverIntent(
			function(){
				jQuery(this).children('ul').slideDown(100);
			}
			,function(){
				jQuery(this).children('ul').slideUp(100);
			}
		
		);
		
		jQuery('.widget_icl_lang_sel_widget').hoverIntent(
			function(){
				//jQuery(this).children('.drop_down_container').slideDown(300);
				jQuery(this).find('ul li ul').slideDown(100);
			}
			,function(){
				//jQuery(this).children('.drop_down_container').slideUp(0);
				jQuery(this).find('ul li ul').slideUp(100);
			}
		
		);
		
		setTimeout(function () {
			jQuery("div.shipping-calculator-form").show(400);
		}, 1500);
		
		
		jQuery("select.wd_search_product").select2();
		jQuery('.header_search, .wd_hot_product').addClass("show");
		//jQuery("select.deference_color").select2();
        
        /***** W3 Total Cache & Wp Super Cache Fix *****/
        jQuery('body').trigger('added_to_cart');
        /***** End Fix *****/
        
		/***** Start Re-init Cloudzoom on Variation Product  *****/
		jQuery('form.variations_form').live('found_variation',function( event, variation ){
			jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').CloudZoom({}); 
		}).live('reset_image',function(){
			jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').CloudZoom({}); 
		});
		/***** End Re-init Cloudzoom on Variation Product  *****/        
        
        /*************** End Woo Add On *****************/
        
        /*************** Disable QS in Main Menu *****************/
        jQuery('ul.menu').find('ul.products').addClass('no_quickshop');
        /*************** Disable QS in Main Menu *****************/
		
		
		if (jQuery.browser.msie && ( parseInt( jQuery.browser.version, 10 ) == 7 )){
			alert("Your browser is too old to view this interactive experience. You should take the next 30 seconds or so and upgrade your browser! We promise you'll thank us after doing so in having a much better and safer web browsing experience! ");
		}

		
		/*em_sections();*/
		em_search_bar();
		var windowWidth = jQuery(window).width();
		
		setTimeout(function () {
			  onSizeChange(windowWidth);
		}, 1000);	
		
        jQuery(document).on('click','a.block-control.touchDevice, a.block-control.touchDevice + h3.heading-title',function(){
            jQuery(this).parent().siblings().slideToggle(300);
            jQuery(this).toggleClass('active');
            return false;
        });
		jQuery('.ts-group-meta-icon-toggle').unbind('click');
		jQuery('.ts-group-meta-icon-toggle').bind('click', function(){
			jQuery('.group-meta-header').slideToggle(600);
			jQuery(this).toggleClass('active');
		});
	
		jQuery('.related-slider').flexslider({
			animation: "slide"
		});
		
		jQuery('li.shortcode').hover(function(){
			jQuery(this).addClass('shortcode_hover')},function(){jQuery(this).removeClass('shortcode_hover');});
		

		//call review form
		jQuery('.wd-review-link').on('click', function(){
			if(jQuery('.woocommerce-tabs').length > 0){
				jQuery('.woocommerce-tabs li.reviews_tab').children('a').trigger('click');
			}
		}).trigger('click');
		
		////////// Generate Tab System /////////
		if(jQuery('.tabs-style').length > 0){
			jQuery('.tabs-style').each(function(){
				var ul = jQuery('<ul></ul>');
				var divPanel = jQuery('<div></div>');
				var liChildren = jQuery(this).find('li.tab-item');
				var length = liChildren.length;
				divPanel.addClass('panel');
				jQuery(this).find('li.tab-item').each(function(index){
					jQuery(this).children('div').appendTo(divPanel);
					if(index == 0)
						jQuery(this).addClass('first');
					if(index == length - 1)
						jQuery(this).addClass('last');
					jQuery(this).appendTo(ul);
					
				});
				jQuery(this).append(ul);
				jQuery(this).append(divPanel);
				
					jQuery( this ).tabs({ fx: { opacity: 'toggle', duration:'slow'} }).addClass( 'ui-tabs-vertical ui-helper-clearfix' );
				
			});		
		}
		

		
		// Toggle effect for ew_toggle shortcode
		jQuery( '.toggle_container a.toggle_control' ).click(function(){
			if(jQuery(this).parent().parent().parent().hasClass('show')){
				jQuery(this).parent().parent().parent().removeClass('show');
				jQuery(this).parent().parent().parent().addClass('hide');
				jQuery(this).parent().parent().children('.toggle_content ').hide('slow');
			}
			else{
				jQuery(this).parent().parent().parent().addClass('show');
				jQuery(this).parent().parent().parent().removeClass('hide');
				jQuery(this).parent().parent().children('.toggle_content ').show('slow');
			}
				
		});
		
        
        // **********************************************************************// 
		// ! Parallax
		// **********************************************************************// 
		
		if(on_touch == 0){
			$('.stripe-parallax-bg, .fancy-parallax-bg').each(function(){
				var $_this = $(this),
					fixed_prl = $_this.data("prlx-fixed"),
					speed_prl = $_this.data("prlx-speed");
				
				if(fixed_prl == "true"){
					$_this.css({
						'background-position': '50% 0px',
						'background-repeat': 'no-repeat',
						'background-attachment': 'fixed'
					});
				}
				else{
					$(this).parallax("50%", speed_prl);
					$('.stripe-parallax-bg').addClass("parallax-bg-done");
				}
			});
		};
		
        //fancy box
        var fancy_wd = jQuery("a.fancybox").fancybox({
			// 'openEffect'	: 'elastic'
			// ,'closeEffect'	: 'elastic'
			// ,'openEasing'   : 'easeOutBack'
			// ,'closeEasing'  : 'easeOutBack'
			// ,'nextEasing'   : 'easeOutBack'
			// ,'prevEasing'	: 'easeOutBack'		
			// 'openSpeed'    : 500
			// ,'openSpeed'	: 500
			// ,'nextSpeed'	: 1000
			// ,'prevSpeed'    : 1000
			'scrolling'	: 'no'
			,'mouseWheel'	: false

			,beforeLoad  : function(){
					var tmp_href = this.href;
					if( this.href.indexOf('youtube.com') >= 0 || this.href.indexOf('youtu.be') >= 0 ){
						this.type = 'iframe';
						this.scrolling = 'no';
						//&html5=1&wmode=opaque
						this.href = this.href.replace(new RegExp("watch\\?v=", "i"), 'embed/') + '?autoplay=1';
					}
					else if( this.href.indexOf('vimeo.com') >= 0 ){
						this.type = 'iframe';
						this.scrolling = 'no';					
						//this.href = this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1') + '&autoplay=1';
						var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
						var match = this.href.match(regExp);
						this.href = 'http://player.vimeo.com/video/' + match[2] + '?portrait=0&color=ffffff';
					}
					else{
						//this.type = null;
					}
					
					
			}
			,afterClose : function(){
					this.href = tmp_href;
			}		
			,afterShow  : function(){
				jQuery('.fancybox-wrap').wipetouch({
					tapToClick: true, // if user taps the screen, triggers a click event
					wipeLeft: function(result) { 
						jQuery.fancybox.next();
					},
					wipeRight: function(result) {
						jQuery.fancybox.prev();
					}
				});					
				if( jQuery('.fancybox-prev-clone').length <= 0 )
					jQuery('.fancybox-prev').clone().removeClass('fancybox-nav fancybox-prev').addClass('fancybox-prev-clone').appendTo(".fancybox-overlay");
				
				if( jQuery('.fancybox-next-clone').length <= 0 )
					jQuery('.fancybox-next').clone().removeClass('fancybox-nav fancybox-next').addClass('fancybox-next-clone').appendTo(".fancybox-overlay");
				
				if( jQuery('.fancybox-close-clone').length <= 0 )
					jQuery('.fancybox-close').clone().removeClass('fancybox-item fancybox-close').addClass('fancybox-close-clone').appendTo(".fancybox-overlay");
			
				if( jQuery('.fancybox-title-clone').length <= 0 )
					jQuery('.fancybox-title').clone().addClass('fancybox-title-clone').appendTo(".fancybox-overlay");
				else{
					jQuery('.fancybox-title-clone').html( jQuery('.fancybox-wrap').find('.fancybox-title').html() );
				}	
				jQuery('.fancybox-wrap').find('.fancybox-title').hide();				
				
				jQuery('.fancybox-wrap').find('.fancybox-prev').hide();
				jQuery('.fancybox-wrap').find('.fancybox-next').hide();
				jQuery('.fancybox-wrap').find('.fancybox-close').hide();
				
			}			
			
		}); 
        
        jQuery('.fancybox-prev-clone').live('click',function(){
			jQuery('.fancybox-wrap').find('.fancybox-prev').trigger('click');
		});
		jQuery('.fancybox-next-clone').live('click',function(){
			jQuery('.fancybox-wrap').find('.fancybox-next').trigger('click');
		});
		jQuery('.fancybox-close-clone').live('click',function(){
			jQuery('.fancybox-wrap').find('.fancybox-close').trigger('click');
		});
        
        

		jQuery('p:empty').remove();
		
		// button state demo
		jQuery('.btn-loading')
		  .on('click', function () {
			var btn = jQuery(this)
			btn.button('loading')
			setTimeout(function () {
			  btn.button('reset')
			}, 3000)
		  });
		
		// tooltip 
		jQuery('body').tooltip({
		  selector: "a[rel=tooltip]"
		});
	 
		jQuery('.view_full a').on('click', function(event){
			event.preventDefault();
			jQuery('meta[name="viewport"]').remove();
		});
		
		if( jQuery('html').offset().top < 100 ){
			jQuery("#to-top").hide();
		}
		jQuery(window).scroll(function () {
			
			if (jQuery(this).scrollTop() > 100) {
				jQuery("#to-top").fadeIn();
			} else {
				jQuery("#to-top").fadeOut();
			}
		});
		jQuery('.scroll-button').on('click', function(){
			jQuery('body,html').animate({
			scrollTop: '0px'
			}, 1000);
			return false;
		});			

		
		jQuery('#myTab a').on('click', function (e) {
			e.preventDefault();
			jQuery(this).tab('show');
		});
	
		
		//sticker block
		if(jQuery('.wd_sticker').length){		
			jQuery('.wd_sticker').csTicker({
				tickerTitle: 'Hot News',
				tickerMode:'mini',
				speed: 600,
				autoAnimate: true
			});	
		}	

		
		var touch = false;
		  /* DETECT PLATFORM */
		  jQuery.support.touch = 'ontouchend' in document;
		  
		  if (jQuery.support.touch) {
			touch = true;
			jQuery('body').addClass('touch');
		  }
		  else{
			jQuery('body').addClass('notouch');
		  }
		  
		  if(touch == false){
			dataAnimate();
			videoAppear();
		  }	
		
		
		jQuery('.carousel').each(function(index,value){
			jQuery(value).wipetouch({
				tapToClick: false, // if user taps the screen, triggers a click event
				wipeLeft: function(result) { 
					jQuery(value).find('a.carousel-control.right').trigger('click');
					//jQuery(value).carousel('next');
				},
				wipeRight: function(result) {
					jQuery(value).find('a.carousel-control.left').trigger('click');
					//jQuery(value).carousel('prev');
				}
			});	
		});
		
		
		// jQuery("ul.social-share > li > a > span").css("position","relative").css("right","500px").css("opacity","0");
		// jQuery("ul.social-share > li > a > span").each(function(index,value){
			// TweenMax.to( jQuery(value), 0.9, { css:{ right:"0px",opacity:1 },  ease:Power2.easeInOut ,delay:index*0.9});
		// });
		
        set_cloud_zoom();
		set_header_bottom();
		// Set menu on top
		if(typeof(_enable_sticky_menu) != "undefined"){
			if(_enable_sticky_menu==1)
				sticky_main_menu( on_touch );
		}
		else{
			sticky_main_menu( on_touch );
		}
		if( on_touch == 0 ){
			jQuery(window).bind('resize',jQuery.throttle( 250, 
				function(){
					if( !( jQuery.browser.msie &&  parseInt( jQuery.browser.version, 10 ) <= 7 ) ){
						onSizeChange( jQuery(window).width() );
                        set_header_bottom();
						/*em_sections();*/
						set_cloud_zoom();
						//menu_change_state( jQuery('body').innerWidth() );	
						tab_slider(jQuery(window).width());
					}
				})
			);
		}else{
			jQuery(window).bind('orientationchange',function(event) {	
					onSizeChange( jQuery(window).width() );
					set_header_bottom();
					/*em_sections();*/
					set_cloud_zoom();
					menu_change_state( jQuery('body').innerWidth() );
					tab_slider(jQuery(window).width());					
			});
		}

		
        
		jQuery(".right-sidebar-content > ul > li:first").addClass('first');
		jQuery(".right-sidebar-content > ul > li:last").addClass('last');
		
		
		jQuery(".product_upsells > ul").each(function( index,value ){
			jQuery(value).children("li:last").addClass('last');
		});
		

		jQuery("ul.product_list_widget").each(function(index,value){
			jQuery(value).children("li:first").addClass('first');
			jQuery(value).children("li:last").addClass('last');
		});
		jQuery(".related.products > ul > li:last").addClass('last');
		
		home_parallax();
		jQuery(document).on('click','div.wd_cart_buttons a.wd_update_button_visible',function(event){
			event.preventDefault();
			//alert(jQuery('.woocommerce form.wd_form_cart .wd_update_button_invisible').val());
			jQuery('.woocommerce form.wd_form_cart .wd_update_button_invisible').trigger('click');	
		});
		jQuery(document).on('click','.cart_totals_wrapper .checkout-button-visible',function(event){
			event.preventDefault();
			jQuery('.checkout-button').trigger('click');	
		});
		
		
		
		jQuery("a.wd-prettyPhoto").prettyPhoto({
			social_tools: false,
			theme: 'pp_default wd_feedback',
			horizontal_padding: 30,
			opacity: 0.9,
			deeplinking: false
		});

		wd_custom_yith_compare();
		
		jQuery(document).on('click', function(e) { 
				if ($(e.target).parents(".wd-open-control-panel").length === 0 && $(e.target).parents(".wd_woo_search_box").length === 0) {
					var control = '.wd-right-control-panel';
					jQuery( control ).removeClass('open');
					jQuery( '#template-wrapper' ).removeClass('open');
					jQuery( control ).find('> .active').removeClass('active');
				}
			});
		
		jQuery('body').on('click', '.wd-open-control-panel', function(e){
			var element = jQuery(this).attr('data-element');
			var position = jQuery(this).attr('data-position');
			var control = '.wd-' + position + '-control-panel';
			if(jQuery(control).hasClass('open')) {
				jQuery(control).removeClass('open');
				jQuery('#template-wrapper').removeClass('open');
				jQuery(control + " > div").removeClass('active');
			} else {
				jQuery(control).addClass('open');
				jQuery(element).addClass('active');
				//jQuery('#template-wrapper').addClass('open');
			}
			
		});
		
	
	jQuery('body').on('click', 'ul.cart_list .cart_item_wrapper a.remove', function(){
		var href = jQuery(this).attr('href');
		var $this = jQuery(this);
		jQuery.ajax({
			type: 'GET',
			url: href,
			beforeSend: function(){
				$this.parent('.cart_item_wrapper').parent('li').css({'opacity': '0.15'});
				//$this.parents('.shopping-cart').find('.cart-close-gray').css({'display': 'block'});
				//$this.preventDefault();
				var loader = $this.parents('.shopping-cart').find('.cart-close-gray').data('loader_url');
				$this.parents('.shopping-cart').block({message: null, overlayCSS: {background: '#fff url('+loader+') no-repeat center'}});
			},
			success: function(){
				jQuery('body').trigger( 'added_to_cart');
			}
		});
		return false;
	});
	
	
	jQuery('body').on('click', '.variations_form .wd-select-option', function(e){
						var val = jQuery(this).attr('data-value');
						var _this = jQuery(this);
						
						var color_select = jQuery(this).parents('.value').find('select');
						color_select.trigger('focusin');
						if(color_select.find('option[value='+val+']').length !== 0) {
							color_select.val( val ).change();
							_this.parent('.wd_color_image_swap').find('.wd-select-option').removeClass('selected');
							_this.addClass('selected');
						}
						
						
	});
	
	
	$(document).on("click",".product a.wd_compare.add",function(e){
		 e.preventDefault();

        var button = $(this),
            data = {
                action: yith_woocompare.actionadd,
                id: button.data('product_id'),
                context: 'frontend'
            },
            widget_list = $('.yith-woocompare-widget ul.products-list');

        // add ajax loader
        if( typeof $.fn.block != 'undefined' ) {
            button.block({message: null, overlayCSS: { background: '#fff url(' + yith_woocompare.loader + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});
            widget_list.block({message: null, overlayCSS: { background: '#fff url(' + yith_woocompare.loader + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});
        }

        $.ajax({
            type: 'post',
            url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', yith_woocompare.actionadd ),
            data: data,
            dataType: 'json',
            success: function(response){

                if( typeof $.fn.block != 'undefined' ) {
                    button.unblock();
                    widget_list.unblock()
                }

                button.addClass('added')
                        .attr( 'href', response.table_url )
                        .text( yith_woocompare.added_label );

                // add the product in the widget
                widget_list.html( response.widget_table );

                if ( yith_woocompare.auto_open == 'yes')
                    $('body').trigger( 'yith_woocompare_open_popup', { response: response.table_url, button: button } );
            }
        });
	});
	
	
	if (navigator.userAgent.toLowerCase().indexOf("chrome") >= 0) {
		$(window).load(function(){
			$('input:-webkit-autofill').each(function(){
				var text = $(this).val();
				var name = $(this).attr('name');
				$(this).after(this.outerHTML).remove();
				$('input[name=' + name + ']').val(text);
			});
		});
	}
	
	
	jQuery('.variations_form').on('click', '.reset_variations', function(e){
		
		jQuery(this).parents('.variations').find('.wd_color_image_swap .wd-select-option.selected').removeClass('selected');
	});
					
	jQuery('body').on('change', '.variations_form .variations select', function(e){
		jQuery('.variations_form .variations .wd_color_image_swap').parents('.value').find('select').trigger('focusin');
			jQuery('.variations_form .variations .wd_color_image_swap .wd-select-option').each(function(i,e){
				var val = jQuery(this).attr('data-value');
				var _this = jQuery(this);
				var op_elemend = jQuery(this).parents('.value').find('select option[value='+val+']');
				if(op_elemend.length == 0) {
					_this.hide();
				} else {
					_this.show();
				}
				
			});
			
	});
	
	
	jQuery('body').on('click', '.wd_widget_product_slide_func1', function(e){
		e.preventDefault();
		var url = jQuery(this).attr('href');
		var _this = jQuery(this);
		var prod_id = jQuery(this).data('prod_id');
		var curent_id_box = jQuery(this).parents('.widget-container').find('.products.list .prod_box_'+prod_id);
		if(jQuery.trim(curent_id_box.html()) !== '') {
			_this.parents('.widget-container').find('.products.list .prod_slide_box').addClass('hide');
			curent_id_box.removeClass('hide');
		} else {
			jQuery.ajax({
				type: "GET",
				url: url,
				beforeSend: function(o){
					_this.parents('.widget-container').block({message: null, overlayCSS: {background: '#fff url('+wd_loading_icon+') no-repeat center'}});
				},
				success: function(data){
					curent_id_box.html(data);
					_this.parents('.widget-container').unblock();
					_this.parents('.widget-container').find('.products.list .prod_slide_box').addClass('hide');
					curent_id_box.removeClass('hide');
				}
			});
		}
		
	});
	
	jQuery('body').on('click', '.is-sticky .wd_vertical_control.no_toggle', function(){
		var ac_element = jQuery('.wd_vertical_cat_content');
		var vertical_content_h = ac_element.height();
		var header_top = jQuery('.wd_vertical_control').offset().top - jQuery(window).scrollTop() + jQuery('.wd_vertical_control').height();
		ac_element.parent().css('height', vertical_content_h);
		ac_element.toggleClass('active');
		jQuery(this).toggleClass('active');
		ac_element.toggleClass('fadeInUp');
		if( ac_element.hasClass('active') ) {
			ac_element.css({'position': 'fixed','top': header_top, 'z-index': 10});
		} else {
			ac_element.css({'position':'relative','top': 0, 'z-index': 10});
		}
	});
	var vertical_content_w = jQuery('.wd_vertical_control').width();
	if(vertical_content_w < 200) vertical_content_w = 200;
	//jQuery('.wd_vertical_cat_content').css({'width':vertical_content_w});
	
	jQuery('body').on('click', '.wd_vertical_control.toggle_active', function(){
		var ac_element = jQuery('.wd_vertical_cat_content');
		ac_element.toggleClass('active');
		//jQuery(this).toggleClass('active');
		//ac_element.toggleClass('fadeInUp');
		//ac_element.parent().toggleClass('hide');
		//ac_element.parent().css({'position': 'absolute','z-index': 10});
		
	});
	jQuery('body').on('click', '.wd_vertical_control.no_toggle', function(){
		var ac_element = jQuery('.wd_vertical_cat_content');
		ac_element.toggleClass('active');
	});
	jQuery(window).on('scroll', function(e){
		if(!jQuery('#wd-sticky-sticky-wrapper').hasClass('is-sticky')) {
			jQuery('.wd_vertical_cat_content.no_toggle').removeClass('active').removeClass('fadeInUp');
			jQuery('.wd_vertical_control.no_toggle').removeClass('active');
			jQuery('.wd_vertical_cat_content.no_toggle').css({'position':'relative','top': 0, 'z-index': 10});
			jQuery('.wd_vertical_cat_content.toggle_active').css({'position':'relative','top': 0});
		} else {
			var header_top = jQuery('.wd_vertical_control').offset().top - jQuery(window).scrollTop() + jQuery('.wd_vertical_control').height();
			jQuery('.wd_vertical_cat_content.toggle_active').css({'position':'fixed','top': header_top, 'z-index': 10});
		}
		
	});
	
	/*jQuery('body').wd_recheck_product_btn_over();
	jQuery(window).bind('resize', function(){
		jQuery('body').wd_recheck_product_btn_over();
	});*/
	
	
	/* Blog image slider */
		$('.blog-image-slider').owlCarousel({
			loop : true
			,items : 1
			,nav : true
			,dots : false
			,navSpeed : 1000
			,slideBy: 1
			,navRewind: false
			,autoplay: true
			,autoplayTimeout: 5000
			,autoplayHoverPause: true
			,autoplaySpeed: false // or number
			,mouseDrag: true
			,touchDrag: true
			,responsiveRefreshRate: 1000
			,onInitialized: function(){
				$('.blog-image-slider').removeClass('loading');
			}
		});
		
		activePanr(); 
});

jQuery.fn.wd_recheck_product_btn_over = function(){
	jQuery(this).find('section.product').each(function(i,e){
		var elems_width = 0;
		jQuery(this).find('.wd_button_list_box > *').each(function(i,e){
			elems_width += jQuery(this).width();
		});
		var box_width = jQuery(this).find('.wd_button_list_box').width();
		if( ( elems_width + 10 ) > box_width ){
			jQuery(this).find('.wd_button_list_box').addClass('wd_btns_over_box');
		} else jQuery(this).find('.wd_button_list_box').removeClass('wd_btns_over_box');
	});
}

  /*------------------------------------------
    Panr
    ------------------------------------------*/
    function activePanr() {
    	var el = jQuery('.panr-active');

    	if (!el.length || typeof jQuery.fn.panr != 'function') {
    		return
    	} else {
    		el.imagesLoaded(function(){
    			el.each(function() {
	    			var $this = jQuery(this),
	    				sensitivityValue = $this.attr('data-sensitivity'),
	    				scaleValue = $this.attr('data-scale');
	    			if (typeof sensitivityValue === typeof undefined && sensitivityValue === false) {
	    				sensitivityValue = 30;
	    			};
	    			if (typeof scaleValue === typeof undefined && scaleValue === false) {
	    				scaleValue = 1.1;
	    			};
	    			$this.find('.panr-element').panr({
	    				sensitivity: sensitivityValue,
	    				scale: false,
	    				scaleOnHover: true,
	    				scaleTo: scaleValue,
	    				scaleDuration: .5,
	    				panY: true,
	    				panX: true,
	    				panDuration: 1.25,
	    				moveTarget: $this,
	    				resetPanOnMouseLeave: false
	    			});
	    		});
    		})
    	};
    }
	
