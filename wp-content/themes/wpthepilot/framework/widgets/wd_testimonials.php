<?php 
if(!class_exists('WP_Widget_Wd_testimonials')){
	/**
	 * Twitter Update Widget class
	 *
	 */
	class WP_Widget_Wd_testimonials extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Testimonials','wpdance'),
				'desc' 		=> esc_html__('Wd_Testimonials.','wpdance'),
				'slug' 	  	=> 'testimonials',
				'class' 	=> 'widget_testimonials',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}
		
		
		function widget( $args, $instance ) {
			global $post;
			extract($args);
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Team Member','wpdance') : $instance['title']);
			$memberid = $instance['memberid'];	
				if($memberid) :
				$_testimonial = woothemes_get_testimonials( array('limit' => 5, 'size' => 100 ,'category'=> $memberid ));
				else :
				$_testimonial = woothemes_get_testimonials( array('limit' => 5, 'size' => 100));
				endif;
			$name 			= esc_html(get_the_title($post->ID));
			//$content 		= substr(wp_strip_all_tags($post->post_content),0, 300).'...';
			$content  = $post->post_content;
			$role 			= esc_html(get_post_meta($post->ID,'wd_member_role',true));
			
			
			echo wp_kses_post($before_widget);
			if($title){
				echo wp_kses_post($before_title . $title . $after_title);
			}
			
			$_random_id = 'testi-widget'.rand();	?>
			<div class="sc_testimonial">
				<div class="project" id="nav<?php echo $_random_id ?>">
			<div id="<?php echo $_random_id ?>" class="sky-carousel">						  
				<div class="sky-carousel-wrapper">
					<ul class="sky-carousel-container">
					<?php 									
						foreach( $_testimonial as $testimonial ){
							$post = $testimonial;
							setup_postdata( $post );
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),array(80,80) ); 
							 //print_r( $image[0]);										
					?>									
						<li>
							<img src="<?php echo $image[0] ?>" alt="" class="sc-image">
								
							<?php 
							$content = get_the_content();
							$content = wp_trim_words( strip_tags($content), 15, $more = null );
							?>
							<div class="sc-content">	
								<div class="avartar">
									<div class="name">												
									  <p><?php the_title();?>	</p>
									</div>
									<div class="job">
									 <?php echo get_post_meta($post->ID,'_byline',true);?>
									</div>
									<h2><?php echo $content;?></h2>
									<div class="social">
										<a href="http://twitter.com" target="_blank" title="<?php _e('Follow us', 'wpdance'); ?>" ><i class="fa fa-twitter-square"></i></a>
										<a href="http://www.facebook.com" target="_blank" title="<?php _e('Become our fan', 'wpdance'); ?>" ><i class="fa fa-facebook-square"></i></a>
										<a href="http://www.pinterest.com" target="_blank" title="<?php _e('See Us', 'wpdance'); ?>" ><i class="fa fa-pinterest-square"></i></a>
									</div>
								</div>
							</div>
						</li>
						
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
					</div>
			<script type="text/javascript">
						jQuery(function() {	
							'use strict';
							jQuery("#<?php echo $_random_id ?>").carousel({
								itemWidth: 80,
								itemHeight: 80,
								distance: 20,
								selectedItemDistance: 25,
								selectedItemZoomFactor: 1,
								unselectedItemZoomFactor: 0.7,
								unselectedItemAlpha: 0.6,
								motionStartDistance: 210,
								topMargin: 115,
								gradientStartPoint: 0.35,
								gradientOverlayColor: "#ebebeb",
								gradientOverlaySize: 190,
								selectByClick: true,
								classprev:"#nav<?php echo $_random_id ?>"
							});
						});
				</script>
			<?php
	}
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = esc_attr($new_instance['title']);
			$instance['memberid'] = esc_attr($new_instance['memberid']);
			if(file_exists($cache_file))
				unlink($cache_file);
			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'limit' => 5 ,'username' => 'wpdance') );
			$title = esc_attr($instance['title']);
?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','wpdance'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('memberid')); ?>"><?php _e( 'Member','wpdance' ); ?>: </label>
			<?php
				$dropdown_args = array( 'taxonomy' => 'testimonial-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'woothemes-testimonials' ), 'id' => $this->get_field_id( 'memberid' ), 'name' => $this->get_field_name( 'memberid' ), 'selected' => $instance['memberid'] );
				wp_dropdown_categories( $dropdown_args );
			?>
			</p>
<?php		}
	}
}
?>