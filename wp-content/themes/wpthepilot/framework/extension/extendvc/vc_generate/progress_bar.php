<?php

// **********************************************************************// 

// ! Register New Element: WD Progress Bar

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Progress Bar
// **********************************************************************//

$progress_params = array(
	"name" => __("Progress Bar", 'wpdance'),
	"base" => "wd_progress",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'wpdance'),
			"admin_label" => true,
			"param_name" => "animated_bars",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Strip", 'wpdance'),
			"admin_label" => true,
			"param_name" => "striped_bars",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"description" => ''
		),
		
	)
);
vc_map( $progress_params );

?>