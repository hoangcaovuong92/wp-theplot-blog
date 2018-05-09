<?php 
// Create widget tabs post
if(!class_exists('WP_Widget_Hot_Product')){
	class WP_Widget_Hot_Product extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Hot Products','wpdance'),
				'desc' 		=> esc_html__('Show Hot Products.','wpdance'),
				'slug' 	  	=> 'hot_product',
				'class' 	=> 'widget_hot_product',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}

		function widget( $args, $instance ) {
			extract( $args );
			$title = apply_filters('widget_title', empty($instance['title_popular']) ? __('Hot Products','wpdance') : $instance['title_popular']);
			$num_popular = empty( $instance['num_popular'] ) ? 5 : absint($instance['num_popular']);
			$hot_type = empty( $instance['hot_type'] ) ? 'widget' : esc_attr($instance['hot_type']);
			$thumb_colums = empty( $instance['thumb_colums'] ) ? 4 : absint($instance['thumb_colums']);
			$shortc_limit = empty( $instance['shortc_limit'] ) ? 8 : absint($instance['shortc_limit']);
			
			$post_type = "product";
			
			$thumbnail_width = 60;
			$thumbnail_height = 60;

			$output = $before_widget;
			if ( $title )
				$output .= $before_title . $title . $after_title;
			
			echo wp_kses_post($output);
			wp_reset_postdata();
			
			$popular=new wp_query(array('post_type' => 'product','posts_per_page' => $num_popular,'post_status'=>'publish','ignore_sticky_posts'=> 1, 'order' => 'DESC'));
			global $post,$product;
	?>
			<?php if($popular->post_count>0){$i = 0;?>
			
			<?php if (strcmp($hot_type, 'widget') == 0){ ?>
				<ul class="product_list_widget">
					<?php while ($popular->have_posts()) : $popular->the_post();?>
					<?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => 1 ) );?>
					<?php $i++; endwhile;?>
				</ul>
			<?php } else {?>
			
				<div class="product-bigger">
					<?php wd_woocommerce_product_loop_start('list'); $i =0; ?>
					<?php while ( $popular->have_posts() ) : $popular->the_post(); global $product; ?>
						
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
						<?php while ($popular->have_posts()) : $popular->the_post();?>
							<?php 
							global $product;
							$prouct_link = (!wp_is_mobile())?
								esc_url( admin_url( 'admin-ajax.php' ) . "?action=widget_product_slide_func1&prod_id=".$product->id."&shortc_limit=".$shortc_limit ):
								get_permalink($product->id);
							?>
							<div class="thumbnail"><a class="<?php echo (!wp_is_mobile())? "wd_widget_product_slide_func1": ''; ?>" title="<?php echo esc_attr($product->get_title());?>" href="<?php echo esc_url($prouct_link);?>"><?php echo wp_kses_post($product->get_image()); ?></a></div>
						<?php $i++; endwhile;?>
						</div>
					</div>
			<?php }?>
			
			
			
			<?php }?>
			
			<?php if (strcmp($hot_type, 'widget') !== 0){
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
					
					var object_selector = "#<?php echo esc_js($_random_id); ?> .products";
                    var autoplay = false;
					generate_horizontal_slide(temp_visible,row,item_width,show_nav,show_icon_nav,autoplay,object_selector, true, [4,4,3,4,4]);
				});
			//]]>	
			</script>
			<?php 
			}?>
			
			
			<?php wp_reset_postdata(); ?>
			
	<?php
			echo wp_kses_post($after_widget);
		}

		function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
				$instance['title_popular'] = strip_tags($new_instance['title_popular']);
				$instance['num_popular'] = absint($new_instance['num_popular']);
				$instance['hot_type'] = strip_tags($new_instance['hot_type']);
				$instance['thumb_colums'] = strip_tags($new_instance['thumb_colums']);
				$instance['shortc_limit'] = absint($new_instance['shortc_limit']);
				return $instance;
		}

		function form( $instance ) {
				//Defaults
				$instance = wp_parse_args( (array) $instance, array( 'title_popular' => 'Popular' , 'num_popular' => 5, 'hot_type' => 'widget', 'thumb_colums' => 4, 'shortc_limit' => 8 ) );
				$title_popular = esc_attr( $instance['title_popular'] );
				$num_popular = absint( $instance['num_popular'] );
				$hot_type	 = esc_attr( $instance['hot_type'] );
				$thumb_colums = esc_attr( $instance['thumb_colums'] );
				$shortc_limit = absint( $instance['shortc_limit'] );

	?>
				<p><label for="<?php echo esc_attr($this->get_field_id('title_popular')); ?>"><?php _e( 'Title for popular tab:','wpdance' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title_popular')); ?>" name="<?php echo esc_attr($this->get_field_name('title_popular')); ?>" type="text" value="<?php echo esc_attr($title_popular); ?>" /></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('hot_type')); ?>"><?php _e( 'Type:','wpdance' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('hot_type')); ?>" name="<?php echo esc_attr($this->get_field_name('hot_type')); ?>">
					<option value="widget" <?php echo strcmp(esc_attr( $instance['hot_type'] ), 'widget') == 0 ? 'selected': '';?>>Widget</option>
					<option value="t_slider" <?php echo strcmp(esc_attr( $instance['hot_type'] ), 't_slider') == 0 ? 'selected': '';?>>Thumb Slider</option>
				</select>
				<p><label for="<?php echo esc_attr($this->get_field_id('shortc_limit')); ?>"><?php _e( 'Description limit','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('shortc_limit')); ?>" name="<?php echo esc_attr($this->get_field_name('shortc_limit')); ?>" type="text" value="<?php echo (empty($instance['shortc_limit']) || absint($instance['shortc_limit']) < 1)? 4 : absint( $instance['shortc_limit'] ); ?>" /></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('thumb_colums')); ?>"><?php _e( 'Products thumb columns','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('thumb_colums')); ?>" name="<?php echo esc_attr($this->get_field_name('thumb_colums')); ?>" type="text" value="<?php echo (empty($instance['thumb_colums']) || absint($instance['thumb_colums']) < 1)? 4 : absint( $instance['thumb_colums'] ); ?>" /></p>
				
				<p><label for="<?php echo esc_attr($this->get_field_id('num_popular')); ?>"><?php _e( 'The number of popular post','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('num_popular')); ?>" name="<?php echo esc_attr($this->get_field_name('num_popular')); ?>" type="text" value="<?php echo esc_attr($num_popular); ?>" /></p>

	<?php
		}
	}
}
?>