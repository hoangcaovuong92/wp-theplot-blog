<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 

// ! Register New Element: WD Specific Product

// **********************************************************************//

$specipic_product_params = array(
	"name" => __("WD Banner", 'wpdance'),
	"base" => "banner",
	"icon" => "icon-wpb-wpdance-banner",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
	
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Link", 'wpdance'),
			"param_name" => "link_url",
			"value" => "#",
			"description" => '',
		),
		
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Background color", 'wpdance'),
			"param_name" => "bg_color",
			"value" => "#cccccc",
			"description" => '',
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Background Image", 'wpdance'),
			"param_name" => "bg_image",
			"value" => "",
			"description" => '',
		),
		
		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Content", 'wpdance'),
			"param_name" => "content",
			"value" => "",
			"description" => '',
		),							
	)
);
vc_map( $specipic_product_params );
?>