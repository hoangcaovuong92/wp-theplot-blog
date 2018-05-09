<?php 
// Create widget tabs post
if(!class_exists('WP_Widget_Wd_Woo_Products')){
	class WP_Widget_Wd_Woo_Products extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Woocommerce Products','wpdance'),
				'desc' 		=> esc_html__('Show Best Selling Products.','wpdance'),
				'slug' 	  	=> 'wd_woocommcerce_product',
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
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Sales Off','wpdance') : $instance['title']);
			$number = empty( $instance['number'] ) ? 5 : absint($instance['number']);
			$show = empty( $instance['show'] ) ? '' : esc_attr($instance['show']);
			$type = empty( $instance['type'] ) ? 'widget' : esc_attr($instance['type']);
			$thumb_colums = empty( $instance['thumb_colums'] ) ? 4 : absint($instance['thumb_colums']);
			$shortc_limit = empty( $instance['shortc_limit'] ) ? 8 : absint($instance['shortc_limit']);
			$orderby = empty( $instance['orderby'] ) ? 'date' : esc_attr($instance['orderby']);
			$order = empty( $instance['order'] ) ? 'asc' : esc_attr($instance['order']);
			
			$show_rating 	= true;
			
			$output = $before_widget;
			if ( $title )
				$output .= $before_title . $title . $after_title;
			
			echo wp_kses_post($output);
			
			$query_args = array(
				'posts_per_page' => $number,
				'post_status' 	 => 'publish',
				'post_type' 	 => 'product',
				'no_found_rows'  => 1,
				'order'          => $order == 'asc' ? 'asc' : 'desc'
			);

			$query_args['meta_query'] = array();

			if ( empty( $instance['show_hidden'] ) ) {
				$query_args['meta_query'][] = WC()->query->visibility_meta_query();
				$query_args['post_parent']  = 0;
			}

			if ( ! empty( $instance['hide_free'] ) ) {
				$query_args['meta_query'][] = array(
					'key'     => '_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'DECIMAL',
				);
			}

			$query_args['meta_query'][] = WC()->query->stock_status_meta_query();
			$query_args['meta_query']   = array_filter( $query_args['meta_query'] );

			switch ( $show ) {
				case 'featured' :
					$query_args['meta_query'][] = array(
						'key'   => '_featured',
						'value' => 'yes'
					);
					break;
				case 'onsale' :
					$product_ids_on_sale = wc_get_product_ids_on_sale();
					$product_ids_on_sale[] = 0;
					$query_args['post__in'] = $product_ids_on_sale;
					break;
			}

			switch ( $orderby ) {
				case 'price' :
					$query_args['meta_key'] = '_price';
					$query_args['orderby']  = 'meta_value_num';
					break;
				case 'rand' :
					$query_args['orderby']  = 'rand';
					break;
				case 'sales' :
					$query_args['meta_key'] = 'total_sales';
					$query_args['orderby']  = 'meta_value_num';
					break;
				default :
					$query_args['orderby']  = 'date';
			}

			$r = new WP_Query( $query_args );
			if ( $r->have_posts() ) { ?>
			
			<?php if (strcmp($type, 'widget') == 0){ ?>
				<ul class="product_list_widget">
					<?php while ($r->have_posts()) : $r->the_post();?>
					<?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => 1 ) );?>
					<?php endwhile;?>
				</ul>
			<?php } else {?>
			
				<div class="product-bigger">
					<?php wd_woocommerce_product_loop_start('list'); $i =0; ?>
					<?php while ( $r->have_posts() ) : $r->the_post(); global $product; ?>
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
						<?php wc_get_template( 'content-product-custom.php', array( 'columns' => 1,'shortc_limit' => absint($shortc_limit)) );?>
						
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
					<?php while ($r->have_posts()) : $r->the_post();?>
						<?php 
						global $product;
						$prouct_link = (!wp_is_mobile())?
								esc_url( admin_url( 'admin-ajax.php' ) . "?action=widget_product_slide_func1&prod_id=".$product->id."&shortc_limit=".$shortc_limit ):
								get_permalink($product->id);
						?>
						<div class="thumbnail"><a class="<?php echo (!wp_is_mobile())? "wd_widget_product_slide_func1": ''; ?>" title="<?php echo esc_attr($product->get_title());?>" href="<?php echo esc_url($prouct_link);?>" data-prod_id="<?php echo esc_attr($product->id);?>"><?php echo wp_kses_post($product->get_image()); ?></a></div>
					<?php endwhile;?>
					</div>
				</div>
			
			<?php }?>
			
			<?php }?>
			<?php wp_reset_postdata(); ?>
			
	<?php
			echo wp_kses_post($after_widget);
			if (strcmp($type, 'widget') !== 0){ 
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
				$instance['title'] = strip_tags($new_instance['title']);
				$instance['number'] = absint($new_instance['number']);
				$instance['show'] = strip_tags($new_instance['show']);
				$instance['orderby'] = strip_tags($new_instance['orderby']);
				$instance['order'] = strip_tags($new_instance['order']);
				$instance['type'] = strip_tags($new_instance['type']);
				$instance['thumb_colums'] = absint($new_instance['thumb_colums']);
				$instance['shortc_limit'] = absint($new_instance['shortc_limit']);
				return $instance;
		}

		function form( $instance ) {
				//Defaults
				$instance = wp_parse_args( (array) $instance, array( 'title' => 'Sales Off' , 'number' => 5, 'show' => '', 'orderby' => 'date', 'order' => 'asc', 'type' => 'widget', 'thumb_colums'=> 4, 'shortc_limit' => 8 ) );
				
	?>
				
				<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:','wpdance' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" /></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('type')); ?>"><?php _e( 'Type:','wpdance' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('type')); ?>" name="<?php echo esc_attr($this->get_field_name('type')); ?>">
					<option value="widget" <?php echo strcmp(esc_attr( $instance['type'] ), 'widget') == 0 ? 'selected': '';?>>Widget</option>
					<option value="t_slider" <?php echo strcmp(esc_attr( $instance['type'] ), 't_slider') == 0 ? 'selected': '';?>>Thumb Slider</option>
				</select></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('show')); ?>"><?php _e( 'Show','wpdance' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('show')); ?>" name="<?php echo esc_attr($this->get_field_name('show')); ?>">
					<option value="">All Products</option>
					<option value="featured" <?php echo strcmp(esc_attr( $instance['show'] ), 'featured') == 0 ? 'selected': '';?>>Featured Products</option>
					<option value="onsale" <?php echo strcmp(esc_attr( $instance['show'] ), 'onsale') == 0 ? 'selected': '';?>>On-sale Products</option>
				</select></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php _e( 'Order by','wpdance' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('orderby')); ?>" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>">
					<option value="date" <?php echo strcmp(esc_attr( $instance['orderby'] ), 'date') == 0 ? 'selected': '';?>>Date</option>
					<option value="price" <?php echo strcmp(esc_attr( $instance['orderby'] ), 'price') == 0 ? 'selected': '';?>>Price</option>
					<option value="rand" <?php echo strcmp(esc_attr( $instance['orderby'] ), 'rand') == 0 ? 'selected': '';?>>Random</option>
					<option value="sales" <?php echo strcmp(esc_attr( $instance['orderby'] ), 'sales') == 0 ? 'selected': '';?>>Sales</option>
				</select></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('order')); ?>"><?php _e( 'Order','wpdance' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('order')); ?>" name="<?php echo esc_attr($this->get_field_name('order')); ?>">
					<option value="asc" <?php echo strcmp(esc_attr( $instance['order'] ), 'asc') == 0 ? 'selected': '';?>>ASC</option>
					<option value="desc" <?php echo strcmp(esc_attr( $instance['order'] ), 'desc') == 0 ? 'selected': '';?>>DESC</option>
				</select></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('shortc_limit')); ?>"><?php _e( 'Description limit','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('shortc_limit')); ?>" name="<?php echo esc_attr($this->get_field_name('shortc_limit')); ?>" type="number" min="5" max="30" value="<?php echo (empty($instance['shortc_limit']) || absint($instance['shortc_limit']) < 1)? 4 : absint( $instance['shortc_limit'] ); ?>" /></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('thumb_colums')); ?>"><?php _e( 'Products thumb columns','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('thumb_colums')); ?>" name="<?php echo esc_attr($this->get_field_name('thumb_colums')); ?>" type="number" min="2" max="6" value="<?php echo (empty($instance['thumb_colums']) || absint($instance['thumb_colums']) < 1)? 4 : absint( $instance['thumb_colums'] ); ?>" /></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php _e( 'Number of products to show:','wpdance' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" min="2" max="20" value="<?php echo absint( $instance['number'] ); ?>" /></p>
				

	<?php
		}
	}
}
?>