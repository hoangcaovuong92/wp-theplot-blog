jQuery(document).ready(function($) {
	"use strict";
	var wd_swipe = false;
	jQuery( this ).on('vmousedown', function( m_e ){
		if(m_e.pageX < 15) { 
			wd_swipe = true;
		}
	});
	jQuery( this ).on( "swipeleft swiperight", function( e ){
		if(wd_swipe) {
			if( e.type==='swiperight' && !jQuery('.toggle-menu-wrapper').hasClass('active') ){
				jQuery('.toggle-menu-wrapper').css({"height":(jQuery(window).height() + 100)});
				jQuery('.page-gray-box').show().css({'opacity': 1});
				jQuery('.toggle-menu-wrapper').addClass('active');
				jQuery('#template-wrapper,.phone-header-bar-wrapper').addClass('mb_active');
				jQuery('.phone-header').addClass('mb_active');
			}
			wd_swipe = false;
		}
		
		if( e.type==='swipeleft' && jQuery('.toggle-menu-wrapper').hasClass('active') ){
			jQuery('.page-gray-box').hide().css('opacity', 0);
			jQuery('.toggle-menu-wrapper').removeClass('active');
			jQuery('#template-wrapper,.phone-header-bar-wrapper').removeClass('mb_active');
			jQuery('.phone-header').removeClass('mb_active');
		}
		
	});

	
});

