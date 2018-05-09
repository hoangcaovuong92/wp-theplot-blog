<?php

// **********************************************************************// 

// ! Register New Element: WD Recent Blogs

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Recent Blogs
// **********************************************************************//
$categories = get_categories();
$list_categories = array(''=>'');
foreach($categories as $category ){
	$list_categories[$category->name] = $category->slug;
}
$recent_blogs_params = array(
	"name" => __("Recent Blogs", 'wpdance'),
	"base" => "wd_recent_blogs",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
	
		array(
			"type" => "wd_taxonomy",
			"taxonomy" => "category",
			"class" => "",
			"heading" => __("Category", "wpdance"),
			"admin_label" => true,
			"param_name" => "category",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_type",
			"value" => array(
					'List' 		=> 'list-posts',
					'Widget' 	=> 'widget'
				),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Text Position", 'wpdance'),
			"admin_label" => true,
			"param_name" => "text_position",
			"value" => array(
					'Left' 		=> 'left',
					'Right' 	=> 'right'
				),
			"dependency" => Array('element' => "show_type", 'value' => array('widget'))
		),	
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => '1',
			"dependency" => Array('element' => "show_type", 'value' => array('list-posts'))
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit", 'wpdance'),
			"admin_label" => true,
			"param_name" => "number_posts",
			"value" => '4',
			"description" => ''
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Thumbnail", 'wpdance'),
			"admin_label" => true,
			"param_name" => "thumbnail",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Title", 'wpdance'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Post Meta", 'wpdance'),
			"admin_label" => true,
			"param_name" => "meta",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Excerpt", 'wpdance'),
			"admin_label" => true,
			"param_name" => "excerpt",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"dependency" => Array('element' => "show_type", 'value' => array('list-posts'))
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Read More", 'wpdance'),
			"admin_label" => true,
			"param_name" => "read_more",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"dependency" => Array('element' => "show_type", 'value' => array('list-posts'))
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show View More Post", 'wpdance'),
			"admin_label" => true,
			"param_name" => "view_more",
			"value" => array(
					'Yes' => 'yes',
					'No' => 'no'
				),
			"dependency" => Array('element' => "show_type", 'value' => array('list-posts'))
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Blog link", 'wpdance'),
			"param_name" => "view_more_link",
			"value" => '',
			"dependency" => Array('element' => "view_more", 'value' => array('yes'))
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit Excerpt Words", 'wpdance'),
			"admin_label" => true,
			"param_name" => "excerpt_words",
			"value" => '30',
			"dependency" => Array('element' => "show_type", 'value' => array('list-posts'))
		),
		
	)
);
vc_map( $recent_blogs_params );
?>