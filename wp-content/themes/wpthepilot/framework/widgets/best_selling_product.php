<?php 
// Create widget tabs post
if(!class_exists('WP_Widget_Best_Selling_Product')){
	class WP_Widget_Best_Selling_Product extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Best Selling Products','wpdance'),
				'desc' 		=> esc_html__('Show Best Selling Products.','wpdance'),
				'slug' 	  	=> 'best_selling_product',
				'class' 	=> 'widget_best_selling_product woocommerce',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}

		function widget( $args, $instance ) {
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			
			extract( $args );
			$title = apply_filters('widget_title', empty($instance['title_best_selling']) ? __('Best Selling Products','wpdance') : $instance['title_best_selling']);
			$num_best_selling = empty( $instance['num_best_selling'] ) ? 5 : absint($instance['num_best_selling']);
			$best_selling_type = empty( $instance['best_selling_type'] ) ? 'widget' : esc_attr($instance['best_selling_type']);
			$thumb_colums = empty( $instance['thumb_colums'] ) ? 4 : absint($instance['thumb_colums']);
			$post_type = "product";
			$shortc_limit = empty( $instance['shortc_limit'] ) ? 8 : absint($instance['shortc_limit']);
			$thumbnail_width = 60;
			$thumbnail_height = 60;

			$output = $before_widget;
			if ( $title )
				$output .= $before_title . $title . $after_title;
			
			echo wp_kses_post($output);
			wp_reset_postdata();
			global $post;
			$args_query = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $num_best_selling,
				'order' => 'desc',		
				'meta_key' 		 => 'total_sales',
				'orderby' 		 => 'meta_value_num',				
				'meta_query' => array(
					array(
						'key' => '_visibility',
						'value' => array('catalog', 'visible'),
						'compare' => 'IN'
					)
				)
			);
		
			$best_selling=new wp_query($args_query);
	?>
			<?php if($best_selling->post_count>0){$i = 0;?>
			
			<?php if (strcmp($best_selling_type, 'widget') == 0){ ?>
				<ul class="product_list_widget">
					<?php while ($best_selling->have_posts()) : $best_selling->the_post();?>
					<?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => 1 ) );?>
					<?php $i++; endwhile;?>
				</ul>
			<?php } else {?>
			
				<div class="product-bigger">
					<?php wd_woocommerce_product_loop_start('list'); $i =0;?>
					<?php while ( $best_selling->have_posts() ) : $best_selling->the_post(); global $product; ?>
						
						<?php if($i == 0):?>
						<div class="prod_slide_box prod_box_<?php echo absint($product->id)?>" data-prod_box="<?php echo absint($product->id)?>">
						<?php 
							//remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart', 13 );
							remove_action( 'woocommerce_after_shop_loop_item', 'wd_add_wishlist_button_to_product_list_shortocode', 15 );
							remove_action( 'wd_woocommerce_shop_loop_buttons', 'wd_add_compare_link', 14 );
							remove_action( 'woocommerce_after_shop_loop_item', 'wd_add_compare_link', 20 );
							global $_wd_quickshop;
							remove_action('woocommerce_after_shop_loop_item', array( $_wd_quickshop , 'add_quickshop_button'), 25 );
						?>
						<?php wc_get_template( 'content-product-custom.php', array( 'columns' => 1,'shortc_limit' => $shortc_limit) );?>
						<?php else: ?>
						<div class="prod_slide_box hide prod_box_<?php echo absint($product->id)?>" data-prod_box="<?php echo absint($product->id)?>">
						<?php endif; $i++;?>
						
						</div>
						<?php endwhile; // end of the loop. ?>
					<?php woocommerce_product_loop_end(); ?>
				</div>
					<?php $_random_id = 'widget_product_slider_'.rand(); ?>
					<div class="widget_product_slider wd-loading" id="<?php echo esc_attr($_random_id);?>">
						<div class="products">
						<?php while ($best_selling->have_posts()) : $best_selling->the_post();?>
							<?php 
							global $product;
							$prouct_link = (!wp_is_mobile())?
								esc_url( admin_url( 'admin-ajax.php' ) . "?action=widget_product_slide_func1&prod_id=".$product->id."&shortc_limit=".$shortc_limit ):
								get_permalink($product->id);
							?>
							<div class="thumbnail"><a class="<?php echo (!wp_is_mobile())? "wd_widget_product_slide_func1": ''; ?>" title="<?php echo esc_attr($product->get_title());?>" href="<?php echo esc_url($prouct_link);?>" data-prod_id="<?php echo esc_attr($product->id);?>"><?php echo wp_kses_post($product->get_image()); ?></a></div>
						<?php endwhile;?>
						</div><!--.products-->
					</div>
			<?php }?>
			
			<?php }?>
			<?php wp_reset_postdata(); ?>
			
	<?php
			echo wp_kses_post($after_widget);
			
			if (strcmp($best_selling_type, 'widget') !== 0){
			?>
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
					
					generate_horizontal_slide(temp_visible,row,item_width,show_nav,show_icon_nav,autoplay,object_selector, true, [4,4,3,4,4]);
				});
			//]]>	
			</script>
			<?php 
			}
			
		}

		function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
				$instance['title_best_selling'] = strip_tags($new_instance['title_best_selling']);
				$instance['best_selling_type'] = strip_tags($new_instance['best_selling_type']);
				$instance['thumb_colums'] = strip_tags($new_instance['thumb_colums']);
				$instance['num_best_selling'] = absint($new_instance['num_best_selling']);
				$instance['shortc_limit'] = absint($new_instance['shortc_limit']);
				return $instance;
		}

		function form( $instance ) {
				//Defaults
				$instance = wp_parse_args( (array) $instance, array( 'title_best_selling' => 'Best Selling' , 'num_best_selling' => 5, 'best_selling_type' => 'widget', 'thumb_colums' => 4, 'shortc_limit' => 8 ) );
				
	?>
				<p><label for="<?php echo esc_attr($this->get_field_id('title_best_selling')); ?>"><?php _e( 'Title for best selling tab:','wpdance' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title_best_selling')); ?>" name="<?php echo esc_attr($this->get_field_name('title_best_selling')); ?>" type="text" value="<?php echo esc_attr( $instance['title_best_selling'] ); ?>" /></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('best_selling_type')); ?>"><?php _e( 'Type:','wpdance' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('best_selling_type')); ?>" name="<?php echo esc_attr($this->get_field_name('best_selling_type')); ?>">
					<option value="widget" <?php echo strcmp(esc_attr( $instance['best_selling_type'] ), 'widget') == 0 ? 'selected': '';?>>Widget</option>
					<option value="t_slider" <?php echo strcmp(esc_attr( $instance['best_selling_type'] ), 't_slider') == 0 ? 'selected': '';?>>Thumb Slider</option>
				</select>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('shortc_limit')); ?>"><?php _e( 'Description limit','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('shortc_limit')); ?>" name="<?php echo esc_attr($this->get_field_name('shortc_limit')); ?>" type="number" value="<?php echo (empty($instance['shortc_limit']) || absint($instance['shortc_limit']) < 1)? 6 : absint( $instance['shortc_limit'] ); ?>" min='6' max="50" /></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('thumb_colums')); ?>"><?php _e( 'Products thumb columns','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('thumb_colums')); ?>" name="<?php echo esc_attr($this->get_field_name('thumb_colums')); ?>" type="number" value="<?php echo (empty($instance['thumb_colums']) || absint($instance['thumb_colums']) < 1)? 4 : absint( $instance['thumb_colums'] ); ?>" min="2" max="6" /></p>

				<p><label for="<?php echo esc_attr($this->get_field_id('num_best_selling')); ?>"><?php _e( 'The number of best selling post','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('num_best_selling')); ?>" name="<?php echo esc_attr($this->get_field_name('num_best_selling')); ?>" type="number" value="<?php echo absint( $instance['num_best_selling'] ); ?>" min="4" max="20" /></p>
				

	<?php
		}
	}
}
?>