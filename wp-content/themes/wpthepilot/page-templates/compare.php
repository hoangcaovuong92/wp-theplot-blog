<?php
/*
*	Template Name: woo compare
*/
get_header(); 

global $yith_woocompare; $fontend = $yith_woocompare->obj;
global $woocommerce, $product;
global $tvlgiao_wpdance_wd_data, $page_datas;

$page_title  = '<h1 class="heading-title page-title">';
$page_title .= get_the_title();
$page_title .= '</h1>';
$brd_data = array(
	'has_breadcrumb'	=> (isset($page_datas['hide_breadcrumb']) && absint($page_datas['hide_breadcrumb']) == 0),
	'has_page_title' 	=> ( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 ),
	'title'				=> $page_title,
);
tvlgiao_wpdance_wd_printf_breadcrumb($brd_data);
	
$products = $fontend->get_products_list();
	
?>
<?php global $product;
	$fields = $fontend->default_fields;
?>
<div id="container" class="page-template">
	<div id="content" class="container" role="main">
		<div class="main-content" id="main">
			<div class="compare-box">
				<table class="compare-list" cellpadding="0" cellspacing="0"<?php if ( empty( $products ) ) echo ' style="width:100%"' ?>>
					<tbody>

					<?php if ( count( $products ) ==0 ) : ?>

						<tr class="no-products">
							<td><?php _e( 'No products added in the compare table.', 'wpdance' ) ?></td>
						</tr>

					<?php else : ?>
						<tr class="remove">
							<th>&nbsp;</th>
							<?php foreach( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id;?>
								<td class="<?php echo esc_attr($product_class); ?>">
									<a href="<?php echo esc_url( add_query_arg( 'redirect', 'view', $fontend->remove_product_url( $product->id ) ) );?>" class="remove" data-product_id="<?php echo esc_attr($product->id); ?>">&times;</a>
								</td>
							<?php endforeach ?>
						</tr>

					<?php foreach ( $fields as $field => $name ) :
						if($field !== 'price' && $field !== 'add-to-cart'):
					?>

						<tr class="<?php echo esc_attr($field); ?>">

							<th>
								<?php echo esc_html($name); ?>
								<?php if ( $field == 'image' ) echo '<div class="fixed-th"></div>'; ?>
							</th>
							<?php foreach( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
								<td class="<?php echo esc_attr($product_class); ?>"><?php
									switch( $field ) {

										case 'image':
											echo '<div class="image-wrap">' . wp_get_attachment_image( $product->fields[$field], 'yith-woocompare-image' ) . '</div>';
											break;
										case 'title':
											?><h3><a href="<?php echo esc_url(get_permalink($product->id));?>" title="<?php echo esc_attr($product->fields[$field]);?>"><?php 
											echo empty( $product->fields[$field] ) ? '&nbsp;' : $product->fields[$field];
											echo "</a></h3>";
											break;

										case 'add-to-cart':
											$wc_get_template( 'loop/add-to-cart.php' );
											break;

										default:
											echo empty( $product->fields[$field] ) ? '&nbsp;' : $product->fields[$field];
											break;
									}
									?>
								</td>
							<?php endforeach ?>

						</tr>

					<?php endif; endforeach; ?>

					<?php 
					$repeat_price = get_option( 'yith_woocompare_price_end' );
					if ( $repeat_price == 'yes' && isset( $fields['price'] ) ) : ?>
						<tr class="yi_price repeated">
							<th><?php echo wp_kses_post($fields['price']); ?></th>

							<?php foreach( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
								<td class="<?php echo esc_attr($product_class) ?>"><?php echo wp_kses_post($product->fields['price']); ?></td>
							<?php endforeach; ?>

						</tr>
					<?php endif; ?>

					<?php 
					$repeat_add_to_cart = get_option( 'yith_woocompare_add_to_cart_end' );
					if ( $repeat_add_to_cart == 'yes' && isset( $fields['add-to-cart'] ) ) : ?>
						<tr class="add-to-cart repeated">
							<th><?php echo esc_html($fields['add-to-cart']); ?></th>

							<?php foreach( $products as $i => $product ) : $product_class = ( $i % 2 == 0 ? 'odd' : 'even' ) . ' product_' . $product->id ?>
								<td class="<?php echo esc_attr($product_class) ?>"><?php wc_get_template( 'loop/add-to-cart.php' ); ?></td>
							<?php endforeach; ?>

						</tr>
					<?php endif; ?>

				<?php endif; ?>

				</tbody>
				</table>
			</div>
			<div style="height: 35px;"></div>
		</div>
	</div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function(){
        "use strict";
		jQuery('table.compare-list').on('click', 'tr.remove', function(){
			var table = jQuery('table.compare-list');
			table.block({message: null, overlayCSS: {background: '#fff url(<?php echo esc_url(get_admin_url() . 'images/spinner-2x.gif');?>) no-repeat center', opacity: 0.6}});
		});
		
        jQuery(window).on( 'yith_woocompare_product_removed', function(){
           window.location.reload();
        });

    });

</script>


<?php

get_footer(); ?>