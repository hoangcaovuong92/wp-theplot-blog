<?php 
class CustomFields extends AdminTheme 
{
	public function __construct(){
		add_action("admin_init", array($this,"generateCustomFields"));
		add_action('save_post', array($this,'saveCustomField'));
		$this->resetArrLayout();
		
		//add_action( 'admin_print_scripts', array($this,'deactive_err_revolu') ); 
	}
	
	public function deactive_err_revolu(){
		if( isset($_GET['page']) && $_GET['page'] == 'revslider' ){
			wp_dequeue_script('jquery-ui-autocomplete');
		}
	}
	
	public function generateCustomFields(){
		// Add shortcode Generator

		add_meta_box("page_config", "Page Configuration", array($this,"page_configuration"), "page", "normal", "high");		
		
		if(post_type_exists('product')) {
			add_meta_box("wp_cp_custom_product_layout", "Config Product", array($this,"product_layout"), "product", "normal", "high");
		}	
		if(post_type_exists('product')) {
			add_meta_box("wp_cp_custom_product_ads_sidebar", "WD Additional Product Information", array($this,"product_ads_sidebar"), "product", "normal", "high");
		}
		
		
		add_meta_box("wp_cp_custom_post_layout", "Config Post", array($this,"post_layout"), "post", "normal", "high");
		add_meta_box("post_gallery", "Gallery", array($this,"post_gallery"), "post", "side", "low");
	}
	
	public function product_ads_sidebar(){
		require_once THEME_INCLUDES_METABOXES.'/custom_ads_sidebar.php';
	}
	
	public function product_layout(){
		require_once THEME_INCLUDES_METABOXES.'/custom_layout.php';
	}
	
	public function post_layout(){
		require_once THEME_INCLUDES_METABOXES.'/custom_post_layout.php';
	}
	public function post_gallery(){
		require_once THEME_INCLUDES_METABOXES.'/post_gallery.php';
	}
	/* 
		Save config of custom fields for current post
		Input : int $post_id (the id of current post).
		No output.
	*/
	public function saveCustomField($post_id){
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
		if(isset($_POST['_inline_edit'])) 
        return $post_id;
		if( isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'list' )
			return $post_id;	
		if( isset($_REQUEST['action']) &&  $_REQUEST['action'] == 'trash' )
			return $post_id;			
		// Save featured for post
		if(isset($_POST['featured_post']))
			update_post_meta($post_id,THEME_SLUG.'featured_post',$_POST['featured_post']);
			
		

		// Save layout for custom page
		if(isset($_POST['custom_page_layout']))
			update_post_meta($post_id,THEME_SLUG.'custom_page_layout',$_POST['custom_page_layout']);
			
		// Save product custom layout & sidebar
		if( isset($_POST['custom_product_layout']) && $_POST['custom_product_layout'] == "custom_single_prod_layout" ){
			$_default_prod_config = array(
				'layout' 					=> $_POST['single_layout']
				,'left_sidebar' 			=> $_POST['single_left_sidebar']
				,'right_sidebar' 			=> $_POST['single_right_sidebar']	
			);		
			$ret_str = serialize($_default_prod_config);
			update_post_meta($post_id,THEME_SLUG.'custom_product_config',$ret_str);	
		}
		
		// Save post custom layout & sidebar
		if( isset($_POST['custom_post_layout']) && $_POST['custom_post_layout'] == "custom_single_post_layout" && wp_verify_nonce($_POST['nonce_custom_post_layout'],'_update_custom_post_layout') ){
			$_default_post_config = array(
				'layout' 					=> $_POST['single_layout']
				,'left_sidebar' 			=> $_POST['single_left_sidebar']
				,'right_sidebar' 			=> $_POST['single_right_sidebar']
				,'post_type'				=> $_POST['single_post_type']
			);
			$video_url = isset($_POST['video_url'])?$_POST['video_url']:'';
			$video_width = isset($_POST['video_width'])?$_POST['video_width']:700;
			$video_height = isset($_POST['video_height'])?$_POST['video_height']:400;
			
			$audio_mp3 = isset($_POST['audio_mp3'])?$_POST['audio_mp3']: '';
			$audio_soundcloud = isset($_POST['audio_soundcloud'])?$_POST['audio_soundcloud']: '';
			if($_POST['single_post_type'] == 'audio') {
				if(strlen($audio_mp3) > 0) $_default_post_config['audio_mp3'] = $audio_mp3;
				if(strlen($audio_soundcloud) > 0) $_default_post_config['audio_soundcloud'] = $audio_soundcloud;
			}
			if( $_POST['single_post_type'] == 'video' && strlen($video_url) > 0 ) {
				$_default_post_config['video_url'] = $_POST['video_url'];
				$_default_post_config['video_width'] = $_POST['video_width'];
				$_default_post_config['video_height'] = $_POST['video_height'];
			}
			
			$ret_str = serialize($_default_post_config);
			update_post_meta($post_id,THEME_SLUG.'custom_post_config',$ret_str);
			
			$post_thumb_shortcode = isset($_POST['post_thumb_shortcode'])? $_POST['post_thumb_shortcode']:'';
			if( $_POST['single_post_type'] == 'shortcode' && strlen($post_thumb_shortcode) > 0) {
				update_post_meta($post_id, THEME_SLUG.'post_thumb_shortcode', $post_thumb_shortcode);
			} else {
				delete_post_meta($post_id, THEME_SLUG.'post_thumb_shortcode');
			}
			
		}
		
		//Save product ADS Sidebar
		if ( isset( $_POST['wd_ads_position'] ) && isset( $_POST['wd_ads_content'] ) && isset( $_POST['wd_ads_name'] ) ) {
			$wd_ads_name = $_POST['wd_ads_name'];
			$wd_ads_position  = $_POST['wd_ads_position'];
			$wd_ads_content = $_POST['wd_ads_content'];
			$wd_ads_count = sizeof( $wd_ads_name );
			// Save Attributes
			$wd_ads_sidebar = array();
			if($wd_ads_count > 0 ){
				for ( $i=0; $i < $wd_ads_count; $i++ ) {
					//if ( ! $wd_ads_name[ $i ] )
					//	continue;
				
					$wd_ads_sidebar[ sanitize_title( $wd_ads_name[ $i ] . rand() ) ] = array(
						'name' 			=> wc_clean( $wd_ads_name[ $i ] ),
						'position' 		=> $wd_ads_position[ $i ],
						'content' 		=> $wd_ads_content[$i]
					);
				}		
				update_post_meta( $post_id, THEME_SLUG.'product_ads_sidebar', $wd_ads_sidebar );
			} 
		} else {
			delete_post_meta( $post_id, THEME_SLUG.'product_ads_sidebar');
		}
		
		if(isset($_POST['custom_sidebar']))
			update_post_meta($post_id,THEME_SLUG.'custom_sidebar',$_POST['custom_sidebar']);
		
		if(isset($_POST['username_twitter_testimonial']))
			update_post_meta($post_id,THEME_SLUG.'username_twitter_testimonial',$_POST['username_twitter_testimonial']);		
			
		// Save Gallery for slideshow
		if(isset($_POST['gal_slideshow']))
			update_post_meta($post_id,THEME_SLUG.'gal_slideshow',$_POST['gal_slideshow']);
		
		// Save select for ew_slideshow
		if(isset($_POST['slideshow_post']))
			update_post_meta($post_id,THEME_SLUG.'slideshow_post',$_POST['slideshow_post']);		
			
		// Save select for video


		// Save logo icon for service
		if(isset($_POST['ew_service_custom_logo']))
			update_post_meta($post_id,THEME_SLUG.'ew_service_custom_logo',$_POST['ew_service_custom_logo']);		

	
	
		
		if ( isset($_POST['_page_config']) && (int)$_POST['_page_config'] == 1 && wp_verify_nonce($_POST['nonce_page_config'],'_update_page_config') ){
			$_post_params = array(
										"page_layout" 			=> $_POST['page_layout']
										,"main_content_layout"	=> $_POST['main_content_layout']
										,"header_layout"		=> $_POST['header_layout']
										,"footer_layout"		=> $_POST['footer_layout']
										,"main_slider_layout"	=> $_POST['main_slider_layout']
										,"page_column" 			=> $_POST['page_column']
										,"header_style" 		=> $_POST['header_style']
										,"left_sidebar" 		=> $_POST['left_sidebar']
										,"right_sidebar" 		=> $_POST['right_sidebar']
										,"page_slider" 			=> $_POST['page_slider']
										,"page_slider_pos" 		=> $_POST['page_slider_pos']
										,"page_revolution" 		=> isset($_POST['page_revolution'])? $_POST['page_revolution']:''
										,"page_layerslider"		=> isset($_POST['page_layerslider'])? $_POST['page_layerslider']: ''
										,"hide_breadcrumb" 		=> absint($_POST['hide_breadcrumb'])
										,"hide_title" 			=> absint($_POST['hide_title'])
										,"toggle_vertical_menu" => absint($_POST['toggle_vertical_menu'])
										,"hide_top_content" 	=> absint($_POST['hide_top_content'])
									);
			//die(print_r($_post_params));						
			$_post_params = wd_array_atts(array(
										"page_layout" 			=> '0'
										,"main_content_layout"	=> 'wide'
										,"header_layout"		=> 'wide'
										,"footer_layout"		=> 'wide'
										,"main_slider_layout"	=> 'wide'
										,"top_content_widget_layout"		=> 'wide'
										,"page_column"			=> '0-1-0'
										,"header_style" 		=> '0'
										,"left_sidebar" 		=>'primary-widget-area'
										,"right_sidebar" 		=> 'primary-widget-area'
										,"page_slider" 			=> 'none'
										,"page_slider_pos" 		=> 'after_header'
										,"page_revolution" 		=> ''
										,"page_layerslider"		=> ''
										,"portfolio_columns" 	=> 1
										,"portfolio_filter"		=> 1
										,"hor_menu_color" 		=> 'default'
										,"ver_menu_color" 		=> 'default'
										,"toggle_vertical_menu"	=> 1
										,"hide_breadcrumb" 		=> 0
										,"hide_title" 			=> 0
										,"hide_top_content" 	=> 0
									),$_post_params	);					
			$ret_str = serialize($_post_params);			
			
			update_post_meta($post_id,THEME_SLUG.'page_configuration',$ret_str);	
		}		
		if ( isset($_POST['_post_gallery']) && (int)$_POST['_post_gallery'] == 1 && wp_verify_nonce($_POST['nonce_post_gallery'],'_update_post_gallery') ){
			$attachment_ids = $_POST['attachment_ids'];
			update_post_meta($post_id, THEME_SLUG.'post_gallery', $attachment_ids);
		}
		if( isset($_POST['_sliders_gallery']) && $_POST['_sliders_gallery'] == 1 ){
			$ret_str = '';
			$element_count = count($_POST['g_element_id']);
			$ret_arr = array();
			for( $i = 0 ; $i < $element_count ; $i++ ){	
				$temp_arr = array(
					'id' => isset($_POST['g_element_id'][$i]) ? $_POST['g_element_id'][$i] : ''
					,'thumb_url' => isset($_POST['g_thumb_url'][$i]) ? $_POST['g_thumb_url'][$i] : ''
					,'url' => isset($_POST['g_element_url'][$i]) ? $_POST['g_element_url'][$i] : ''
					,'alt' => isset($_POST['g_element_alt'][$i]) ? $_POST['g_element_alt'][$i] : ''
					,'title' => isset($_POST['g_element_title'][$i]) ? $_POST['g_element_title'][$i] : ''
				);
				array_push( $ret_arr, $temp_arr );
			}
			
			$ret_str = serialize($ret_arr);
			update_post_meta($post_id,THEME_SLUG.'_post_gallerys',$ret_str);	
			
			
			$ret_arr = array(
				'gallery_width' => isset($_POST['gallery_width']) ? $_POST['gallery_width'] : ''
			);
			$ret_str = serialize($ret_arr);
			update_post_meta($post_id,THEME_SLUG.'_post_gallery_config',$ret_str);	
			
		}
			
	}
	
	/* 
		Load shortcode options for shortcode generator.
		Options.php file is placed in 'includes' folder.
	*/ 
	public function loadShortcodeOptions(){
		global $post;
		if(file_exists(THEME_EXTENDS_ADMIN.'/includes/shortcode_options_'.$post->post_type.'.php'))
			require_once THEME_EXTENDS_ADMIN.'/includes/shortcode_options_'.$post->post_type.'.php';
		else	
			require_once THEME_ADMIN.'/includes/shortcode_options_'.$post->post_type.'.php';
	}
	

	
	/* Generate logo image field */
	public function show_custom_logo(){
		global $post;
		$image = get_template_directory_uri().'/framework/admin/images/default_logo.png';	
		$meta = get_post_meta($post->ID, THEME_SLUG.'ew_service_custom_logo', true);
		$metaLink = get_post_meta($post->ID, THEME_SLUG.'ew_service_custom_link', true);
		echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
		if ($meta) {
			$image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; 
		}		

		echo	'<span>Custom link : </span><input name="ew_service_custom_link" type="text" value="'.$metaLink.'" size="50"/><br>';	
		echo	'<input name="'.ew_service_custom_logo.'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
				<img src="'.$image.'" class="custom_preview_image" alt="" /><br />
				<input class="custom_upload_image_button button" type="button" value="Choose Image" />
				<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
				<br clear="all" /><span class="description">Upload your logo here</span>
				<br>';
		
				
				
	}
	
	
	/* Generate 'seo' field */
	public function createSeoMeta(){
		require_once THEME_INCLUDES_METABOXES.'/seo_meta.php';
	}
	
	/* Generate 'custom layout' panel for chosing layout of post(portfolio) */
	public function createCustomLayout(){
		require_once THEME_INCLUDES_METABOXES.'/custom_layout.php';
	}

	public function page_configuration(){
		require_once THEME_INCLUDES_METABOXES.'/page_configuration.php';
	}
		
	public function custom_field_testimonial(){
		require_once THEME_INCLUDES_METABOXES.'/testimonial.php';
	}
}
?>