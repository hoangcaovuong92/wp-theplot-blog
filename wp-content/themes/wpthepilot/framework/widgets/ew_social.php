<?php
/**
 * EW Social Widget
 */
if(!class_exists('WP_Widget_Ew_social')){
	class WP_Widget_Ew_social extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Social Profiles','wpdance'),
				'desc' 		=> esc_html__('Display Social Profiles.','wpdance'),
				'slug' 	  	=> 'ew_social',
				'class' 	=> 'widget_social',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}

		function widget( $args, $instance ) {
			extract($args);
			$title = esc_attr(apply_filters( 'widget_title', $instance['title'] ));
			$instagram_id = esc_attr($instance['instagram_id']);
			$twitter_id = esc_attr($instance['twitter_id']);
			$facebook_id = esc_attr($instance['facebook_id']);
			$pin_id = esc_attr($instance['pin_id']);
			$google_id = esc_attr($instance['google_id']);
			$youtube_id = esc_attr($instance['youtube_id']);
			$linkedin_id = esc_attr($instance['linkedin_id']);
			?>
			<?php echo wp_kses_post($before_widget);?>
			<?php // $before_title . $title . $after_title;?>
			<div class="social-icons">
				<?php if(strlen(trim($title)) > 0):?>
				
				<div class="widget_title_wrapper">
					<h3 class="widget-title heading-title">
						<?php echo  esc_attr($title);?>
					</h3>					
				</div>
				<?php endif; ?>
				<ul>
					<?php if(strlen(trim($facebook_id)) > 0):?>
					<li class="icon-facebook"><a href="http://www.facebook.com/<?php echo esc_url($facebook_id); ?>" target="_blank" title="<?php _e('Become our fan', 'wpdance'); ?>" ><i class="fa fa-facebook"></i></a></li>				
					<?php endif; ?>
					
					<?php if(strlen(trim($twitter_id)) > 0):?>
					<li class="icon-twitter"><a href="http://twitter.com/<?php echo esc_url($twitter_id); ?>" target="_blank" title="<?php _e('Follow us', 'wpdance'); ?>" ><i class="fa fa-twitter"></i></a></li>
					<?php endif; ?>
					
					<?php if(strlen(trim($google_id)) > 0):?>
					<li class="icon-google"><a href="https://plus.google.com/u/0/<?php echo esc_url($google_id); ?>" target="_blank" title="<?php _e('Get updates', 'wpdance'); ?>" ><i class="fa fa-google-plus"></i></a></li>
					<?php endif; ?>
					
					<?php if(strlen(trim($pin_id)) > 0):?>
					<li class="icon-pin"><a href="http://www.pinterest.com/<?php echo esc_url($pin_id);?>" target="_blank" title="<?php _e('See Us', 'wpdance'); ?>" ><i class="fa fa-pinterest"></i></a></li>
					<?php endif; ?>
					
					<?php if(strlen(trim($instagram_id)) > 0):?>
					<li class="icon-instagram"><a href="<?php echo esc_url("http://instagram.com/".$instagram_id); ?>" target="_blank" title="<?php esc_attr_e('Follow us', 'wpdance'); ?>" ><i class="fa fa-instagram"></i></a></li>
					<?php endif; ?>
					
					<?php if(strlen(trim($youtube_id)) > 0):?>
					<li class="icon-youtube"><a href="<?php echo esc_url("http://www.youtube.com/".$youtube_id); ?>" target="_blank" title="<?php esc_attr_e('Subscribe our channel', 'wpdance'); ?>" ><i class="fa fa-youtube"></i></a></li>
					<?php endif; ?>
					
					<?php if(strlen(trim($linkedin_id)) > 0):?>
					<li class="icon-linkedin"><a href="<?php echo esc_url("https://www.linkedin.com/pub/".$linkedin_id); ?>" target="_blank" title="<?php esc_attr_e('See us', 'wpdance'); ?>" ><i class="fa fa-linkedin"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>

			<?php
			echo wp_kses_post($after_widget);
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['instagram_id'] 	= esc_attr($new_instance['instagram_id']);
			$instance['twitter_id'] 	= esc_attr($new_instance['twitter_id']);
			$instance['facebook_id'] 	= esc_attr($new_instance['facebook_id']);
			$instance['pin_id'] 		= esc_attr($new_instance['pin_id']);
			$instance['google_id'] 		= esc_attr($new_instance['google_id']);
			$instance['youtube_id'] 	= esc_attr($new_instance['youtube_id']);
			$instance['linkedin_id'] 	= esc_attr($new_instance['linkedin_id']);
			$instance['title'] 			= esc_attr($new_instance['title']);
			return $instance;
		}

		function form( $instance ) { 
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'Find Us On','instagram_id' => 'Instagram ID', 'twitter_id' => 'Twitter ID', 'facebook_id' => 'Facebook ID', 'google_id' => 'Google+ ID', 'pin_id' => 'Pin ID', 'linkedin_id' => 'Iinkedin ID', 'youtube_id' => 'Youtube ID' ) );
			$instagram_id 	= esc_attr(format_to_edit($instance['instagram_id']));
			$twitter_id 	= esc_attr(format_to_edit($instance['twitter_id']));
			$facebook_id = esc_attr(format_to_edit($instance['facebook_id']));
			$pin_id = esc_attr(format_to_edit($instance['pin_id']));
			$google_id = esc_attr(format_to_edit($instance['google_id']));
			$youtube_id = esc_attr(format_to_edit($instance['youtube_id']));
			$linkedin_id = esc_attr(format_to_edit($instance['linkedin_id']));
				
		?>
			<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Enter your title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('facebook_id')); ?>"><?php _e('Enter your Facebook ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('facebook_id')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook_id')); ?>" value="<?php echo esc_attr($facebook_id); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>"><?php _e('Enter your Twitter ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter_id')); ?>" value="<?php echo esc_attr($twitter_id); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('google_id')); ?>"><?php _e('Enter your Google+ ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('google_id')); ?>" name="<?php echo esc_attr($this->get_field_name('google_id')); ?>" value="<?php echo esc_attr($google_id); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('pin_id')); ?>"><?php _e('Enter your Pinterest ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('pin_id')); ?>" value="<?php echo esc_attr($pin_id); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('instagram_id')); ?>"><?php _e('Enter your Instagram','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram_id')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram_id')); ?>" type="text" value="<?php echo esc_attr($instagram_id); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('youtube_id')); ?>"><?php _e('Enter your Youtube','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube_id')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube_id')); ?>" type="text" value="<?php echo esc_attr($youtube_id); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('linkedin_id')); ?>"><?php _e('Enter your Linkedin','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin_id')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin_id')); ?>" type="text" value="<?php echo esc_attr($linkedin_id); ?>" /></p>
			
			<?php }
	}
}

