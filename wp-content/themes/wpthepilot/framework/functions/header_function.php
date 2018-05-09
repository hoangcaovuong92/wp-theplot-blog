<?php 
	add_action( 'tvlgiao_wpdance_wd_header_init', 'tvlgiao_wpdance_wd_print_header_top', 10 );
	if(!function_exists ('tvlgiao_wpdance_wd_print_header_top')){
		function tvlgiao_wpdance_wd_print_header_top(){ 
			global $tvlgiao_wpdance_wd_data;
		?>
			<div class="header-top hidden-xs">
				<div class="header-top-content container">
					<div class="row">					
					<div class="header-wrapper">					
					<div class="header-top-left-area col-sm-8">
						<?php if ( is_active_sidebar( 'wd-header-top-wider-area-left' )): ?>
						<ul class="xoxo">
							<?php dynamic_sidebar( 'wd-header-top-wider-area-left' ); ?>
						</ul>
						<?php endif; ?>
					</div>
					<script type="text/javascript">
					   jQuery( document ).ready(function() {
						"use strict";
						
						var _time_delay=0;
						var _ul_social = jQuery('#header .widget_social');
						jQuery.fn.reverse = [].reverse;
						_ul_social.find("li").each(function(index,element){
						 TweenLite.from(jQuery(element), 1, {x:80,repeat:0,delay:_time_delay,opacity:0,ease:Quad.easeIn});
						 _time_delay += 0.5;
						});      
					   });  
					  </script>
						<div class="header-top-right-area col-sm-16">
							<div class="wd-header-search-control" style="position: relative;">
								<span class="wd-open-control-panel" data-position="right" data-element=".wd-search-box"><i class="fa fa-search"></i></span>
						    </div>								
						<?php if ( is_active_sidebar( 'wd-header-top-wider-area-right' )): ?>
						<div class="header-top-custom-sidebar hidden-xs">
							<ul class="xoxo">
								<?php dynamic_sidebar( 'wd-header-top-wider-area-right' ); ?>
							</ul>
						</div>
						<?php endif; ?>
						
					</div>
					
					<div class="wd-right-control-panel" style="display:none">
						<div class="wd-search-box"><?php wd_get_search_form(); ?></div>
					</div>
					</div>
					</div>
				</div>
			</div>
		<?php
			tvlgiao_wpdance_menu_effect_js_var();
		
		}
	}	
		
	add_action( 'tvlgiao_wpdance_wd_header_init', 'tvlgiao_wpdance_wd_print_header_body', 20 );
	if(!function_exists ('tvlgiao_wpdance_wd_print_header_body')){
		function tvlgiao_wpdance_wd_print_header_body(){
			global $tvlgiao_wpdance_wd_data;
			get_template_part('framework/headers/header', $tvlgiao_wpdance_wd_data['wd_header_style']);
		}
	}
	
	function tvlgiao_wpdance_theme_logo(){
		global $tvlgiao_wpdance_wd_data, $page_datas;
		
		$header_type = 'wd_logo';	
		$logo = strlen(trim($tvlgiao_wpdance_wd_data[$header_type])) > 0 ? esc_url($tvlgiao_wpdance_wd_data[$header_type]) : '';
		$default_logo = get_template_directory_uri()."/images/logo_v1.png";
		$textlogo = stripslashes(esc_attr($tvlgiao_wpdance_wd_data['wd_text_logo']));
		if($page_datas['page_slider_pos'] == "before_header" )
		{
			$logo =  get_template_directory_uri()."/images/logo_black.png";
		}
		//print_r($logo);
	?>
		<div class="logo heading-title">
		<?php if( strlen( trim($logo) ) > 0 ){?>
				<a href="<?php  echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url($logo);?>" alt="<?php echo esc_attr($textlogo ? $textlogo : get_bloginfo('name'));?>" title="<?php echo esc_attr($textlogo ? $textlogo : get_bloginfo('name'));?>"/></a>	
		<?php } else {
			if($textlogo){
			?>
				<a href="<?php   echo esc_url( home_url( '/' ) );?>" title="<?php echo esc_attr($textlogo);?>"><?php echo esc_html($textlogo);?></a>
			<?php }else{ ?>
				<a href="<?php   echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url($default_logo); ?>"  alt="<?php echo get_bloginfo('name');?>" title="<?php echo get_bloginfo('name');?>"/></a>
			<?php
			}
		}?>	
		</div>
	<?php 
	}
	
	function tvlgiao_wpdance_theme_mobile_logo(){
		global $tvlgiao_wpdance_wd_data, $page_datas;
		
		$header_type = 'wd_logo_mobile';
		if(isset($tvlgiao_wpdance_wd_data['wd_logo_mobile']) && strlen(trim($tvlgiao_wpdance_wd_data['wd_logo_mobile'])) > 0 ){
			$logo = esc_url($tvlgiao_wpdance_wd_data['wd_logo_mobile']);
		} else {
			$logo = strlen(trim($tvlgiao_wpdance_wd_data['wd_logo'])) > 0 ? esc_url($tvlgiao_wpdance_wd_data['wd_logo']) : '';
		}
		
		$default_logo = get_template_directory_uri()."/images/logo-mobile.png";
		$textlogo = stripslashes(esc_attr($tvlgiao_wpdance_wd_data['wd_text_logo']));
	?>
	<div class="top_header_mobile">		
		<div class="logo heading-title">
		<?php if( strlen( trim($logo) ) > 0 ){?>
				<a href="<?php  echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url($logo);?>" alt="<?php echo esc_attr($textlogo ? $textlogo : get_bloginfo('name'));?>" title="<?php echo esc_attr($textlogo ? $textlogo : get_bloginfo('name'));?>"/></a>	
		<?php } else {
			if($textlogo){
			?>
				<a href="<?php   echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr($textlogo);?>"><?php echo esc_html($textlogo);?></a>
			<?php }else{ ?>
				<a href="<?php   echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($default_logo); ?>"  alt="<?php echo get_bloginfo('name');?>" title="<?php echo get_bloginfo('name');?>"/></a>
			<?php
			}
		}?>	
		</div>
		
	</div>
	<?php 
	}
	
	function theme_logo_fullwidth(){
		global $tvlgiao_wpdance_wd_data;
		$logo = strlen(trim($tvlgiao_wpdance_wd_data['wd_logo_fullwidth'])) > 0 ? esc_url($tvlgiao_wpdance_wd_data['wd_logo_fullwidth']) : '';
		$default_logo = get_template_directory_uri()."/images/logo.png";
		$textlogo = stripslashes(esc_attr($tvlgiao_wpdance_wd_data['wd_text_logo']));
	?>
		<div class="logo heading-title">
		<?php if( strlen( trim($logo) ) > 0 ){?>
				<a href="<?php   echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url($logo);?>" alt="<?php echo esc_attr($textlogo ? $textlogo : get_bloginfo('name'));?>" title="<?php echo esc_attr($textlogo ? $textlogo : get_bloginfo('name'));?>"/></a>	
		<?php } ?>	
		</div>
	<?php 
	}
	if(!function_exists ('wd_get_search_form1')){
		function wd_get_search_form1(){
			ob_start();
          
		?>
			<div class="wd_woo_search_box">
				<label class="screen-reader-text"><?php _e('Search', 'wpdance');?></label>				
				<form class="wd_search_form" role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
					<input type="text" name="s" id="s" <?php if(isset($_GET['s'])) echo "value=\"".esc_attr($_GET['s']) . "\""; ?> placeholder="<?php _e('Search here...', 'wpdance');?>" />
					<div class="button_search"><button type="submit" title="<?php echo esc_attr__( 'Search', 'wpdance' ); ?>"><i class="fa fa-search"></i></button></div>
					<input type="hidden" name="post_type" value="<?php echo esc_attr((class_exists('WooCommerce'))? "product": 'post');?>" />
				</form>
			</div>
			
		<?php
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
	
	if(!function_exists ('wd_get_mobile_search_form')){
		function wd_get_mobile_search_form(){
			ob_start();
		?>
			<div class="wd_woo_search_box">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
					<input type="text" placeholder="<?php echo esc_attr__("Search here...", 'wpdance');?>" name="s" id="s" <?php if(isset($_GET['s'])) echo "value=\"".esc_attr($_GET['s']) . "\""; ?> />
					<div class="button_search"><button type="submit" title="<?php echo esc_attr__( 'Search', 'wpdance' ); ?>"><i class="fa fa-search"></i></button></div>
					<input type="hidden" name="post_type" value="<?php echo esc_attr((class_exists('WooCommerce'))? "product": 'post');?>" />
				</form>
			</div>
			
		<?php
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
	
	if(!function_exists ('wd_get_search_form')){
		function wd_get_search_form(){
			global $tvlgiao_wpdance_wd_data;
			//include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			//thanhdoi
			if(shortcode_exists('wd_woo_search')) {
				
				echo strcmp(trim($tvlgiao_wpdance_wd_data['wd_header_style']), 'v4') == 0? do_shortcode("[wd_woo_search use_header_v4='1']"): do_shortcode("[wd_woo_search]");
			}
				
			else echo wd_get_search_form1();
		}
	}
	
	
	
	function theme_icon(){
		global $tvlgiao_wpdance_wd_data;
		$icon = $tvlgiao_wpdance_wd_data['wd_icon'];
		if( strlen(trim($icon)) > 0 ):?>
			<link rel="shortcut icon" href="<?php echo esc_url($icon);?>" />
		<?php endif;
	}
	
	function tvlgiao_wpdance_wd_printf_breadcrumb($datas,$style=''){
		if( $datas['has_breadcrumb']== true){
			global $tvlgiao_wpdance_wd_data;
			
			$tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs'] = (isset($datas['backg_url']) && $datas['backg_url'] !=='') ? $datas['backg_url']: $tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs'];
			$break_pace ="";$height ='';
			
			if( isset($tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs']) && $tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs'] != '' ){
				if(isset($tvlgiao_wpdance_wd_data['wd_header_style']) && $tvlgiao_wpdance_wd_data['wd_header_style'] == 'v4' && !wp_is_mobile()) $height = "height: 330px;";
				if(empty($style)){
				   $style = 'style="background: url('.esc_url($tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs_other']).');"';
				}
			}
			if(isset($tvlgiao_wpdance_wd_data['wd_header_style']) && $tvlgiao_wpdance_wd_data['wd_header_style'] == 'v4' && !wp_is_mobile()){
				$break_pace = "<div style=\"height: 116px; width: 100%;\"></div>";
			}
			if( isset($datas['type']) && $datas['type'] === 'postdetail' && isset($datas['backg_url']) && $datas['backg_url'] !=='' ) {
				//$break_pace = "<div style=\"height: 166px; width: 100%;\"></div>";
			}
			
			echo '<div class="breadcrumb-title-wrapper"><div class="breadcrumb-title" '.trim($style).'>';
			echo esc_html($break_pace);
			if( $datas['has_page_title'] ) {
				echo wp_kses_post($datas['title']);
			}
			
			if( $datas['has_breadcrumb'] ) tvlgiao_wpdance_wd_show_breadcrumbs();
			echo '</div></div>';
			
		}
	}
	
	
	function tvlgiao_wpdance_menu_effect_js_var(){
		global $tvlgiao_wpdance_wd_data;
	?>

		<script type="text/javascript">
			var _sub_menu_show_effect = '<?php echo isset($tvlgiao_wpdance_wd_data['wd_sub_menu_show_effect'])?$tvlgiao_wpdance_wd_data['wd_sub_menu_show_effect']:'dropdown'; ?>';
			var _sub_menu_show_duration = <?php echo (isset($tvlgiao_wpdance_wd_data['wd_sub_menu_show_duration']) && (int)$tvlgiao_wpdance_wd_data['wd_sub_menu_show_duration']>0)?(int)$tvlgiao_wpdance_wd_data['wd_sub_menu_show_duration']:'200'; ?>;
		</script>
	<?php }
?>