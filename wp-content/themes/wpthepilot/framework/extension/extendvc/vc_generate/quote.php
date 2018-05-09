<?php

// **********************************************************************// 

// ! Register New Element: WD Quote

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Quote
// **********************************************************************//

$quote_params = array(
	"name" => __("Quote", 'wpdance'),
	"base" => "wd_quote",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
	
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Custom class", 'wpdance'),
			"admin_label" => true,
			"param_name" => "class",
			"value" => '',
			"description" => '',
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", 'wpdance'),
			"admin_label" => true,
			"param_name" => "style",
			"value" => array(
				"Style 1" => "style1",
				"Style 2" => "style2"
			),
			"description" => '',
		),
		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Content", 'wpdance'),
			"admin_label" => true,
			"param_name" => "content",
			"value" => "",
			"description" => '',
		),
		
	)
);
vc_map( $quote_params );
?>