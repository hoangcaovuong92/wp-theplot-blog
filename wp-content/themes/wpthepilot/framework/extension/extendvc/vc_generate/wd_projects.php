<?php

// **********************************************************************// 
// ! Register New Element: Our Project
// **********************************************************************//
$our_project_params = array(
	'name' => 'Our Projects',
	'base' => 'wd_projects',
	'icon' => 'icon-wpb-wpdance',
	'category' => 'WPDance Elements',
	'params' => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "slider",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ''
		),
		
		array(
		  'type' => 'textfield',
		  "heading" => __("Columns", 'wpdance'),
		  "param_name" => "columns",
		  "value" => "4"
		),
		// add orderby dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order By", 'wpdance'),
			"admin_label" => true,
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Title" => "title",
				"Rand" => "rand"
			),
			"description" => ''
		),
		// Order
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", 'wpdance'),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", 'wpdance')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit", 'wpdance'),
			"param_name" => "limit",
			"value" => "12",
			"description" => ''
		),
		array(
			"type" => "textfield",
			"heading" => __("Exclude Categories", 'wpdance'),
			"param_name" => "exclude_categories",
			"description" => __('Separated by ","', 'wpdance')
		)
	)
);  
vc_map($our_project_params);

?>