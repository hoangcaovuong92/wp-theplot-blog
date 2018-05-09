<?php

// **********************************************************************// 

// ! Register New Element: WD Portfolio

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Portfolio
// **********************************************************************//
if( class_exists('WD_Portfolio') ){
	
	$portfolio_params = array(
		"name" => __("Portfolio", 'wpdance'),
		"base" => "wd-portfolio",
		"icon" => "icon-wpb-wpdance",
		"category" => __('WPDance Elements', 'wpdance'),
		"params" => array(
		
			// Heading
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Columns", 'wpdance'),
				"admin_label" => true,
				"param_name" => "columns",
				"value" => '4',
				"description" => '',
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Style", 'wpdance'),
				"admin_label" => true,
				"param_name" => "portf_style",
				"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2',
						'Style 3' => 'style3',
						'Style 4' => 'style4',
						'Style 5' => 'style5'
					),
				"description" => ''
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Filter", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_filter",
				"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Title", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_title",
				"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					)
				
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Description", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_desc",
				"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Limit", 'wpdance'),
				"admin_label" => true,
				"param_name" => "count",
				"value" => '-1',
				"description" => ''
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Page", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_pages",
				"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					)
				
			),
		)
	);
	vc_map( $portfolio_params );
}
?>