<?php

// **********************************************************************// 

// ! Register New Element: WD Gallery

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD WD Gallery
// **********************************************************************//

$wd_gallery = array(
	"name" => esc_html__("WD Gallery", 'wpgeneral'),
	"base" => "wd_gallery",
	"icon" => "icon-wpb-wpdance",
	"category" => esc_html__('WPDance Elements', 'wpgeneral'),
	"params" => array(
		
		array(
			"type" => "attach_images",
			"class" => "",
			"heading" => esc_html__("Image", 'wpgeneral'),
			"param_name" => "images",
			"value" => "",
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Size", 'wpgeneral'),
			"admin_label" => true,
			"param_name" => "size",
			"value" => "",
			"description" => esc_html__('1 = 600x600, 2 = 600x300, 3 = 300x300,...','wpgeneral')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Columns", 'wpgeneral'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "",
			"description" => esc_html__('1 = 100%, 2 = 50%, 4 = 25%,...','wpgeneral')
		),
		
	)
);
vc_map( $wd_gallery );
?>