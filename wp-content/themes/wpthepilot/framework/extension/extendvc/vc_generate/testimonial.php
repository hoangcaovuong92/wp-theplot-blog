<?php

// **********************************************************************// 

// ! Register New Element: WD Testimonial

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Testimonial
// **********************************************************************//
$is_woo_testimonial = true;
$_random_id = 'testi'.rand(); 
$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
if ( !in_array( "testimonials-by-woothemes/woothemes-testimonials.php", $_actived ) ) {
	$is_woo_testimonial = false;
}

if( $is_woo_testimonial ){
	$testimonials = woothemes_get_testimonials(array('limit'=>-1, 'size' => 100));
	$list_testimonials = array();
	if(!empty($testimonials)) {
		foreach( $testimonials as $testimonial ){
			$list_testimonials[$testimonial->post_title] = $testimonial->ID;
		}
	}
	$testimonial_params = array(
		"name" => __("Testimonial", 'wpdance'),
		"base" => "wd_testimonial",
		"icon" => "icon-wpb-wpdance",
		"category" => "WPDance Elements",
		"params" => array(
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Heading", "wpdance"),
				"admin_label" => true,
				"param_name" => "title",
				"value" => "",
				"description" => "",
			),
			array(
			"type" => "wd_taxonomy",
			"taxonomy" => "testimonial-category",
			"class" => "",
			"heading" => __("Category Slug", 'wpdance'),
			"admin_label" => true,
			"param_name" => "cat_test_slug",
			"value" => "",
			"description" => ''
		    ),			
			array(
				"type" => "dropdown",
				"heading" => __("Style", 'wpdance'),
				"param_name" => "style",
				"value" => array(
					"Style 1"	=> 'style1',
					"Style 2"	=> 'style2',
					"Style 3"	=> 'style3',
					"Style 4"	=> 'style4',
					"Style 5"	=> 'style5',
					"Style 6"	=> 'style6'
				),
				"description" => '',
			),									
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Testimonial", 'wpdance'),
				"admin_label" => true,
				"param_name" => "id",
				"value" => $list_testimonials,
				"description" => '',
				"dependency" => Array('element' => "style", 'value' => array('style3','style5'))
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Limit", 'wpdance'),
				"admin_label" => true,
				"param_name" => "limit",
				"value" => '3',
				"description" => '',
				"dependency" => Array('element' => "style", 'value' => array('style4'))
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Image", "wpdance"),
				"admin_label" => true,
				"param_name" => "show_img",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Meta Time", "wpdance"),
				"admin_label" => true,
				"param_name" => "show_date",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Short Content", "wpdance"),
				"admin_label" => true,
				"param_name" => "show_short",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Excerpt word number", 'wpdance'),
				"admin_label" => true,
				"param_name" => "short_limit",
				"value" => "20",
				"description" => __("Limit number of Excerpt words", 'wpdance')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Nav", "wpdance"),
				"admin_label" => true,
				"param_name" => "show_nav",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Nav Position", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_nav_pos",
				"value" => array(
					"Pos 1 (Top Right)" 	=> "top_right",
                    "Pos 2 (Middle center)" => "middle_center",
                    "Pos 3 (Bottom Center)" => "bottom_center",
				),
				"dependency" => Array('element' => "show_nav", 'value' => array('1'))
			),
			
		)
	);
	vc_map( $testimonial_params );
}
?>