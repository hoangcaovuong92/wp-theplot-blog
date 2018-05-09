function generate_horizontal_slide(temp_visible,row,item_width,show_nav,show_icon_nav,autoplay,object_selector,baseE, responsive){
	if(typeof responsive === 'undefined') {
		responsive = [];
	}
	var res_len = responsive.length;
	var res_val = [];
	if(res_len == 5) {
		res_val = responsive;
	} else {
		res_val[0] = 1;
		res_val[1] = Math.round(temp_visible * 480 /1200);
		res_val[2] = Math.round(temp_visible * 768 /1200);
		res_val[3] = Math.round(temp_visible * 992 /1200);
		res_val[4] = temp_visible;
	}
	
	var _slider_datas =	{
		items 			: temp_visible
		,loop			: true
		,nav			: show_nav
		,navText		: [ '<', '>' ]
		,dots			: show_icon_nav
		,lazyload		:true
		,autoplay		:autoplay
		,autoplayTimeout	:5000
		,responsive		:{
			0:{
				items: res_val[0]
			},
			480:{
				items: res_val[1]
			},
			748:{
				items: res_val[2]//temp_visible -1
			},
			992:{
				items: res_val[3]//temp_visible -1
			},
			1200:{
				items: res_val[4]
			}
		}
		,onInitialized: function(){
			jQuery(object_selector).parents('.wd-loading').addClass('wd-loaded').removeClass('wd-loading');	
			if(autoplay) {
				setTimeout(function(){
					jQuery(object_selector).trigger('next.owl.carousel');
				}, 5000);
			}
		}
	}
	
	if( typeof baseE !== 'undefined' && baseE == true) {
		_slider_datas.responsiveBaseElement = jQuery(object_selector);
	}
	
	_slider_datas.pagination = true;
	var owl = jQuery(object_selector);
		
	owl.owlCarousel(_slider_datas);
	
	
	jQuery(object_selector).parents('.wd-slider-sc').on('click', '.owl-next', function(e){
		e.preventDefault();
		owl.trigger('next.owl.carousel');
	});
	
	jQuery(object_selector).parents('.wd-slider-sc').on('click', '.owl-prev', function(e){
		e.preventDefault();
		owl.trigger('prev.owl.carousel');
	});
	
}
function fix_gallery_item(object_selector,wrapper_width,min_width,item_width){
	jQuery( object_selector + " div.gallery_item" ).each(function() {
		var item_data_width = 	jQuery(this).attr('data-width');
		var item_width__ = Math.round(item_data_width / min_width) * item_width;
		//var item_width = Math.floor(wrapper_width * item_data_width / 100);
		jQuery( this).css({'width' : item_width__+'px'});
	});
}
jQuery(document).ready(function(){
	var _wd_shortcode_button_data;
	jQuery(".wd-shortcode-button").hover(
		function(){
			_wd_shortcode_button_data = jQuery(this).attr('style');
			jQuery(this).attr('style',jQuery(this).attr('data-hover'));
		},
		function(){
			jQuery(this).attr('style',_wd_shortcode_button_data);
		}
	);
	if(jQuery('.post_mansory').length > 0 ){
			jQuery('.post_mansory').each(function(index,value){
				var wrapper_width = jQuery(this).width();				
				var object_selector = '#'+jQuery(this).attr('id');	
				var min_width = jQuery(value).attr('data-min');		
				var item_width = Math.floor(wrapper_width * min_width / 100);
				fix_gallery_item(object_selector,wrapper_width,min_width,item_width);
				
				jQuery(value).imagesLoaded( function() {
					jQuery(value).isotope({
						layoutMode: 'masonry'
						,itemSelector: '.gallery_item'
						,masonry: {
							columnWidth: item_width
						}
					});
				});
			});	
		}			
});