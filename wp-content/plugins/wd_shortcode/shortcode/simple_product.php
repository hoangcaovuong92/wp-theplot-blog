<?php 
if(!function_exists('wd_custom_products_function2')){		
		function wd_custom_products_function2($atts,$content){
			extract(shortcode_atts(array(
				'id' => 0
				,'sku' => ''
				,'title' => ''
			),$atts));
			
			
			if (empty($atts)) return;
			
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
			wp_reset_query(); 
			
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => 1,
				'no_found_rows' => 1,
				'post_status' => 'publish',
				'meta_query' => array(
					array(
						'key' => '_visibility',
						'value' => array('catalog', 'visible'),
						'compare' => 'IN'
					)
				)
			);

			if(isset($atts['sku']) && strlen(trim($atts['sku'])) > 0){
				$args['meta_query'][] = array(
					'key' => '_sku',
					'value' => $atts['sku'],
					'compare' => '='
				);
			}

			if(isset($atts['id'])){
				$args['p'] = $atts['id'];
			}

			ob_start();

			$products = new WP_Query( $args );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +
			if ( $products->have_posts() ) : ?>
				<div class="custom-products-shortcode">
				<?php woocommerce_product_loop_start(); ?>

					<?php while ( $products->have_posts() ) : $products->the_post(); ?>

						<?php wc_get_template( 'content-product.php',array('shortc_limit' => 15) ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>
				</div>
			<?php endif;
			  wp_reset_postdata();
			 add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			 remove_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' ); 
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';
		}
	}
    add_shortcode('simple_product','wd_custom_products_function2');
function woo_archive_custom_cart_button_text() {
 
        return __( 'Shop', 'woocommerce' );
 
}
?>