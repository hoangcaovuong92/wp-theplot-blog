<?php 
if(!class_exists('WP_Widget_Recent_Product')){
	class WP_Widget_Recent_Product extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Recent Products','wpdance'),
				'desc' 		=> esc_html__('This widget show recent products in each category you select.','wpdance'),
				'slug' 	  	=> 'recent_product',
				'class' 	=> 'recent_product',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}
	  
		function widget($args, $instance){
			/*global $wpdb;*/ // call global for use in function
			
			
			$cache = wp_cache_get('recent_product', 'widget');			
			
			if ( ! is_array( $cache ) )
				$cache = array();

			if ( isset( $cache[$args['widget_id']] ) ) {
				echo wp_kses_post($cache[$args['widget_id']]);
				return;
			}

			ob_start();			
			
			extract($args); // gives us the default settings of widgets
			
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent','wpdance') : $instance['title']);
			
			$link = empty( $instance['link'] ) ? '#' : esc_url($instance['link']);
			$link = ( isset($link) && strlen($link) > 0 ) ? $link : "#" ;
			
			$_limit = absint($instance['limit']) == 0 ? 5 : absint($instance['limit']);
			
			$hot_type = empty( $instance['hot_type'] ) ? 'widget' : esc_attr($instance['hot_type']);
			$thumb_colums = empty( $instance['thumb_colums'] ) ? 4 : absint($instance['thumb_colums']);
			$shortc_limit = empty( $instance['shortc_limit'] ) ? 8 : absint($instance['shortc_limit']);
			
			echo wp_kses_post($before_widget); // echos the container for the widget || obtained from $args
			if($title){
				echo wp_kses_post($before_title."<a href='{$link}' title='{$title}'>".$title.'</a>'.$after_title);
			}
			
			$args = array(
					'post_type'	=> 'product',
					'post_status' => 'publish',
					'ignore_sticky_posts'	=> 1,
					'posts_per_page' => $_limit,
					'orderby' => 'date',
					'order' => 'desc',				
					'meta_query' => array(
						array(
							'key' => '_visibility',
							'value' => array('catalog', 'visible'),
							'compare' => 'IN'
						)
					)
				);
			wp_reset_postdata();	
			
			$recent_products = new WP_Query( $args );
				global $post;
			
			if($recent_products->have_posts())	{
			?>
			<?php if (strcmp($hot_type, 'widget') == 0){ ?>
				<ul class="product_list_widget">
					<?php while ($recent_products->have_posts()) : $recent_products->the_post();?>
					<?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => 1 ) );?>
					<?php  endwhile;?>
				</ul>
			<?php } else {?>
			
				<div class="product-bigger">
					<?php wd_woocommerce_product_loop_start('list'); ?>
					<?php while ( $recent_products->have_posts() ) : $recent_products->the_post(); ?>
						<?php 
							//remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart', 13 );
							remove_action( 'woocommerce_after_shop_loop_item', 'wd_add_wishlist_button_to_product_list_shortocode', 15 );
							remove_action( 'wd_woocommerce_shop_loop_buttons', 'wd_add_compare_link', 14 );
							remove_action( 'woocommerce_after_shop_loop_item', 'wd_add_compare_link', 20 );
							global $_wd_quickshop;
							remove_action('woocommerce_after_shop_loop_item', array( $_wd_quickshop , 'add_quickshop_button'), 25 );
						?>
						<?php wc_get_template( 'content-product-custom.php', array( 'columns' => 1,'shortc_limit' => $shortc_limit) );?>
						<?php break; endwhile; // end of the loop. ?>
					<?php woocommerce_product_loop_end(); ?>
				</div>
				<?php $_random_id = 'widget_product_slider_'.rand(); ?>
					<div class="widget_product_slider wd-loading" id="<?php echo esc_attr($_random_id);?>">
						<div class="products">
						<?php while ($recent_products->have_posts()) : $recent_products->the_post();?>
							<?php 
							global $product;
							?>
							<div class="thumbnail"><a title="<?php echo esc_attr($product->get_title());?>" href="<?php echo esc_url( get_permalink( $product->id ) );?>"><?php echo wp_kses_post($product->get_image()); ?></a></div>
						<?php $i++; endwhile;?>
						</div>
					</div>
			<?php }?>
			<?php } ?>
			<?php if (strcmp($hot_type, 'widget') !== 0){ ?>
			<script type='text/javascript'>
			//<![CDATA[
				jQuery(document).ready(function() {
					"use strict";
					var temp_visible = <?php echo absint($thumb_colums)?>;
					
					var row = 1;
					var item_width = 70;
					
					var show_nav = true;
					var prev,next,pagination;

					var show_icon_nav = false;
					
					var object_selector = "#<?php echo esc_js($_random_id);?> .products";
                    var autoplay = false;
					generate_horizontal_slide(temp_visible,row,item_width,show_nav,show_icon_nav,autoplay,object_selector);
				});
			//]]>	
			</script>
			<?php } ?>
<?php		
			wp_reset_postdata();
			
			echo wp_kses_post($after_widget); // close the container || obtained from $args
			$content = ob_get_clean();

			if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

			echo wp_kses_post($content);

			wp_cache_set('recent_product', $cache, 'widget');			
			
		}

		
		function update($new_instance, $old_instance) {
			return $new_instance;
		}

		
		function form($instance) {        

			//Defaults
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'From Our Blog','link'=>'#','limit'=>4, 'hot_type' => 'widget', 'thumb_colums' => 4, 'shortc_limit' => 8) );
			$title = esc_attr( $instance['title'] );
			$limit = absint( $instance['limit'] );
			$link = esc_url( $instance['link'] );
			$hot_type	 = esc_attr( $instance['hot_type'] );
			$thumb_colums = esc_attr( $instance['thumb_colums'] );
			$shortc_limit = absint( $instance['shortc_limit'] );
			?>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			<p><label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php _e( 'Title Link','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('link')); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></p>

			<p><label for="<?php echo esc_attr($this->get_field_id('hot_type')); ?>"><?php _e( 'Type:','wpdance' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('hot_type')); ?>" name="<?php echo esc_attr($this->get_field_name('hot_type')); ?>">
					<option value="widget" <?php echo strcmp(esc_attr( $instance['hot_type'] ), 'widget') == 0 ? 'selected': '';?>>Widget</option>
					<option value="t_slider" <?php echo strcmp(esc_attr( $instance['hot_type'] ), 't_slider') == 0 ? 'selected': '';?>>Thumb Slider</option>
				</select>
				<p><label for="<?php echo esc_attr($this->get_field_id('shortc_limit')); ?>"><?php _e( 'Description limit','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('shortc_limit')); ?>" name="<?php echo esc_attr($this->get_field_name('shortc_limit')); ?>" type="text" value="<?php echo (empty($instance['shortc_limit']) || absint($instance['shortc_limit']) < 1)? 4 : absint( $instance['shortc_limit'] ); ?>" /></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('thumb_colums')); ?>"><?php _e( 'Products thumb columns','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('thumb_colums')); ?>" name="<?php echo esc_attr($this->get_field_name('thumb_colums')); ?>" type="text" value="<?php echo (empty($instance['thumb_colums']) || absint($instance['thumb_colums']) < 1)? 4 : absint( $instance['thumb_colums'] ); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php _e( 'Limit','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" name="<?php echo esc_attr($this->get_field_name('limit')); ?>" type="text" value="<?php echo esc_attr($limit); ?>" /></p>
			
	<?php
		   
		}
	}
}
?>