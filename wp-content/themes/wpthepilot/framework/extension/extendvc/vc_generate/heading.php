<?php

// **********************************************************************// 

// ! Register New Element: WD Heading

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Heading
// **********************************************************************//
$heading_params = array(
	"name" => __("Heading", 'wpdance'),
	"base" => "wd_heading",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
	
		// Heading
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Size", 'wpdance'),
			"admin_label" => true,
			"param_name" => "size",
			"value" => array(
				"H1" => 'h1',
				"H2" => 'h2',
				"H3" => 'h3',
				"H4" => 'h4',
				"H5" => 'h5',
				"H6" => 'h6'
			),
			"description" => '',
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Shown Icon", 'wpdance'),
			"admin_label" => true,
			"param_name" => "shown_icon",
			"value" => array(
				"Yes" => '1',
				"No" => '0',
			),
			"description" => '',
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Icon library', 'wpdance' ),
			'value' => array(
				__( 'Font Awesome', 'wpdance' ) => 'fontawesome',
				__( 'Open Iconic', 'wpdance' ) => 'openiconic',
				__( 'Typicons', 'wpdance' ) => 'typicons',
				__( 'Entypo', 'wpdance' ) => 'entypo',
				__( 'Linecons', 'wpdance' ) => 'linecons',
			),
			'admin_label' => true,
			'param_name' => 'type',
			'description' => __( 'Select icon library.', 'wpdance' ),
			"dependency" => Array('element' => "shown_icon", 'value' => array('1'))
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'wpdance' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'fontawesome',
			),
			'description' => __( 'Select icon from library.', 'wpdance' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'wpdance' ),
			'param_name' => 'icon_openiconic',
			'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'openiconic',
			),
			'description' => __( 'Select icon from library.', 'wpdance' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'wpdance' ),
			'param_name' => 'icon_typicons',
			'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'typicons',
			),
			'description' => __( 'Select icon from library.', 'wpdance' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'wpdance' ),
			'param_name' => 'icon_entypo',
			'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'entypo',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'wpdance' ),
			'param_name' => 'icon_linecons',
			'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'linecons',
			),
			'description' => __( 'Select icon from library.', 'wpdance' ),
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", 'wpdance'),
			"admin_label" => true,
			"param_name" => "style",
			"value" => array(
				"Style 1" => "style1",
				"Style 2" => "style2",
				"Style 3" => "style3",
				"Style 4" => "style4"
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
vc_map( $heading_params );
?>