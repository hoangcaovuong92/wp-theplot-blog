<?php

	if(!function_exists('banner_shortcode_function')){
		function banner_shortcode_function($atts,$content){
			extract(shortcode_atts(array(
				'link_url'				=> "#" 
				,'bg_image' 			=> ""
				,'bg_color'				=> "#000000" 
				,'title'				=> "Big title goes here" 
				/*,'font_size_title'		=> "44"
				,'title_color'			=> "#fff" 
				,'subtitle'				=> "Subtitle goes here"
				,'font_size_subtitle'	=> "18"
				,'subtitle_color'		=> "#fff"*/
				,'button_text'			=> ""
				,'button_class'			=> ""
				
				,'left_right'			=> "0px" 
				,'bottom'				=> "0px" 
				,'padding_top'			=> "0" 
				
				,'text_align'			=> "center"
				//,'border_color' 		=> "#000"
				,'inner_stroke' 		=> "0px"
				,'inner_stroke_color' 	=> "#fff"				
				,'sep_color' 			=> "#fff"
				,'sep_padding'			=> "5px" 
				,'label'				=> "no"
				//,'label_bg_color'		=> "#000"
				,'label_text_color'		=> "#fff" 
				,'label_text' 			=> "Label Text"		
				,'label_top'			=> "10px"	
				,'label_right'			=> "10px"	
				,'box_shadow_color'		=> "rgba(0,0,0,0)"	
			),$atts));
			ob_start();
			
			
			?>
			<div class="shortcode_wd_banner " onclick="location.href='<?php echo $link_url;?>'" style="text-align:center;">
				<div class="shortcode_wd_banner_inner effect_color effect_color_1" style="background-color:<?php echo $bg_color;?>;">
				
					<div class="wd_banner_background_image_wrapper panr-active loaded">
						<a class="<?php echo esc_attr($button_class)?>" href="<?php echo esc_url($link_url)?>" title="<?php echo esc_attr($title);?>">
							<figure class="panr-element">
								<img alt="<?php echo esc_attr($title);?>" title="<?php echo esc_attr($title);?>" class="img" src="<?php echo esc_url($bg_image);?>" />
							</figure/>
							<div class="caption">
									<?php echo $content;?>
							</div>
						</a>	
					</div>
				
				</div>
				<?php if( absint($label) == 1 || strcmp($label,'yes') == 0 ):?>
					<div class="shortcode_banner_simple_bullet" style="top:<?php echo $label_top;?>; right:<?php echo $label_right;?>;  color:<?php echo $label_text_color;?>"><span><?php echo $label_text;?></span></div>
				<?php endif;?>
			</div>		
			<?php
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
	add_shortcode('banner','banner_shortcode_function');
?>