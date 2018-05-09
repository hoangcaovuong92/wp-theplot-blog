<?php
/**
 * @package WordPress
 * @since WD_GoMarket
 */
if(!function_exists('wd_custom_product_price')){
	function wd_custom_product_price(){
		global $product;
		echo '<div class="price_extra">';
			woocommerce_template_loop_price();
		echo '</div>';
		
	}
}

if(!function_exists('wd_custom_product_by_category_function')){
	function wd_custom_product_by_category_function($atts,$content){
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
			return;
		}
		global $woocommerce_loop, $woocommerce,$tvlgiao_wpdance_wd_data;	
		extract(shortcode_atts(array(
			'columns' 			=> 2
			,'row' 				=> 1
			,'big_product'		=> ''
			,'per_page' 		=> 10
			,'cat_slug'			=> ''
			//,'title' 			=> ''
			,'desc' 			=> ''
			,'show_image' 		=> 1
			,'show_title' 		=> 1
			,'show_sku' 		=> 0
			,'show_price' 		=> 1
			,'show_except' 		=> 0
			,'show_except_limit' 	=> 15
			,'show_rating' 		=> 0
			,'show_short_content' 	=> 0
			,'show_label' 		=> 0
			,'show_cat_title'	=> 0		
		),$atts));
		
		if($columns > 8){
			$columns = 8;
		}
		if($row > 4){
			$row = 4;
		}
			
		if($per_page < 1) { $per_page = 8; }
		if($columns < 1) { $columns = 2; }
		if($columns > 8) { $columns = 8; }
		if($row < 1) { $per_page = 2; }
		if($row > 8) { $row = 8; }
			
		$args = array(
			'post_type'	=> 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' => $per_page,//$per_page,
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
		$show_prod_buttons = 0;	
		$data = array('show_image' => $show_image,
						'show_title' => $show_title,
						'show_rating' => $show_rating,
						'show_price' => $show_price,
						'show_label' => $show_label,
						'show_short_content' => $show_short_content,
						'show_add_to_cart' => $show_prod_buttons,
					);
		//shop_loop_prod_remove_action($data);
		
			
			
		if(trim($cat_slug) != ''){
			$args['tax_query'] 			= array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> array( esc_attr($cat_slug) ),
					'field' 		=> 'slug',
					'operator' 		=> 'IN'
				)
			);
		}

		wp_reset_query(); 
		ob_start();

		if(isset($tvlgiao_wpdance_wd_data['wd_prod_cat_column']) && absint($tvlgiao_wpdance_wd_data['wd_prod_cat_column']) > 0 ){
			$_old_wd_prod_cat_column = $tvlgiao_wpdance_wd_data['wd_prod_cat_column'];
			$tvlgiao_wpdance_wd_data['wd_prod_cat_column'] = $columns;
		} 
			
		$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
		$products = new WP_Query( $args );

		$woocommerce_loop['columns'] = $columns;
			
		$extra_class = $style_big_prod = '';
		
		$product_count = $current_product = 0;

		$_prod_cat = get_term_by('slug', esc_attr($cat_slug), 'product_cat');
		
		if( isset($_prod_cat) && $_prod_cat){
			$title = '<a href="'.get_term_link($cat_slug,'product_cat').'">'.$_prod_cat->name.'</a>';
		}			
		//if(strlen(trim($title)) >0){
									
									//echo "<h3 class='heading-title custom-title'>{$title}</h3>";
								//}				
		if ( $products->have_posts() ) : ?>
			
			<?php $_random_id = 'custom_product_by_category_wrapper_'.rand(); ?>
			<div class="custom-product-by-category-sc" id="<?php echo $_random_id;?>">
				<div class="wd-custom-sc">
					<div class="row">						
						<div class="product-custom-body">
							<div class="product-custom-wrapper<?php echo $extra_class; ?>">	
									
								<div class="product-custom-inner">
																				
									<?php wd_woocommerce_product_loop_start(); ?>
											
										
								<?php while ( $products->have_posts() ) : $products->the_post(); ?>

									<?php wc_get_template_part( 'content', 'product' ); ?>

								<?php endwhile; // end of the loop. ?>
									<?php woocommerce_product_loop_end(); ?>
										
								</div>
							</div>	
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
					
			<?php endif;

			wp_reset_postdata();

			//shop_loop_prod_add_action();								
			
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			if(isset($_old_wd_prod_cat_column) && absint($_old_wd_prod_cat_column > 0 )){
				$tvlgiao_wpdance_wd_data['wd_prod_cat_column'] = $_old_wd_prod_cat_column  ;
			}
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';	
			
		}
	}		
	add_shortcode('custom_product_by_category','wd_custom_product_by_category_function');	
?>