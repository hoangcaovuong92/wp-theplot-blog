<?php
// **********************************************************************// 
// ! Register New Element: Gap
// **********************************************************************//
vc_map( array(
	"name" => __("WD Gap", 'wpdance'),
	"base" => "wd_gap",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap height", 'wpdance'),
			"admin_label" => true,
			"param_name" => "height",
			"value" => "10",
			"description" => __("In pixels.", 'wpdance')
		)
	)
) );
?>