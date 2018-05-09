<?php
	/* Add custom layout for post, portfolio */
	global $post;
	
	$_post_config = get_post_meta($post->ID,THEME_SLUG.'custom_post_config',true);
	$post_thumb_shortcode = get_post_meta($post->ID, THEME_SLUG.'post_thumb_shortcode', true);
	
	$_default_post_config = array(
					'layout' 					=> '0'	/*$datas['layout']*/
					,'left_sidebar' 			=> '0'  /*$datas['left_sidebar']*/
					,'right_sidebar' 			=> '0'	/*$datas['right_sidebar'] */
					,'post_type'			=> '0'
					,'video_url' 				=> ''
					,'video_width' 				=> ''
					,'video_height' 			=> ''
					,'audio_mp3'				=> ''
					,'audio_soundcloud'				=> ''
					
	);	
	
	if( strlen($_post_config) > 0 ){
		$_post_config = unserialize($_post_config);
		if( is_array($_post_config) && count($_post_config) > 0 ){
			$_post_config['layout'] = ( isset($_post_config['layout']) && strlen($_post_config['layout']) > 0 ) ? $_post_config['layout'] : $_default_post_config['layout'];
			$_post_config['left_sidebar'] = ( isset($_post_config['left_sidebar']) && strlen($_post_config['left_sidebar']) > 0 ) ? $_post_config['left_sidebar'] : $_default_post_config['left_sidebar'];
			$_post_config['right_sidebar'] = ( isset($_post_config['right_sidebar']) && strlen($_post_config['right_sidebar']) > 0 ) ? $_post_config['right_sidebar'] : $_default_post_config['right_sidebar'];
			
			$_post_config['post_type'] = ( isset($_post_config['post_type']) && strlen($_post_config['post_type']) > 0 ) ? $_post_config['post_type'] : $_default_post_config['post_type'];
			
			$_post_config['video_url'] = ( isset($_post_config['video_url']) && strlen($_post_config['video_url']) > 0 ) ? $_post_config['video_url'] : $_default_post_config['video_url'];
			$_post_config['video_width'] = ( isset($_post_config['video_width']) && absint($_post_config['video_width']) > 0 ) ? $_post_config['video_width'] : $_default_post_config['video_width'];
			$_post_config['video_height'] = ( isset($_post_config['video_height']) && absint($_post_config['video_height']) > 0 ) ? $_post_config['video_height'] : $_default_post_config['video_height'];
			
			$_post_config['audio_mp3'] = ( isset($_post_config['audio_mp3']) && strlen($_post_config['audio_mp3']) > 0 ) ? $_post_config['audio_mp3'] : $_default_post_config['audio_mp3'];			
			$_post_config['audio_soundcloud'] = ( isset($_post_config['audio_soundcloud']) && strlen($_post_config['audio_soundcloud']) > 0 ) ? $_post_config['audio_soundcloud'] : $_default_post_config['audio_soundcloud'];
		}
	}else{
		$_post_config = $_default_post_config;
	}
	$post_gallery = get_post_meta($post->ID,THEME_SLUG.'_post_gallerys',true);
	$post_gallery = unserialize($post_gallery);
	
	$post_gallery_config = get_post_meta($post->ID,THEME_SLUG.'_post_gallery_config',true);
	$post_gallery_config = unserialize($post_gallery_config);
	
?>

<div class="select-layout area-config area-config1">
	<div class="area-inner">
		<div class="area-inner1">
			<!--h3 class="area-title"><?php //_e('Custom Layout','wpdance'); ?></h3-->
			<?php // $this->showTooltip(__("Custom Layout",'wpdance'),__('Select custom layout for product page.Using general product page config by default','wpdance')); ?>
			<div class="area-content">
				<ul class="page_config_list">
					<li class="first">
						<p>
							<label><?php _e('Page Layout','wpdance');?> : </label>
							<select name="single_layout" id="_single_prod_layout" class="select-min">
								<option value="0" <?php if( strcmp($_post_config["layout"],'0') == 0 ) echo "selected='selected'";?>>Default</option>
								<option value="0-1-0" <?php if( strcmp($_post_config["layout"],'0-1-0') == 0 ) echo "selected='selected'";?>>Fullwidth</option>
								<option value="0-1-1" <?php if( strcmp($_post_config["layout"],'0-1-1') == 0 ) echo "selected='selected'";?>>Right Sidebar</option>
								<option value="1-1-0" <?php if( strcmp($_post_config["layout"],'1-1-0') == 0 ) echo "selected='selected'";?>>Left Sidebar</option>
								<option value="1-1-1" <?php if( strcmp($_post_config["layout"],'1-1-1') == 0 ) echo "selected='selected'";?>>Left & Right Sidebar</option>
							</select>
						</p> 
					</li>
					
					<li>
						<p>
							<label><?php _e('Left Sidebar','wpdance');?> : </label>
							<select name="single_left_sidebar" id="_single_prod_left_sidebar">
								<option value="0" <?php if( strcmp($_post_config["left_sidebar"],'0') == 0 ) echo "selected='selected'";?>>Default</option>
								<?php
									global $default_sidebars;
									foreach( $default_sidebars as $key => $_sidebar ){
										$_selected_str = ( strcmp($_post_config["left_sidebar"],$_sidebar['id']) == 0 ) ? "selected"  : "";
										echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
									}
								?>
							</select>
						</p> 
					</li>
					
					<li>
						<p>
							<label><?php _e('Right Sidebar','wpdance');?> : </label>
							<select name="single_right_sidebar" id="_single_prod_right_sidebar">
								<option value="0" <?php if( strcmp($_post_config["right_sidebar"],'0') == 0 ) echo "selected='selected'";?>>Default</option>
								<?php
									global $default_sidebars;
									foreach( $default_sidebars as $key => $_sidebar ){
										$_selected_str = ( strcmp($_post_config["right_sidebar"],$_sidebar['id']) == 0 ) ? "selected"  : "";
										echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
									}
								?>
							</select>
						</p> 
					</li>
					
					
					<li class="">
						<p>
							<label><?php _e('Post type','wpdance');?> </label>
							<select name="single_post_type" id="single_post_type" class="global_config select-min" data-config=".slider_">
								<option value="0" <?php if( strcmp($_post_config["post_type"],'0') == 0 ) echo "selected='selected'";?>>Default</option>
								<option value="shortcode" <?php if( strcmp($_post_config["post_type"],'shortcode') == 0 ) echo "selected='selected'";?>>Gallery</option>
								<option value="video" <?php if( strcmp($_post_config["post_type"],'video') == 0 ) echo "selected='selected'";?>>Video</option>
								<option value="audio" <?php if( strcmp($_post_config["post_type"],'audio') == 0 ) echo "selected='selected'";?>>Audio</option>
								
							</select>
						</p>
					</li>
					
					<li class="global_sub slider_sub slider_shortcode" style="display:none">
					<p>
						<label><?php _e('List Images Width','wpdance');?> </label>
						<input type="text" name="gallery_width" id="gallery_width" value="<?php echo strlen($post_gallery_config['gallery_width'])? $post_gallery_config['gallery_width']: ''; ?>" />
						<span class="description"><?php _e('Example: 2_3,1_3,1_3,1_3. Two-thirds width of content for first image, One-third width of content for second image. Similar, One-third for third and fourth image. <Br/> Width of images are separated by "," comma', 'wpdance'); ?></span>
					</p>
					<div class="uploader">
						<input type="hidden" name="_sliders_gallery" value="1"/>
						<a href="javascript:void(0)" class="button stag-metabox-table-gallery"/>Insert</a>
						<a href="javascript:void(0)" class="button clear-all-slides"/>Clear</a>
						<div class="sortable-wrapper">
							<ul class="sortable">
								<?php
								if( is_array($post_gallery) && count($post_gallery) > 0 ):
									foreach( $post_gallery as $single_image ):
								?>
									<li>
										<input type="hidden" value="<?php echo esc_attr($single_image['id']);?>" name="g_element_id[]" class="inline-element element_id">
										<input type="hidden" value="<?php echo esc_url($single_image['thumb_url']);?>" name="g_thumb_url[]" class="inline-element element_thumb">
										<input type="hidden" value="<?php echo esc_url($single_image['url']);?>" name="g_element_url[]" class="inline-element link_url">
										<input type="hidden" value="<?php echo esc_attr($single_image['title']);?>" name="g_element_title[]" class="inline-element image_title ">
										<input type="hidden" value="<?php echo esc_attr($single_image['alt']);?>" name="g_element_alt[]" class="inline-element image_alt">
										
										<p class="image-wrappper">
											<img  class="preview-img" src="<?php echo esc_url($single_image['thumb_url']);?>" alt="<?php echo esc_attr($single_image['alt']);?>" title="<?php echo esc_attr($single_image['title']);?>" width="120" height="120">
											<a href="javascript:void(0)" class="preview-img-remove">Del</a>
										</p>
									</li>						
								<?php	
									endforeach;		
								endif;	
								?>

							</ul> 
						</div>
					</div>					
					</li>
					<li class="global_sub slider_sub slider_audio" style="display:none">
						<p>
							<label><?php _e('SoundCloud link','wpdance');?> </label>
							<input type="text" name="audio_soundcloud" id="audio_soundcloud" value="<?php echo strlen($_post_config['audio_soundcloud'])? $_post_config['audio_soundcloud']: ''; ?>" />
							<span class="description"><?php _e('Input Souncloud URL. This audio shows on the single post instead of the post thumbnail', 'wpdance'); ?></span>
						</p>
					</li>
					<li class="global_sub slider_sub slider_audio" style="display:none">
						<p>
							<label><?php _e('Mp3 URL','wpdance');?> </label>
							<input type="text" name="audio_mp3" id="audio_mp3" value="<?php echo strlen($_post_config['audio_mp3'])? $_post_config['audio_mp3']: ''; ?>" />
							<span class="description"><?php _e('Input mp3 URL. This audio shows on the single post instead of the post thumbnail', 'wpdance'); ?></span>
						</p>
					</li>															
					<li class="global_sub slider_sub slider_video" style="display:none">
						<p>
							<label><?php _e('Video URL','wpdance');?> </label>
							<input type="text" name="video_url" id="video_url" value="<?php echo strlen($_post_config['video_url'])? $_post_config['video_url']: ''; ?>" />
							<span class="description"><?php _e('Input Youtube, Vimeo or Dailymotion video URL. This video shows on the single post instead of the post thumbnail', 'wpdance'); ?></span>
						</p>
					</li>
					
					<li class="global_sub slider_sub slider_video" style="display:none">
						<p>
							<label><?php _e('Video width','wpdance');?> </label>
							<input type="number" min="320" max="1170" name="video_width" id="video_width" value="<?php echo esc_attr($_post_config['video_width']); ?>" />
						</p>
					</li>
					<li class="global_sub slider_sub slider_video" style="display:none">
						<p>
							<label><?php _e('Video height','wpdance');?></label>
							<input type="number" min="200" max="800" name="video_height" id="video_height" value="<?php echo esc_attr($_post_config['video_height']); ?>" />
						</p>
					</li>
					
					
					
				</ul>
						
			
				<input type="hidden" name="custom_post_layout" class="change-layout" value="custom_single_post_layout"/>
				<?php wp_nonce_field( "_update_custom_post_layout", "nonce_custom_post_layout" ); ?>
				
			</div><!-- .area-content -->
		</div>	
	</div>	
</div><!-- .select-layout -->