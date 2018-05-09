<?php
class WP_Widget_Recent_Comments_custom extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_comments_custom', 'description' => __( 'The most recent comments','wpdance' ) );
		parent::__construct('recent-comments-custom', __('WD - Recent Comments','wpdance'), $widget_ops);
		$this->alt_option_name = 'widget_recent_comments';

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array(&$this, 'recent_comments_style') );

		add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
	}

	function recent_comments_style() {
		if ( ! current_theme_supports( 'widgets' ) // Temp hack #14876
			|| ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
			return;
		?>
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<?php
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_comments', 'widget');
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get('widget_recent_comments', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo wp_kses_post($cache[ $args['widget_id'] ]);
			return;
		}

 		extract($args, EXTR_SKIP);
 		$output = '';
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Comments','wpdance' ) : $instance['title'], $instance, $this->id_base );

		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 5;
		$count=0;
		$comments = get_comments( array( 'number' => $number, 'status' => 'approve','post_type' => 'post', 'post_status' => 'publish' ) );
		echo  $before_widget;
		if ( $title )
			echo wp_kses_post($before_title . $title . $after_title);

		echo '<div id="recentcomments">';
		if ( $comments ) {
			foreach ( (array) $comments as $comment) {
			$count++;	
			?>
				<div class="recentcomments_custom <?php if($count==1) echo " first"; if($count==count($comments)) echo " last";?>">
					<div class="detail123">
						<?php $comment_count = wp_count_comments( $comment->comment_post_ID  )->total_comments; 
							if($comment_count < 10)
								$comment_count = '0'.$comment_count;
						?>
						<h3 class="post_title"><a title="<?php echo ($comment->post_title);?>" href="<?php echo esc_url(get_permalink($comment->comment_post_ID)); ?>"><?php echo ($comment->post_title);?></a></h3>												
						<p class="comment-body">"<?php echo  tvl_wpdance_string_limit_words(get_comment_text(),15); ?>"</p>
						<div class="comment-meta">
							<span class="recent_comments_date"><?php echo esc_html(get_the_date());?></span> 						
						</div>
						<a class="comment_author" href="<?php echo esc_url($comment->comment_author_url) ;?>"><?php echo esc_html($comment->comment_author);?></a>
					</div>
				</div>
				<?php
			}
 		}
		echo '</div>';
		$output .= $after_widget;

		echo wp_kses_post($output);
		$cache[$args['widget_id']] = $output;
		wp_cache_set('widget_recent_comments', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = esc_attr($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_comments']) )
			delete_option('widget_recent_comments');

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Recent Comments', 'number' => 5) );
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title','wpdance'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number of comments to show','wpdance'); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" value="<?php echo esc_attr($number); ?>" min="1" max="8" /></p>
<?php
	}
}
register_widget('WP_Widget_Recent_Comments_custom');
?>