<?php

// **********************************************************************// 

// ! Register New Element: WD Recent Simple Blogs

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Recent Simple Blogs
// **********************************************************************//

$recent_simple_blogs_params = array(
	"name" => __("Recent Simple Blogs", 'wpdance'),
	"base" => "wd_recent_simple_blogs",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
	
		// Heading
		array(
			"type" => "wd_simple_post",
			"class" => "",
			"heading" => __("Name Post", 'wpdance'),
			"admin_label" => true,
			"param_name" => "slug_simple",
			"value" => "",
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show images", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
					'Yes' => 1,
					'No' => 0
				),
			"description" => ''
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
		)
	)
);
vc_map( $recent_simple_blogs_params );
?>