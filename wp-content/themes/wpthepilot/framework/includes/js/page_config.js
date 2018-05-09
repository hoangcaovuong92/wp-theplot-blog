function sort_list_images(){
	jQuery( ".sortable" ).sortable();
}
jQuery(document).ready(function(){
   
	/* attach event to  page attributes changed */ 
    if(jQuery("select#page_template").length > 0 ){
        jQuery( "select#page_template" ).on( "change", function() {
            if( jQuery.trim(jQuery( this ).find('option:selected').html()) == 'Portfolio Template'){
                jQuery("li.portfolio_columns").show();
            } else {
                jQuery("li.portfolio_columns").hide();
            }
        });
    }
	/* attach event to  page attributes changed */ 
    if(jQuery("select#page_template").length > 0 ){
		var old_option = jQuery.trim(jQuery( 'select#page_template' ).find('option:selected').html());
		if( old_option == 'Contact Template' || old_option == 'Fullwidth Template' || old_option == 'Sitemap Template' || old_option == 'Archive Template'){
			jQuery("#page_config").hide();
		}
		if( old_option == 'Blog Template' || old_option == 'Portfolio Template'){
			jQuery("li.sub_layout").hide();
		}
        jQuery( "select#page_template" ).on( "change", function() {
			var option = jQuery.trim(jQuery( this ).find('option:selected').html());
            if( option == 'Contact Template' || option == 'Fullwidth Template' || option == 'Sitemap Template' || option == 'Archive Template'){
                jQuery("#page_config").hide();
            } else if( option == 'Blog Template' || option == 'Portfolio Template'){
				jQuery("#page_config").show();
				jQuery("li.sub_layout").hide();
			}
			else {
                jQuery("#page_config").show();
				jQuery("li.sub_layout").show();
            }
			 
        });
    }
	if(jQuery("select#page_layout").length > 0 ){
        jQuery( "select#page_layout" ).on( "change", function() {
            if( jQuery.trim(jQuery( this ).find('option:selected').html()) == 'Wide'){
				var option = jQuery.trim(jQuery( "select#page_template" ).find('option:selected').html());
				if( option != 'Blog Template' && option != 'Portfolio Template'){
					jQuery("li.sub_layout").show();
				}
            } else {
                jQuery("li.sub_layout").hide();
            }
        });
    }
	
	
	if(jQuery("select.global_config").length > 0 ){
		
		var $_list = jQuery( "select.global_config" );
		
		$_list.each(function(){
			var $_val1 = jQuery(this).val();
			var $_config1 = jQuery(this).attr('data-config');
			$_config1 += $_val1;
			jQuery($_config1).show();
			
			jQuery(this).on( "change", function() {
				var $_val = jQuery(this).find("option:selected").val();
				var $_config = jQuery(this).attr('data-config');
				var $_sub = $_config + 'sub';
				
				$_config += $_val;
				
				jQuery($_sub).hide();
				jQuery($_config).show();
			});
			
		});
    }
	
	/*
	if(jQuery("select#page_type").length > 0 ){
        jQuery( "select#page_type" ).on( "change", function() {
            if( jQuery.trim(jQuery( this ).find('option:selected').val()) == 1){
                jQuery("ul.page_config_list li").not('.wd_slider_config').hide();
            } else {	
				jQuery("ul.page_config_list li").show();
			}
        });
    }
	*/
	/* Post Gallery */
	var file_frame;
	var _this_button;
	jQuery('.post_gallery_wrapper .add_images').bind('click', function(){
		_this_button = jQuery(this);
        event.preventDefault();
			 
        if ( file_frame ) {
            file_frame.open();
            return;
        }

        var _states = [new wp.media.controller.Library({
            filterable: 'uploaded',
            title: 'Select Images',
            multiple: true,
            priority:  20
        })];
			 
        file_frame = wp.media.frames.file_frame = wp.media({
            states: _states,
            button: {
                text: 'Insert URL'
            }
        });

        file_frame.on( 'select', function() {
			var curent_ids = _this_button.siblings('.attachment_ids').val();
			
			var object = file_frame.state().get('selection').toJSON();
			var ids = '';
			var img_html = '';
			if( object.length > 0 ){
				for( i = 0; i < object.length; i++ ){
					if( curent_ids.indexOf(object[i].id) === -1 ){ /* Not exists */
						ids += object[i].id+',';
						img_html += '<li class="image"><span class="del_image"></span><img src="'+object[i].url+'" alt="" data-id="'+object[i].id+'"/></li>';
					}
				}
			}
			
			if( curent_ids!='' ){
				ids = curent_ids +','+ ids;
			}
			
			if( ids.length > 0 ){
				ids = ids.substr(0, ids.length - 1);
			}
			
			_this_button.siblings('.post_gallery_wrapper_inner').find('.post_gallery_list').append(img_html);
			_this_button.siblings('.attachment_ids').val(ids);
			
        });
		 
        file_frame.open();
	});
	
	jQuery('.post_gallery_wrapper .del_image').live('click', function(){
		var item = jQuery(this).parent('.image');
		var id = item.find('img').attr('data-id');
		item.hide(300, function(){item.remove();});
		var container = jQuery(this).parents('.post_gallery_wrapper');
		var ids = container.find('.attachment_ids').val();
		ids = ids.replace(id, '');
		ids = ids.replace(',,', ',');
		if( ids.length > 0 && ids.substr(-1) == ',' ){
			ids = ids.substr(0, ids.length - 1);
		}
		if( ids.length > 0 && ids.substr(0, 1) == ',' ){
			ids = ids.substr(1, ids.length - 1);
		}
		container.find('.attachment_ids').val(ids);
	});
	
	jQuery('.sortable').each(function(index,value){
		if(jQuery(value).find('li').length > 0){
			jQuery(this).parent('.sortable-wrapper').siblings('.clear-all-slides').show();
		} else {
			jQuery(this).parent('.sortable-wrapper').siblings('.clear-all-slides').hide();
		}
	});
	
	jQuery('.clear-all-slides').click(function(event){
		jQuery(this).siblings('.sortable-wrapper').children('.sortable').html('');
		jQuery(this).hide();
	});
	
	count_id = Math.floor((Math.random() * 1000) + 1);
	count_id = parseInt(count_id); 
	var ready_lightbox = false;
	fancy = jQuery(".preview-img-edit").fancybox({
		'minWidth' : 450
		,'minHeight' : 450
		,beforeLoad : function(){
			if(	ready_lightbox ){
			}			
		}
		,beforeClose  : function(){
			ready_lightbox = false;
		}
	});

	jQuery(".save-slide").live('click',function(){
		$('.fancybox-close').trigger('click');
	});	

	

	jQuery( ".sortable" ).disableSelection();	
	sort_list_images();
	var _custom_media = true;
	if(typeof wp.media.editor !== "undefined"){
		_orig_send_attachment = wp.media.editor.send.attachment;
	}	
	jQuery('.stag-metabox-table-gallery').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = jQuery(this);
		var sortable = jQuery(this).siblings('.sortable-wrapper').children('.sortable');
		var ___clear_button = jQuery(this).siblings('.clear-all-slides');
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			var thumb_url = '';
			if( typeof(attachment.sizes.thumbnail) !== 'undefined' ){
				thumb_url = attachment.sizes.thumbnail.url;
			}else{
				thumb_url = attachment.sizes[props.size].url;
			}
			
			var link_url = props.linkUrl;
			if( props.link == 'file' ){
				link_url = attachment.url;
			}
			if( props.link == 'post' ){
				link_url = attachment.link;
			}	
			if( props.link == 'none' ){
				link_url = '#';
			}		
			
			var image_title = attachment.title;
			var slide_description = attachment.description; 
			var image_alt = attachment.alt;		
			build_html = '';
			
			count_id = attachment.id;
			if ( _custom_media ) {	
				build_html += '<input type="hidden" value="' + count_id + '" name="g_element_id[]" class="inline-element element_id">';						
				build_html += '<input type="hidden" value="' + thumb_url + '" name="g_thumb_url[]" class="inline-element element_thumb">';
				build_html += '<input type="hidden" value="' + link_url + '" name="g_element_url[]" class="inline-element link_url">';
				build_html += '<input type="hidden" value="' + image_title + '" name="g_element_title[]" class="inline-element image_title ">';
				build_html += '<input type="hidden" value="' + image_alt + '" name="g_element_alt[]" class="inline-element image_alt">';
				
				build_html += '<p class="image-wrappper">';
				build_html += '<img  class="preview-img" src="' + thumb_url + '" alt="' + image_alt + '" title="' + image_title + '" width="120" height="120">';
				build_html += '<a href="javascript:void(0)" class="preview-img-remove">Del</a>';
				build_html += '</p>';
				
				jQuery('<li class="ui-state-default"></li>').html(build_html).appendTo(sortable);
				___clear_button.show();

			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}
		wp.media.editor.open(button);
		sort_list_images();
		
		return false;
	});
	jQuery('.image-wrappper > .preview-img-remove').live('click',function(){
		var $_this = jQuery(this);
		var sortable = jQuery(this).closest('.sortable');
		var _clear_button = jQuery(this).closest('.sortable-wrapper').siblings('.clear-all-slides');
		jQuery(this).parent().parent().remove();
		if( sortable.find('li').length > 0 ){
			_clear_button.show();
		} else {
			_clear_button.hide();			
		}	
		sort_list_images();
	});
});