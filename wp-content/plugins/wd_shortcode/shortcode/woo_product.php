<?php
/**
 * @package WordPress
 * @since WD_GoMarket
 */

if(!function_exists('wd_woo_category')){
	function wd_woo_category($atts,$content){
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
			return;
		}
		global $woocommerce_loop, $woocommerce,$wd_data;
         $shortc_limit =15; 		
		extract(shortcode_atts(array(
			'columns' 			=> 2
			,'num_best_selling' => 4
			,'big_product'		=> ''
			,'per_page' 		=> 10
			,'cat_slug'			=> ''
			,'show_position'  => 'left'
			//,'title' 			=> ''			
		),$atts));
		
		
		wp_reset_postdata(); 
		$args_query = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $num_best_selling,
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
			if(trim($cat_slug) != ''){
			$args_query['tax_query'] 			= array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> array( esc_attr($cat_slug) ),
					'field' 		=> 'slug',
					'operator' 		=> 'IN'
				)
			);
		}
		//get prices min
		
		    ob_start();
			$best_selling= new WP_Query( $args_query );
			$woocommerce_loop['columns'] = $columns;
			//$loop = new WP_Query($argsPrices);
?>			
		<div class="sd-product-thumbnail <?php echo $show_position; ?>">
			<div class="product-bigger-image ">
			<div class="product-bigger col-sm-12">
					<?php wd_woocommerce_product_loop_start('list'); $i =0;?>
					<?php while ( $best_selling->have_posts() ) : $best_selling->the_post(); global $product; ?>
						
						<?php if($i == 0):?>
					<div class="prod_slide_box prod_box_<?php echo absint($product->id)?>" data-prod_box="<?php echo absint($product->id)?>">						
						<?php wc_get_template( 'content-product-custom-thumbnail.php', array( 'columns' => 1,'shortc_limit' => 15) );?>
						<?php else: ?>
						<div class="prod_slide_box hide prod_box_<?php echo absint($product->id)?>" data-prod_box="<?php echo absint($product->id)?>">
						<?php endif; $i++;?>
						
						</div>
						<?php endwhile; // end of the loop. ?>
					<?php woocommerce_product_loop_end(); ?>
				</div>
					<?php $_random_id = 'widget_product_slider_'.rand(); ?>
					<div class="widget_product col-sm-12" id="<?php echo esc_attr($_random_id);?>">
						<div class="products">						
						<?php while ($best_selling->have_posts()) : $best_selling->the_post();?>
							<?php wc_get_template( 'content-product-custom-thumbnail.php', array( 'columns' => 2,'shortc_limit' => 15) );?>
						<?php endwhile;?>
						</div><!--.products-->
					</div>	
				</div>
			  </div>	
			</div>
			<?php 	wp_reset_postdata();
			$woocommerce_loop['columns'] = $columns;
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';
	}
}		
add_shortcode('woo_product','wd_woo_category');	
?>