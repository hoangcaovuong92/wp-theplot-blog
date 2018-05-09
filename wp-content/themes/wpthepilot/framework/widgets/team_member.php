<?php 
if(!class_exists('WP_Widget_Team_Member')){
	/**
	 * Twitter Update Widget class
	 *
	 */
	class WP_Widget_Team_Member extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Team Member','wpdance'),
				'desc' 		=> esc_html__('Team member','wpdance'),
				'slug' 	  	=> 'teammember',
				'class' 	=> 'widget_teammmember',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}
		
		
		function widget( $args, $instance ) {
			global $post;
			extract($args);
			$title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Team Member','wpnoone') : $instance['title']);
			$memberid = $instance['memberid'];
			$show_social = (isset($instance['show_social']) && $instance['show_social'] == 'on')?1:0;
			$query = new WP_Query( array( 'post_type' => 'team', 'post__in' => array($memberid)) );
			$query->the_post();
			$name 			= esc_html(get_the_title($post->ID));
			//$content 		= substr(wp_strip_all_tags($post->post_content),0, 300).'...';
			$content  = $post->post_content;
			$content = wp_trim_words( strip_tags($content), 20, $more = null );
			$role 			= esc_html(get_post_meta($post->ID,'wd_member_role',true));
			
			
			echo wp_kses_post($before_widget);
			if($title){
				echo wp_kses_post($before_title . $title . $after_title);
			}
			?>
			
			<aside class="wd_meet_team">
				<div class="wrap_meet_team">
					<div class="wd_member_thumb">
						<a class="image" title="<?php echo esc_html($name); ?>"  alt="<?php echo esc_html($name); ?>"><?php the_post_thumbnail('wd_team_thumb'); ?><div class="thumbnail-effect"></div> </a>
					</div>
					<div class="wd_member_info">
						<h3><?php echo esc_html($name); ?></h3>
						<p><?php echo esc_html($role); ?></p>
					</div>
					<div class="wd_member_content">
						<content>
							<?php echo esc_attr($content); ?>
						</content>
				</div>
				</div>
				<?php if($show_social) { ?>
				<div class="social-icons">
					<ul>
						<li class="icon-facebook"><a class="fa fa-facebook" href="http://www.facebook.com/<?php echo esc_attr($facebook_id); ?>" target="_blank" title="<?php esc_html_e('Become our fan', 'wpnoone'); ?>" ></a></li>				
						<li class="icon-twitter"><a class="fa fa-twitter" href="http://twitter.com/<?php echo esc_attr($twitter_id); ?>" target="_blank" title="<?php esc_html_e('Follow us', 'wpnoone'); ?>" ></a></li>
						<li class="icon-google"><a class="fa fa-google-plus" href="https://plus.google.com/u/0/<?php echo esc_attr($google_id); ?>" target="_blank" title="<?php esc_html_e('Get updates', 'wpnoone'); ?>" ></a></li>												
					</ul>
				</div>
					<?php } ?>
			</aside>
			
			<?php
		}
		

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = esc_attr($new_instance['title']);
			$instance['memberid'] = esc_attr($new_instance['memberid']);
			$instance['show_social'] = esc_attr($new_instance['show_social'] );
			if(file_exists($cache_file))
				unlink($cache_file);
			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'limit' => 5 ,'show_social'=> 1 ,'username' => 'wpnoone') );
			$title = esc_attr($instance['title']);
			$show_social = esc_attr($instance['show_social'] );
?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','wpnoone'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
			<p>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('show_social')); ?>" name="<?php echo esc_attr($this->get_field_name('show_social')); ?>" type="checkbox" <?php echo checked( $instance[ 'show_social' ], 'on' ); ?> />
				<label for="<?php echo esc_attr($this->get_field_id('show_social')); ?>"><?php _e( 'Show social','wpdance' ); ?></label>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('memberid')); ?>"><?php esc_html_e( 'Member','wpnoone' ); ?>: </label>
				<select class="widefat" name="<?php echo esc_attr($this->get_field_name('memberid')); ?>" id="<?php echo esc_attr($this->get_field_id('memberid'));?>">
<?php
			$member_options = array();
			if( class_exists('WD_Team') || post_type_exists('team') ){
				global $post;
				$args = array(
						'post_type'			=> 'team'
						,'post_status'		=> 'publish'
						,'posts_per_page'	=> -1
					);
				$members = new WP_Query($args);
				if( $members->have_posts() ){
					while( $members->have_posts() ){
						$members->the_post(); ?>						
						<option value="<?php echo esc_attr($post->ID);?>" <?php selected( $instance['memberid'], $post->ID); ?> ><?php echo esc_attr($post->post_title);?></option>
					<?php } ?>
				</select>
			</p>
<?php
				}
			}
		}
	}
}
?>