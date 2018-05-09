<?php
/*
Plugin Name: WD Color Demo
Plugin URI: http://www.wpdance.com/
Description: Load Color Demo
Author: Wpdance
Version: 1.0
Author URI: http://www.wpdance.com/
*/

if( !class_exists('WD_Color_Demo') ){
	class WD_Color_Demo{
		function __construct(){
			add_action('wp_enqueue_scripts', array($this, 'load_color'), 9999);
			add_action('template_redirect', array($this, 'template_redirect'), 9999);
		}
		function load_color(){
			if( isset($_GET['color']) ){
				$file_name = $_GET['color'];
				if( strstr($file_name, 'color') === false ){
					$file_name = 'color_'.$file_name;
				}
				if( $file_name != 'color_default' ){
					$file = get_template_directory() . '/config_xml/' . $file_name . '.xml';
					if( file_exists($file) ){
						$style = '';
						$objXML = simplexml_load_file($file);
						foreach( $objXML->children() as $child ){
							foreach( $child->items->children() as $childofchild ){
								$slug = (string)$childofchild->slug;
								$std = (string)$childofchild->std;
								
								$frontend =  $childofchild->frontend;
								foreach ($frontend->children() as $childoffrontend) {
									$attr = $childoffrontend->attribute;
									$selector = $childoffrontend->selector;

									if( gettype($selector->node) == 'object' ){
										$selector_child = $selector->children();
									}	
									
									if( isset($selector_child->selector_normal) ){
										$style .= $selector_child->selector_normal.'{';
										$style .= $attr.': '.$std.';';
										$style .= '}'."\n";
									}
									if( isset($selector_child->selector_important) ){
										$style .= $selector_child->selector_important.'{';
										$style .= $attr.': '.$std.' !important;';
										$style .= '}'."\n";
									}
									if( !(isset($selector_child->selector_normal) && isset($selector_child->selector_important)) ){
										$style .= $selector.'{';
										$style .= $attr.': '.$std.';';
										$style .= '}'."\n";
									}
								}
							}
						}
						wp_add_inline_style('responsive', $style);
						add_action('wp_enqueue_scripts', array($this, 'dequeue_custom_style'), 1000000000000000);
					}
				}
			}
		}
		
		function dequeue_custom_style(){
			wp_dequeue_style('custom-style');
		}
		
		function template_redirect(){
			global $tvlgiao_wpdance_wd_data;
			if( isset($_GET['header']) ){
				if( $_GET['header'] == 'ec' ){
					$tvlgiao_wpdance_wd_data['wd_woo_header'] = 0;
				}
				if( $_GET['header'] == 'woo' ){
					$tvlgiao_wpdance_wd_data['wd_woo_header'] = 1;
				}
			}
			
			if( $this->is_ec_page() ){
				$tvlgiao_wpdance_wd_data['wd_woo_header'] = 0;
			}
			
			/* Demo Header layout */
			if( isset($_GET['header_layout']) && in_array($_GET['header_layout'], array('v1', 'v2', 'v3')) ){
				$tvlgiao_wpdance_wd_data['wd_header_layout'] = $_GET['header_layout'];
			}
			if( isset($tvlgiao_wpdance_wd_data['wd_header_layout']) && $tvlgiao_wpdance_wd_data['wd_header_layout'] != 'v1' ){
				add_filter('icl_ls_languages', array($this, 'empty_ls_languages'));
				$tvlgiao_wpdance_wd_data['wd_currency_codes'] = '';
			}
		}
		
		function empty_ls_languages( $w_active_languages ){
			return array();
		}
		
		function is_ec_page(){
			$storepageid = get_option('ec_option_storepage');
			$cartpageid = get_option('ec_option_cartpage');
			$accountpageid = get_option('ec_option_accountpage');
			
			if( function_exists( 'icl_object_id' ) ){
				$storepageid = icl_object_id( $storepageid, 'page', true, ICL_LANGUAGE_CODE );
				$cartpageid = icl_object_id( $cartpageid, 'page', true, ICL_LANGUAGE_CODE );
				$accountpageid = icl_object_id( $accountpageid, 'page', true, ICL_LANGUAGE_CODE );
			}
			
			if( !empty($storepageid) && !empty($cartpageid) && !empty($accountpageid) ){
				if( is_page($storepageid) || is_page($cartpageid) || is_page($accountpageid) ){
					return true;
				}
			}
			return false;
		}
	}
}
new WD_Color_Demo();
?>