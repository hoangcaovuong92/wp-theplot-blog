<?php
// **********************************************************************// 
// ! Register New Element:Pricing Table
// **********************************************************************//
$ptable_params = array(
	"name" => __("Pricing Table", 'wpdance'),
	"base" => "wd_ptable",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	"allowed_container_element" => 'vc_row',
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'wpdance'),
			"param_name" => "title",
			"value" => __("Basic Plan", 'wpdance'),
			"description" => ""
		),
		array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Style", 'wpdance'),
				"admin_label" => true,
				"param_name" => "pricing_style",
				"value" => array(
						'Style 1' => 'style1',
						'Style 2' => 'style2',
						'Style 3' => 'style3'
					),
				"description" => ''
			),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Price", 'wpdance'),
			"param_name" => "price",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Currency", 'wpdance'),
			"param_name" => "currency",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Price Period", 'wpdance'),
			"param_name" => "price_period",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Link", 'wpdance'),
			"param_name" => "link",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Target", 'wpdance'),
			"param_name" => "target",
			"value" => array(
				"" => "",
				"Self" => "_self",
				"Blank" => "_blank",	
				"Parent" => "_parent"
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Text", 'wpdance'),
			"param_name" => "button_text",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Active", 'wpdance'),
			"param_name" => "active",
			"value" => array(
				"No" => "no",
				"Yes" => "yes"	
			),
			"description" => ""
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'wpdance'),
			"param_name" => "content",
			"value" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
			"description" => ""
		)
	)
);
vc_map($ptable_params);
?>