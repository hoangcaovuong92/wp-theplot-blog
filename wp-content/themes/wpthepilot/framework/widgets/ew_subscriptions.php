<?php
/**
 * EW Social Widget
 */
if(!class_exists('WP_Widget_Ew_subscriptions')){
	class WP_Widget_Ew_subscriptions extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Feedburner Subscriptions','wpdance'),
				'desc' 		=> esc_html__('Display Subscriptions Form.','wpdance'),
				'slug' 	  	=> 'ew_subscriptions',
				'class' 	=> 'widget_subscriptions',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}

		function widget( $args, $instance ) {
			extract($args);
			$title = esc_attr($instance['title']);
			//$title = (strlen($title) <= 0 ? 'Sign up for Our Newsletter' : $title);
			
			$intro_text = esc_attr( $instance['intro_text'] );
			/*$intro_text = (strlen($intro_text) <= 0 ? 'Enter your email' : $intro_text);*/
			
			$button_text = isset($instance['button_text']) ? esc_attr($instance['button_text']) : "";
			$button_text = (strlen($button_text) <= 0 ? 'Subscribe' : $button_text);
			
			$style = isset($instance['style'])? esc_attr( $instance['style'] ) : 'style-1';
			$align = isset($instance['align'])? esc_attr( $instance['align'] ) : 'text-left';
			
			$feedburner_id = $instance['feedburner_id'];
			$feedburner_id = (strlen($feedburner_id) <= 0 ? 'wpdance' : $feedburner_id);
			echo wp_kses_post($before_widget);
			if(strlen($title) > 0):?>
				<div class="newsletter">
					<!--div class="newsletter-image"></div-->
					<h3 class="widget-title heading-title">
						<?php echo  esc_attr($title);?>
					</h3>		
					<span><?php echo esc_attr($intro_text);?></span>
				</div>
			<?php endif;?>
			
			<div class="subscribe_widget <?php echo esc_attr($style) . ' '. esc_attr($align);?>">								
				<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr($feedburner_id);?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
					<p class="subscribe-email"><input type="text" name="email" class="subscribe_email" placeholder="<?php _e('enter your email address','wpdance');?>" /></p>
					<input type="hidden" value="<?php echo esc_attr($feedburner_id);?>" name="uri"/>
					<input type="hidden" value="<?php echo esc_attr(get_bloginfo( 'name' ));?>" name="title"/>
					<input type="hidden" name="loc" value="en_US"/>
					<button class="button" type="submit" title="Subscribe"><span><span><?php echo esc_html($button_text);?></span></span></button>
					<p style="display:none;">Delivered by <a href="<?php echo "http://www.feedburner.com"; ?>" target="_blank">FeedBurner</a></p>
				</form>
			</div>

			<?php
			echo wp_kses_post($after_widget);
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;		
			$instance['title'] 			= $new_instance['title'];
			$instance['intro_text'] 	=  $new_instance['intro_text'];
			$instance['button_text'] 	=  $new_instance['button_text'];
			$instance['style'] 			=  $new_instance['style'];
			$instance['align'] 			=  $new_instance['align'];
			$instance['feedburner_id'] 	=  $new_instance['feedburner_id'];		
			return $instance;
		}

		function form( $instance ) { 
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'Sign up for Our Newsletter', 
																 'intro_text' => 'A newsletter is a regularly distributed publication generally', 
																 'button_text' => 'Subscribe',
																 'style'		=> 'style-1',
																 'align'		=> 'text-left',
																 'feedburner_id' => 'WpComic-Manga' ) );
			$title = esc_attr($instance['title']);
			$intro_text = esc_attr($instance['intro_text']);
			$button_text = esc_attr($instance['button_text']);
			$style = esc_attr($instance['style']);
			$align = esc_attr($instance['align']);
			
			$feedburner_id = format_to_edit($instance['feedburner_id']);		
		?>
			<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Enter your title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('intro_text')); ?>"><?php _e('Enter your Intro Text','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('intro_text')); ?>" name="<?php echo esc_attr($this->get_field_name('intro_text')); ?>" value="<?php echo esc_attr($intro_text); ?>" /></p>
			<p><label for="<?php echo esc_attr($this->get_field_id('button_text')); ?>"><?php _e('Enter your Button','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('button_text')); ?>" name="<?php echo esc_attr($this->get_field_name('button_text')); ?>" value="<?php echo esc_attr($button_text); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('style')); ?>"><?php _e('Style','wpdance'); ?> : </label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('style')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>">
				<option value="style-1" <?php echo strcmp('style-1', esc_attr($style)) == 0? 'selected': '';?>>Style 1</option>
				<option value="style-2" <?php echo strcmp('style-2', esc_attr($style)) == 0? 'selected': '';?>>Style 2</option>
			</select></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('align')); ?>"><?php _e('Text align','wpdance'); ?> : </label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('align')); ?>" name="<?php echo esc_attr($this->get_field_name('align')); ?>">
				<option value="text-left" <?php echo strcmp('text-left', esc_attr($align)) == 0? 'selected': '';?>>Left</option>
				<option value="text-center" <?php echo strcmp('text-center', esc_attr($align)) == 0? 'selected': '';?>>Center</option>
				<option value="text-right" <?php echo strcmp('text-right', esc_attr($align)) == 0? 'selected': '';?>>Right</option>
			</select></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('feedburner_id')); ?>"><?php _e('Enter your Feedburner ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('feedburner_id')); ?>" name="<?php echo esc_attr($this->get_field_name('feedburner_id')); ?>" value="<?php echo esc_attr($feedburner_id); ?>" /></p>		
			<?php }
	}
}

