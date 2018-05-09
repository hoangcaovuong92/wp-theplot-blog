<?php
/**
 * @package WordPress
 * @subpackage WP Woo Glory
 * @since wd_glory
 **/

$_template_path = get_template_directory();
require_once $_template_path."/framework/abstract.php";
$theme = new WdTheme(array(
	'theme_name'	=>	"WP Woo General",
	'theme_slug'	=>	'wd_general'
));
$theme->init();
require_once ('admin/index.php');
add_action( 'init', 'woocommerce_clear_cart_url' );
function woocommerce_clear_cart_url() {
  global $woocommerce;

    if (isset( $_REQUEST['empty-cart'] ) ) { 
        $woocommerce->cart->empty_cart(); 
    }
}
?>