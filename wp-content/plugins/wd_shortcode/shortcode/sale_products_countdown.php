<?php
/**
 * @package WordPress
 * @since WD_GoMarket
 */

if(!function_exists('wd_sale_products_countdown')){
	function wd_sale_products_countdown($atts,$content){
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if ( !in_array( "woosalescountdown/woosalescountdown.php", $_actived ) ) {
			return;
		}
		extract( shortcode_atts( array(
				'id_sale_product' => '' // set attribute default
			), $atts ) );
		add_filter( 'widget_text', 'shortcode_unautop' );
		add_filter( 'widget_text', 'do_shortcode' );
		if ( $id_sale_product ) {
			$localization = ', localization:{ days: "' . __( 'days', 'woosalescountdown' ) . '", hours: "' . __( 'hours', 'woosalescountdown' ) . '", minutes: "' . __( 'minutes', 'woosalescountdown' ) . '", seconds: "' . __( 'seconds', 'woosalescountdown' ) . '" }';
			$id           = explode( ',', $id_sale_product );
			$show_message = get_option( 'ob_message_show', 1 );
			@$show_datetext = get_option( 'ob_datetext_show', 1 );
			$date_text = '';
			if ( ! $show_datetext ) {
				$date_text = ', showText:0';
			}
			$shortcode = '<div class="woocommerce ob_shortcode"><ul class="shortcode_products products">';
			for ( $i = 0; $i < count( $id ); $i ++ ) {
				/*Init product Object base on WooCommerce*/
				$product = get_product( $id[$i] );
				if ( trim( $product->product_type ) != 'variable' ) {
					if ( trim( $product->post->post_type ) != 'product' || trim( $product->post->post_status ) != 'publish' ) {
						continue;
					}
					$time_from           = get_post_meta( $product->id, "_sale_price_dates_from", true );
					$time_end            = get_post_meta( $product->id, "_sale_price_dates_to", true );
					$_turn_off_countdown = get_post_meta( $product->id, "_turn_off_countdown", true );
					if ( ! $time_from || ! $time_end ) {
						continue;
					}
					$ob_product_show_title     = get_option( 'ob_product_show_title', 'yes' );
					$ob_product_show_price     = get_option( 'ob_product_show_price', 'yes' );
					$ob_product_show_image     = get_option( 'ob_product_show_image', 'yes' );
					$ob_product_show_addtocart = get_option( 'ob_product_show_addtocart', 'yes' );
					$ob_product_show_linkable  = get_option( 'ob_product_show_linkable', 'yes' );
					$ob_product_images_sizes   = get_option( 'ob_product_images_sizes', 'shop_thumbnail' );

					$shortcode .= '<li class="product product-' . $product->id . '">';
					if ( trim( $ob_product_show_linkable ) == 'yes' ) {
						$shortcode .= '<a href="' . get_permalink( $product->id ) . '">';
					}
					if ( trim( $ob_product_show_image ) == 'yes' ) {
						$shortcode .= $product->get_image( $ob_product_images_sizes );
					}

					if ( trim( $ob_product_show_title ) == 'yes' ) {
						$shortcode .= '<h3>' . $product->get_title() . '</h3>';
					}

					if ( trim( $ob_product_show_price ) == 'yes' ) {
						$shortcode .= '<span class="price">' . $product->get_price_html() . '</span>';
					}
					if ( trim( $ob_product_show_linkable ) == 'yes' ) {
						$shortcode .= '</a>';
					}
					/*Get time schedule*/
					$discount      = get_post_meta( $product->id, "_quantity_discount", true );
					$sale          = get_post_meta( $product->id, "_quantity_sale", true );
					$stock         = get_post_meta( $product->id, "_stock", true );
					$_manage_stock = get_post_meta( $product->id, "_manage_stock", true );
					if ( $_manage_stock ) {

						if ( trim( $_manage_stock ) == 'yes' ) {
							if ( $stock < 1 ) {
								$discount = 0;
							}
						}
					}
					if ( ! $sale ) {
						$sale = 0;
					}
					$current_time = strtotime( current_time( "Y-m-d G:i:s" ) );
					if ( $current_time < $time_end && ! $_turn_off_countdown ) {
						if ( $time_end && $time_from ) {
							$check_sale = 1;
							if ( $sale < $discount ) {
								$per_sale = intval( $sale / $discount * 100 );
							} else {
								$check_sale = 0;
							}
							$date_format = get_option( 'date_format', 'F j, Y' );
							if ( $current_time < $time_from ) {
								$time = $time_from; // - time();
								@$message = __( get_option( 'ob_title_coming', 'Coming' ), 'woosalescountdown' );
								$time_text = '<h5 class="schedule_text">' . date( $date_format, $time_from ) . __( ' to ', 'woosalescountdown' ) . date( $date_format, $time_end ) . '</h5>';
							} else {
								$time = $time_end; // - time();
								@$message = __( get_option( 'ob_title_sale', 'Sale' ), 'woosalescountdown' );
								$time_text = '<h5 class="schedule_text">' . date( $date_format, $time_from ) . __( ' to ', 'woosalescountdown' ) . date( $date_format, $time_end ) . '</h5>';
							}

							@$ob_time_show = get_option( 'ob_time_show' );
							switch ( $ob_time_show ) {
								case 1:
									$shortcode .= '	<div class="ob_warpper">';
									if ( $show_message ) {
										$shortcode .= '<h3>' . $message . '</h3>';
									}
									$shortcode .= '<div class="shortcode_product_' . $product->id . ' shortcode_product"></div>
                                </div>
                                ';
									break;
								case 2:
									if ( $check_sale ) {
										$shortcode .= '	<div class="ob_warpper">';
										if ( $show_message ) {
											$shortcode .= '<h3>' . $message . '</h3>';
										}
										$shortcode .= '	<div class="ob_discount"><div class="ob_sale" style="width:' . $per_sale . '%"></div></div>
								<span>' . $sale . '/' . $discount . __( ' sold', 'woosalescountdown' ) . '</span> </div>
                                ';
									}
									break;
								default:
									$shortcode .= '	<div class="ob_warpper">';
									if ( $show_message ) {
										$shortcode .= '<h3>' . $message . '</h3>';
									}
									if ( $check_sale ) {
										$shortcode .= '<div class="ob_discount"><div class="ob_sale" style="width:' . $per_sale . '%"></div></div>
								<span>' . $sale . '/' . $discount . __( ' sold', 'woosalescountdown' ) . '</span>';

									}
									$shortcode .= '<div class="shortcode_product_' . $product->id . ' shortcode_product"></div></div>';
							}


							if ( ! empty( $time_end ) && ! empty( $time_from ) ) {

								$shortcode .= '
								<script type="text/javascript">
									jQuery(function () {
										jQuery(".shortcode_product_' . $product->id . '").mbComingsoon({ expiryDate: new Date(' . date( "Y", $time ) . ', ' . ( date( "m", $time ) - 1 ) . ', ' . date( "d", $time ) . ', ' . date( "G", $time ) . ',' . date( "i", $time ) . ', ' . date( "s", $time ) . '),speed: 500, gmt:' . get_option( 'gmt_offset' ) . $date_text . $localization . ' });
									});
								</script>';

							}

						}
					}
					if ( trim( $ob_product_show_addtocart ) == 'yes' ) {
						$shortcode .= apply_filters( 'woocommerce_loop_add_to_cart_link',
							sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button add_to_cart_button product_type_simple %s product_type_%s">%s</a>',
								esc_url( $product->add_to_cart_url() ),
								esc_attr( $product->id ),
								esc_attr( $product->get_sku() ),
								$product->is_purchasable() ? 'add_to_cart_button' : '',
								esc_attr( $product->product_type ),
								esc_html( $product->add_to_cart_text() ) ),
							$product );
					}
					$shortcode .= '</li>';
				} else {
					if ( trim( $product->post->post_type ) != 'product' || trim( $product->post->post_status ) != 'publish' ) {
						continue;
					}

					$ob_product_show_title     = get_option( 'ob_product_show_title', 'yes' );
					$ob_product_show_price     = get_option( 'ob_product_show_price', 'yes' );
					$ob_product_show_image     = get_option( 'ob_product_show_image', 'yes' );
					$ob_product_show_addtocart = get_option( 'ob_product_show_addtocart', 'yes' );
					$ob_product_show_linkable  = get_option( 'ob_product_show_linkable', 'yes' );
					$ob_product_images_sizes   = get_option( 'ob_product_images_sizes', 'shop_thumbnail' );


					$shortcode .= '<li class="product product-' . $product->id . '">';
					if ( trim( $ob_product_show_linkable ) == 'yes' ) {
						$shortcode .= '<a href="' . get_permalink( $product->id ) . '">';
					}
					if ( trim( $ob_product_show_image ) == 'yes' ) {
						$shortcode .= $product->get_image( $ob_product_images_sizes );
					}

					if ( trim( $ob_product_show_title ) == 'yes' ) {
						$shortcode .= '<h3>' . $product->get_title() . '</h3>';
					}

					if ( trim( $ob_product_show_price ) == 'yes' ) {
						$shortcode .= '<span class="price">' . $product->get_price_html() . '</span>';
					}
					if ( trim( $ob_product_show_linkable ) == 'yes' ) {
						$shortcode .= '</a>';
					}

					if ( trim( $ob_product_show_addtocart ) == 'yes' ) {
						$shortcode .= apply_filters( 'woocommerce_loop_add_to_cart_link',
							sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button add_to_cart_button %s product_type_%s">%s</a>',
								esc_url( $product->add_to_cart_url() ),
								esc_attr( $product->id ),
								esc_attr( $product->get_sku() ),
								$product->is_purchasable() ? 'add_to_cart_button' : '',
								esc_attr( $product->product_type ),
								esc_html( $product->add_to_cart_text() ) ),
							$product );
					}
					$shortcode .= '</li>';
				}
			}
			$shortcode .= '</ul></div>';

			return $shortcode;
		} else {
			return __( "Shortcode not correct", 'woosalescountdown' );
		}
	 }	
	}		
	add_shortcode('wd_sale_products_countdown','wd_sale_products_countdown');
	
	
	
?>