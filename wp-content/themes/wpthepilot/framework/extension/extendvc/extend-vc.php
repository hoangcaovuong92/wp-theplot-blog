<?php

// **********************************************************************// 
// ! Register New Element: WD Product Category

// ! Register New Element: WD Product Category Grid Style

// ! Register New Element: WD Popular Product Category

// ! Register New Element: WD Product Category List Style

// ! Register New Element: WD Feature Product

// ! Register New Element: WD Popular Product

// ! Register New Element: WD Recent Products

// ! Register New Element: WD Best Selling Products

// ! Register New Element: WD Best Selling By Category Products

// ! Register New Element: WD Recent Products By Category Products
// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$args = array(
	'number'     => '',
	'orderby'    => 'name',
	'order'      => 'ASC',
	'hide_empty' => true,
	'include'    => array()
);
/*
$product_categories = get_terms( 'product_cat', $args );
$arr_categories = array();
foreach($product_categories as $category){
	if(isset($category->slug)){
		if(trim($category->slug) == trim($check)){
			$checked = 'selected="selected"';
		}
		$categories_show  .= '<option '.$checked.' value="'.$category->slug.'">'.$category->name.'</option>';
		$checked = '';
	}
}
*/
// Removing shortcodes
vc_remove_element("vc_button", 'wpdance');
vc_remove_element("vc_button2", 'wpdance');
vc_remove_element("vc_cta_button", 'wpdance');
vc_remove_element("vc_cta_button2", 'wpdance');


//***********************************************************************
// Row
//***********************************************************************
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"show_settings_on_create"=>true,
	"heading" => __("Row Type 1", 'wpdance'),
	"param_name" => "row_type 2",
	"value" => array(
		"Row" => "row",
		"Section" => "section"
	)
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => __("Minimum height", 'wpdance'),
	"param_name" => "min_height",
	"description" => __("You can use pixels (px) or percents (%).", 'wpdance')
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Type", 'wpdance'),
	"param_name" => "type",
	"value" => array(
		"In Grid" => "grid",
		"Full Width" => "full"	
	),
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Content In Grid", 'wpdance'),
	"param_name" => "content_grid",
	"value" => array(
		"" => "false"
	),
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
// parallax speed
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Enable parallax", 'wpdance'),
	"param_name" => "enable_parallax",
	"value" => array(
		"" => "false"
	),
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Fixed image", 'wpdance'),
	"param_name" => "parallax_fixed",
	"value" => array(
		"" => "true"
	),
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Parallax speed", 'wpdance'),
	"param_name" => "parallax_speed",
	"value" => "0.1",
	"dependency" => array(
		"element" => "enable_parallax",
		"not_empty" => true
	)
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Video background", 'wpdance'),
	"value" => array(__("Use video background?", 'wpdance') => "show_video" ),
	"param_name" => "bg_video",
	"description" => "",
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Video overlay", 'wpdance'),
	"value" => array(__("Use transparent overlay over video?", 'wpdance') => "show_video_overlay" ),
	"param_name" => "bg_video_overlay",
	"description" => "",
	"dependency" => Array('element' => "bg_video", 'value' => array('show_video'))
));
vc_add_param("vc_row", array(
	"type" => "attach_image",
	"class" => "",
	"heading" => __("Video poster image", 'wpdance'),
	"param_name" => "video_poster",
	"value" => "",
	"description" => "",
	"dependency" => Array('element' => "bg_video", 'value' => array('show_video'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Video background (mp4) file url", 'wpdance'),
	"value" => "",
	"param_name" => "bg_video_src_mp4",
	"description" => "",
	"dependency" => Array('element' => "bg_video", 'value' => array('show_video'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Video background (ogv) file url", 'wpdance'),
	"value" => "",
	"param_name" => "bg_video_src_ogv",
	"description" => "",
	"dependency" => Array('element' => "bg_video", 'value' => array('show_video'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Video background (webm) file url", 'wpdance'),
	"value" => "",
	"param_name" => "bg_video_src_webm",
	"description" => "",
	"dependency" => Array('element' => "bg_video", 'value' => array('show_video'))
));


//***********************************************************************
// Column Text
//***********************************************************************
vc_add_param("vc_column_text", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Align", 'wpdance'),
	"param_name" => "align",
	"value" => array(
		"" => "",
		"Left" => "left",
		"Center" => "center",
		"Right" => "right"
	)
));




//***********************************************************************
// Separator
//***********************************************************************

//Get current values stored in the style param in "Separator" element
$param = WPBMap::getParam('vc_separator', 'style');
//Append new value to the 'value' array
$param['type'] = 'dropdown';
$param['value'] = array(
		"New" => "new",
		"Border" => "",
		"Dashed" => "dashed",
		"Dotted" => "dotted",
		"Double" => "double"
	);
//Finally "mutate" param with new values
WPBMap::mutateParam('vc_separator', $param);

vc_add_param("vc_separator", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Thickness (px)", 'wpdance'),
	"param_name" => "thickness",
	"value" => "",
	"description" => ""
));
vc_add_param("vc_separator", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Top Margin (px)", 'wpdance'),
	"param_name" => "up",
	"value" => "",
	"description" => ""
));
vc_add_param("vc_separator", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Bottom Margin (px)", 'wpdance'),
	"param_name" => "down",
	"value" => "",
	"description" => ""
));


//***********************************************************************
// Single image
//***********************************************************************
vc_add_param("vc_single_image", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => __("Widget title color", 'wpdance'),
	"param_name" => "title_color",
	"value" => ""
));
vc_add_param("vc_single_image", array(
	"type" => "textarea_html",
	"class" => "",
	"heading" => __("Text below the image", 'wpdance'),
	"param_name" => "img_description",
	"value" => "",
	"description" => "Enter text which will be used as description. Leave blank if no description is needed."
));
vc_add_param("vc_single_image", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Button text", 'wpdance'),
	"param_name" => "img_button",
	"value" => "",
	"description" => "Enter text which will be used as button text. Leave blank if no button is needed."
));
vc_add_param("vc_single_image", array(
	"type" => "attach_images",
	"class" => "",
	"heading" => __("Label", 'wpdance'),
	"param_name" => "label",
	"value" => "",
	"description" => ""
));
vc_add_param("vc_single_image", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Label size", 'wpdance'),
	"param_name" => "label_size",
	"value" => "",
	"description" => "Enter image size. Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size."
));


//***********************************************************************
// Default button
//***********************************************************************
vc_add_param("vc_button", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Margin (px)", 'wpdance'),
	"param_name" => "margin",
	"value" => "",
	"description" => __("Margin (top right bottom left - 5px 5px 5px 5px)", 'wpdance')
));


//***********************************************************************
// Default button 2
//***********************************************************************
vc_add_param("vc_button2", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Margin (px)", 'wpdance'),
	"param_name" => "margin",
	"value" => "",
	"description" => __("Margin (top right bottom left - 5px 5px 5px 5px)", 'wpdance')
));


//***********************************************************************
// Pie chart
//***********************************************************************

//Get current values stored in the color param in "Pie chart" element
$param = WPBMap::getParam('vc_pie', 'color');
//Append new value to the 'value' array
$param['value'] = '#f7f7f7';
$param['type'] = 'colorpicker';
//Finally "mutate" param with new values
WPBMap::mutateParam('vc_pie', $param);

// add appearance dropdown
vc_add_param("vc_pie", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Appearance", 'wpdance'),
	"admin_label" => true,
	"param_name" => "appearance",
	"value" => array(
		"Pie chart (default)" => "default",
		"Counter" => "counter"
	),
	"description" => ''
));

// add custom color selector
vc_add_param("vc_pie", array(
	"type" => "colorpicker",
	"heading" => __("Bar color", 'wpdance'),
	"param_name" => "color",
	"value" => '#f7f7f7',
	"description" => ''
));

// add Pie Chart Line Width
vc_add_param("vc_pie", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Pie Chart Line Width (px)", 'wpdance'),
	"param_name" => "line_width",
	"value" => "",
	"description" => "Width of the bar line in px.",
	"dependency" => Array('element' => "appearance", 'value' => array('default'))
));
// add pie size
vc_add_param("vc_pie", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Size (px)", 'wpdance'),
	"param_name" => "size",
	"value" => ""
));


//***********************************************************************
// Progress bar
//***********************************************************************
vc_add_param("vc_progress_bar", array(
	"type" => "colorpicker",
	"heading" => __("Values color", 'wpdance'),
	"param_name" => "color",
	"value" => '#ffffff',
	"description" => ''
));


// **********************************************************************// 
// ! Register New Element: Awesome Icon
// **********************************************************************//
$icon_box_params = array(
	'name' => 'Awesome Icon',
	'base' => 'wd_icon',
	'icon' => 'icon-wpb-wpdance',
	'category' => 'by WPDance',
	'class'	=> '',
	'params' => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'wpdance'),
			"param_name" => "title",
			"value" => "",
			"description" => "blank if you don't want to display"
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "wd_awesome",
			"heading" => __("Size", 'wpdance'),
			"param_name" => "size",
			"value" => array(
				"Tiny" => "fa-lg",
				"Small" => "fa-2x",
				"Medium" => "fa-3x",	
				"Large" => "fa-4x",
				"Very Large" => "fa-5x"	
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Custom Size (px)", 'wpdance'),
			"param_name" => "custom_size",
			"value" => ""
		),
		array(
			"type" => "wd_icon",
			"class" => "",
			"heading" => __("Icon", 'wpdance'),
			"param_name" => "icon",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Type", 'wpdance'),
			"param_name" => "type",
			"value" => array(
				"Normal" => "normal",
				"Circle" => "circle",
				"Square" => "square"	
			),
			"description" => ""
		),
		/*array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Position", 'wpdance'),
			"param_name" => "position",
			"value" => array(
				"Normal" => "",
				"Left" => "left",
				"Center" => "center",
				"Right" => "right"	
			),
			"description" => ""
		),*/
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Border", 'wpdance'),
			"param_name" => "border",
			"value" => array(
				"Yes" => "yes",
				"No" => "no"	
			),
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Border Color", 'wpdance'),
			"param_name" => "border_color",
			"description" => __("Only for Square type", 'wpdance'),
			"dependency" => Array('element' => "type", 'value' => array('square'))
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Icon Color", 'wpdance'),
			"param_name" => "icon_color",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Background Color", 'wpdance'),
			"param_name" => "background_color",
			"description" => "",
			"dependency" => Array('element' => "type", 'value' => array('square','circle'))
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Margin (px)", 'wpdance'),
			"param_name" => "margin",
			"description" => __("Margin (top right bottom left - 5px 5px 5px 5px)", 'wpdance')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Distance (px)", 'wpdance'),
			"param_name" => "distance",
			"description" => __("For example: 10", 'wpdance')
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("CSS Animation", 'wpdance'),
			"param_name" => "css_animation",
			"value" => array(
				"No" => "",
				"Top to bottom" => "top-to-bottom",
				"Bottom to top" => "bottom-to-top",
				"Left to right" => "left-to-right",
				"Right to left" => "right-to-left",
				"Appear from center" => "appear"
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Link", 'wpdance'),
			"param_name" => "link",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Target", 'wpdance'),
			"param_name" => "target",
			"value" => array(
				"Self" => "_self",
				"Blank" => "_blank",
				"Parent" => "_parent"	
			),
			"description" => ""
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Enable tooltip", 'wpdance'),
			"param_name" => "enable_tooltip",
			"value" => array(
				"" => "false"
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Tooltip title", 'wpdance'),
			"param_name" => "tooltip_title",
			"value" => "",
			"dependency" => array(
				"element" => "enable_tooltip",
				"not_empty" => true
			)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Tooltip direction", 'wpdance'),
			"param_name" => "tooltip_direction",
			"value" => array(
				"Left" => "left",
				"Top" => "top",
				"Bottom" => "bottom",
				"Right" => "right"
			),
			"dependency" => array(
				"element" => "enable_tooltip",
				"not_empty" => true
			)
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'wpdance'),
			"param_name" => "class",
			"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpdance')
		)
	)
);  
vc_map($icon_box_params);


// **********************************************************************// 
// ! Register New Element: Bar Chart shortcode
// **********************************************************************//
vc_map( array(
		"name" => __("Bar Chart", 'wpdance'),
		"base" => "wd_bar_chart",
		"icon" => "icon-wpb-wpdance",
		"category" => 'by WPDance',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Width", 'wpdance'),
				"param_name" => "width",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Height", 'wpdance'),
				"param_name" => "height",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Custom Color", 'wpdance'),
				"param_name" => "custom_color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Scale steps", 'wpdance'),
				"param_name" => "scalesteps",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Scale step width", 'wpdance'),
				"param_name" => "scalestepwidth",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Labels", 'wpdance'),
				"param_name" => "labels",
				"value" => __("Label 1 | Label 2 | Label 3", 'wpdance')
			),
			array(
				"type" => "exploded_textarea",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content", 'wpdance'),
				"param_name" => "chart",
				"value" => "#eb005d|Legend One|1|5|10 \n #80c5d2|Legend Two|3|7|20 \n #f07d6f|Legend Three|10|2|34",
				"description" => "Input chart values here. Divide values with linebreaks (Enter). Example: #eb005d|Legend One|1|5|10"
			)
		)
) );


// **********************************************************************// 
// ! Register New Element: Button
// **********************************************************************//
$button_params = array(
	"name" => __("Button", 'wpdance'),
	"base" => "wd_button",
	"icon" => "icon-wpb-wpdance",
	"category" => 'by WPDance',
	"params" => array(
		
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button text", 'wpdance'),
			"param_name" => "content",
			"value" => "Label 1"
		),
		// Link Url
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Link URL", 'wpdance'),
			"param_name" => "link",
			"value" => "",
			"description" => ""
		),		

		// Style
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", 'wpdance'),
			"param_name" => "size",
			"value" => array(
				"Mini" => "mini",
				"Small button" => "small",
				"Medium" => "medium",
				"Big button" => "big",
				"Extra button" => "extra"
			),
			"description" => ""
		),

		// Button color
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button color", 'wpdance'),
			"param_name" => "color",
			"value" => array(
				"Custom color" => "custom",
				"Aqua" => "aqua",
				"Black" => "black",
				"Brown" => "brown",
				"Blue Violet" => "blue_violet",
				"Green" => "green",
				"Indigo" => "indigo",
				//"Magenta" => "magenta",			
				"Orange" => "orange",
				//"Purple" => "purple",
				//"Pink" => "pink",
				"Red" => "red",
				//"White" => "white",
				"Yellow" => "yellow"
			),
			"description" => ""
		),
		
		// Button color
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button opacity", 'wpdance'),
			"param_name" => "opacity",
			"value" => array(
				"1x" => "1x",
				"2x" => "2x",
				"3x" => "3x",
				"4x" => "4x",
			),
			"description" => ""
		),
		
		// with Background
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button background", 'wpdance'),
			"param_name" => "background",
			"value" => array(
				"With background" => "yes",
				"No background" => "no"
			),
			"description" => "",
		),
				
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'wpdance'),
			"param_name" => "custom_class",
			"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpdance')
		)
	)
);
vc_map( $button_params );



// **********************************************************************// 
// ! Register New Element: Call to Action
// **********************************************************************//
vc_map( array(
		"name" => __("Call to Action", 'wpdance'),
		"base" => "wd_action",
		"category" => 'by WPDance',
		"icon" => "icon-wpb-wpdance",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Type", 'wpdance'),
				"param_name" => "type",
				"value" => array(
					"Normal" => "normal",
					"With Border" => "with_border"
				),
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Background Color", 'wpdance'),
				"param_name" => "background_color",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Border Color", 'wpdance'),
				"param_name" => "border_color",
				"description" => "",
				"dependency" => array(
					"element" => "type",
					"value" => array(
						"with_border"
					)
				)
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Border Style", 'wpdance'),
				"param_name" => "border_style",
				"description" => "",
				"value" => array(
					"Border" => "",
					"Dashed" => "dashed",
					"Dotted" => "dotted",
					"Double" => "double"
				),
				"dependency" => array(
					"element" => "type",
					"value" => array(
						"with_border"
					)
				)
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Border Color", 'wpdance'),
				"param_name" => "border_color",
				"description" => "",
				"dependency" => array(
					"element" => "type",
					"value" => array(
						"with_border"
					)
				)
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Border Width (in px)", 'wpdance'),
				"param_name" => "border_width",
				"description" => "",
				"value" => "1",
				"dependency" => array(
					"element" => "type",
					"value" => array(
						"with_border"
					)
				)
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Border Radius (in px)", 'wpdance'),
				"param_name" => "border_radius",
				"description" => "",
				"value" => "",
				"dependency" => array(
					"element" => "type",
					"value" => array(
						"with_border"
					)
				)
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
				"heading" => __("Link Target", 'wpdance'),
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
				"heading" => __("Link Text", 'wpdance'),
				"param_name" => "link_text",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Link Text Color", 'wpdance'),
				"param_name" => "link_text_color",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Link Background Color", 'wpdance'),
				"param_name" => "link_background_color",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Link Size", 'wpdance'),
				"param_name" => "link_size",
				"value" => array(
					"Default" => "default",
					"Small" => "small",
					"Big" => "big",
					"Extra" => "extra"
				),
				"description" => ""
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content", 'wpdance'),
				"param_name" => "content",
				"value" => "<p>".__("I am test text for Call to Action.", 'wpdance')."</p>",
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Align", 'wpdance'),
				"param_name" => "align",
				"value" => array(
					"Left" => "left",
					"Center" => "center",
					"Right" => "right"
				),
				"description" => ""
			)
		)
) );


// **********************************************************************// 
// ! Register New Element: Code
// **********************************************************************//
$code_params = array(
	"name" => __("Code", 'wpdance'),
	"base" => "wd_code",
	"icon" => "icon-wpb-wpdance",
	"category" => 'by WPDance',
	"allowed_container_element" => 'vc_row',
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'wpdance'),
			"param_name" => "title",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "textarea_raw_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'wpdance'),
			"param_name" => "code",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'wpdance'),
			"param_name" => "class",
			"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpdance')
		)
	)
);
vc_map($code_params);


// **********************************************************************// 
// ! Register New Element: Counter
// **********************************************************************//
vc_map( array(
		"name" => __("Counter", 'wpdance'),
		"base" => "wd_counter",
		"category" => 'by WPDance',
		"icon" => "icon-wpb-wpdance",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Widget title", 'wpdance'),
				"param_name" => "title",
				"description" => "Enter text which will be used as widget title. Leave blank if no title is needed."
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"admin_label" => true,
				"heading" => __("Counter value", 'wpdance'),
				"param_name" => "value",
				"description" => "Input integer value for label"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Counter value start", 'wpdance'),
				"param_name" => "init",
				"description" => "Input integer value for label. If empty 0 will be used"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Units", 'wpdance'),
				"param_name" => "units",
				"description" => "Enter measurement units (if needed) Eg. %, px, points, etc."
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Color", 'wpdance'),
				"param_name" => "color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Size (in px)", 'wpdance'),
				"param_name" => "size",
				"description" => ""
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Caption", 'wpdance'),
				"param_name" => "caption",
				"value" => "",
				"description" => "Enter text which will be used as widget caption. Leave blank if no caption is needed."
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Extra class name", 'wpdance'),
				"param_name" => "class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wpdance')
			)
		)
) );


// **********************************************************************// 
// ! Register New Element: Custom Text
// **********************************************************************//
$customtext_params = array(
	"name" => __("Custom Text", 'wpdance'),
	"base" => "wd_custom_text",
	"icon" => "icon-wpb-wpdance",
	"category" => 'by WPDance',
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Font family", 'wpdance'),
			"param_name" => "font_family",
			"value" => __("Oswald", 'wpdance')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Font size", 'wpdance'),
			"param_name" => "font_size",
			"value" => "15"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Line height", 'wpdance'),
			"param_name" => "line_height",
			"value" => "26"
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Font Style", 'wpdance'),
			"param_name" => "font_style",
			"value" => array(
				"Normal" => "normal",
				"Italic" => "italic"	
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text Align", 'wpdance'),
			"param_name" => "text_align",
			"value" => array(
				"Left" => "left",
				"Center" => "center",
				"Right" => "right"	
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Font weight", 'wpdance'),
			"param_name" => "font_weight",
			"value" => "300"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Color", 'wpdance'),
			"param_name" => "color",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text decoration", 'wpdance'),
			"param_name" => "text_decoration",
			"value" => array(
				"None" => "none",
				"Underline" => "underline",
				"Overline" => "overline",
				"Line Through" => "line-through"	
			),
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Background Color", 'wpdance'),
			"param_name" => "background_color",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Padding (px)", 'wpdance'),
			"param_name" => "padding",
			"value" => "0"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Margin (px)", 'wpdance'),
			"param_name" => "margin",
			"value" => "0",
			"description" => __("Margin (top right bottom left - 5px 5px 5px 5px)", 'wpdance')
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'wpdance'),
			"param_name" => "content",
			"value" => "<p>content content content</p>",
			"description" => ""
		)
	)
);
vc_map( $customtext_params );


// **********************************************************************// 
// ! Register New Element: DropCap
// **********************************************************************//
$dropcap_params = array(
	"name" => __("DropCap", 'wpdance'),
	"base" => "dropcap",
	"icon" => "icon-wpb-wpdance",
	"category" => 'by WPDance',
	"params" => array(
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Color", 'wpdance'),
			"param_name" => "color",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Dropcap Text", 'wpdance'),
			"param_name" => "dropcap",
			"value" => "Text",
			"description" => ""
		),		
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'wpdance'),
			"param_name" => "content",
			"value" => "content content content",
			"description" => ""
		)
	)
);
vc_map( $dropcap_params );

// **********************************************************************// 
// ! Register New Element: Feedburner Subscription
// **********************************************************************//
vc_map( array(
		"name" => __("Feedburner Subscription", 'wpdance'),
		"base" => "wd_feedburner",
		"icon" => "icon-wpb-wpdance",
		"category" => 'by WPDance',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Feedburner ID", 'wpdance'),
				"param_name" => "feedburner",
				"value" => "",
				"description" => ""
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content", 'wpdance'),
				"param_name" => "intro",
				"value" => "Sign-up for our newsletter. We promise only send good news!",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Default text", 'wpdance'),
				"param_name" => "text",
				"value" => "Subscribe",
				"description" => ""
			),
			
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Box border", 'wpdance'),
				"param_name" => "box_border",
				"description" => ""
			),
			
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Show button", 'wpdance'),
				"param_name" => "show_button",
				"value" => array(
					"" => "false"
				)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button text", 'wpdance'),
				"param_name" => "button_text",
				"value" => "",
				"dependency" => array(
					"element" => "show_button",
					"not_empty" => true
				)
			),
			
			// Style
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button size", 'wpdance'),
				"param_name" => "button_size",
				"value" => array(
					"Default button" => "default",
					"Small button" => "small",
					"Big button" => "big",
					"Extra button" => "extra"
				),
				"description" => "",
				"dependency" => array(
					"element" => "show_button",
					"not_empty" => true
				)
			),
			
			// Fluid width
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Fluid width", 'wpdance'),
				"param_name" => "button_fluid",
				"value" => array(
					"" => "true"
				),
				"dependency" => array(
					"element" => "show_button",
					"not_empty" => true
				)
			),

			// Button style
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button style", 'wpdance'),
				"param_name" => "button_style",
				"value" => array(
					"White" => "white",
					"Red" => "red",
					"Orange" => "orange",
					"Yellow" => "yellow",
					"Green" => "green",
					"Aquamarine" => "aquamarine",
					"Aqua" => "aqua",
					"Azure" => "azure",
					"Dark purple" => "dark_purple",
					"Purple" => "purple",
					"Pink" => "pink",
					"Black" => "black",
					"Custom color" => "custom"
				),
				"description" => "",
				"dependency" => array(
					"element" => "show_button",
					"not_empty" => true
				)
			),
			
			// with Background
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("With background", 'wpdance'),
				"param_name" => "isbackground",
				"value" => array(
					"With background" => "yes",
					"No background" => "no"
				),
				"description" => "",
				"dependency" => array(
					"element" => "button_style",
					"value" => array(
						"red",
						"orange",
						"yellow",
						"green",
						"aquamarine",
						"aqua",
						"azure",
						"dark_purple",
						"purple",
						"pink",
						"black",
						"white"
					)
				)
			),
			
			// Custom button color
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button color", 'wpdance'),
				"param_name" => "custom_color",
				"description" => "",
				"dependency" => array(
					"element" => "style",
					"value" => array(
						"custom"
					)
				)
			),
			
			// Custom button background color
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button background color", 'wpdance'),
				"param_name" => "custom_background_color",
				"description" => "",
				"dependency" => array(
					"element" => "style",
					"value" => array(
						"custom"
					)
				)
			),
			
			// Custom button border color
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button border color", 'wpdance'),
				"param_name" => "custom_border_color",
				"description" => "",
				"dependency" => array(
					"element" => "style",
					"value" => array(
						"custom"
					)
				)
			)
		)
) );


// **********************************************************************// 
// ! Register New Element: Gap
// **********************************************************************//
vc_map( array(
	"name" => __("Gap", 'wpdance'),
	"base" => "wd_gap",
	"icon" => "icon-wpb-wpdance",
	"category" => 'by WPDance',
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


// **********************************************************************// 
// ! Register New Element: Line Graph shortcode
// **********************************************************************//
vc_map( array(
		"name" => __("Line Graph", 'wpdance'),
		"base" => "wd_line_graph",
		"icon" => "icon-wpb-wpdance",
		"category" => 'by WPDance',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Type", 'wpdance'),
				"param_name" => "type",
				"value" => array(
					"" => "",
					"Rounded edges" => "rounded",
					"Sharp edges" => "sharp"	
				),
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Width", 'wpdance'),
				"param_name" => "width",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Height", 'wpdance'),
				"param_name" => "height",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Custom Color", 'wpdance'),
				"param_name" => "custom_color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Scale steps", 'wpdance'),
				"param_name" => "scalesteps",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Scale step width", 'wpdance'),
				"param_name" => "scalestepwidth",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Labels", 'wpdance'),
				"param_name" => "labels",
				"value" => __("Label 1 | Label 2 | Label 3", 'wpdance')
			),
			array(
				"type" => "exploded_textarea",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content", 'wpdance'),
				"param_name" => "graph",
				"value" => "#eb005d|Legend One|1|5|10 \n #80c5d2|Legend Two|3|7|20 \n #f07d6f|Legend Three|10|2|34",
				"description" => "Input graph values here. Divide values with linebreaks (Enter). Example: #eb005d|Legend One|1|5|10"
			)
		)
) );


// **********************************************************************// 
// ! Register New Element: Our Project
// **********************************************************************//
$our_project_params = array(
	'name' => 'Our Project',
	'base' => 'wd_our_project',
	'icon' => 'icon-wpb-wpdance',
	'category' => 'by WPDance',
	'params' => array(
		array(
		  'type' => 'textfield',
		  "heading" => __("Project name", 'wpdance'),
		  "param_name" => "name"
		),
		array(
		  'type' => 'attach_image',
		  "heading" => __("Image", 'wpdance'),
		  "param_name" => "img"
		),
		array(
		  "type" => "textfield",
		  "heading" => __("Image size", 'wpdance'),
		  "param_name" => "img_size",
		  "description" => __("Enter image size. Example: 'thumbnail', 'medium', 'large', 'full' or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", 'wpdance')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Link URL", 'wpdance'),
			"param_name" => "link",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Open link in", 'wpdance'),
			"param_name" => "target_blank",
			"value" => array(
				"Same window" => "false",
				"New window" => "true"
			),
			"description" => ""
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"heading" => __("Project information", 'wpdance'),
			"param_name" => "content",
			"value" => __("Project description", 'wpdance')
		),
		array(
			"type" => "dropdown",
			"heading" => __("Display Type", 'wpdance'),
			"param_name" => "type",
			"value" => array( 
				"", 
				__("Vertical", 'wpdance') => 1,
				__("Horizontal", 'wpdance') => 2
			)
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'wpdance'),
			"param_name" => "class",
			"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpdance')
		)
	)
);  
vc_map($our_project_params);


// **********************************************************************// 
// ! Register New Element: Pie Chart 2 (Pie)
// **********************************************************************//
vc_map( array(
		"name" => __("Pie Chart 2 (Pie)", 'wpdance'),
		"base" => "wd_pie_chart2",
		"icon" => "icon-wpb-wpdance",
		"category" => 'by WPDance',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Width", 'wpdance'),
				"param_name" => "width",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Height", 'wpdance'),
				"param_name" => "height",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Legend Text Color", 'wpdance'),
				"param_name" => "color",
				"description" => ""
			),
			array(
				"type" => "exploded_textarea",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content", 'wpdance'),
				"param_name" => "pie",
				"value" => "15|#eb005d|Legend One \n 35|#80c5d2|Legend Two \n 50|#f07d6f|Legend Three",
				"description" => "Input pie values here. Divide values with linebreaks (Enter). Example: 15|#eb005d|Legend One"
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Align", 'wpdance'),
				"param_name" => "align",
				"value" => array(
					"" => "",
					"Left" => "left",
					"Center" => "center",
					"Right" => "right"
				)
			)
		)
) );



// **********************************************************************// 
// ! Register New Element: Pie Chart 3 (Doughnut)
// **********************************************************************//
vc_map( array(
		"name" => __("Pie Chart 3 (Doughnut)", 'wpdance'),
		"base" => "wd_pie_chart3",
		"category" => 'by WPDance',
		"icon" => "icon-wpb-wpdance",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Width", 'wpdance'),
				"param_name" => "width",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Height", 'wpdance'),
				"param_name" => "height",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Legend Text Color", 'wpdance'),
				"param_name" => "color",
				"description" => ""
			),
			array(
				"type" => "exploded_textarea",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content", 'wpdance'),
				"param_name" => "pie",
				"value" => "15|#eb005d|Legend One \n 35|#80c5d2|Legend Two \n 50|#f07d6f|Legend Three",
				"description" => "Input pie values here. Divide values with linebreaks (Enter). Example: 15|#eb005d|Legend One"
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Align", 'wpdance'),
				"param_name" => "align",
				"value" => array(
					"" => "",
					"Left" => "left",
					"Center" => "center",
					"Right" => "right"
				)
			)
		)
) );


// **********************************************************************// 
// ! Register New Element:Pricing Table
// **********************************************************************//
$ptable_params = array(
	"name" => __("Pricing Table", 'wpdance'),
	"base" => "wd_ptable",
	"icon" => "icon-wpb-wpdance",
	"category" => 'by WPDance',
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


// **********************************************************************// 
// ! Register New Element: Horizontal progress bar shortcode
// **********************************************************************//
vc_map( array(
		"name" => __("Progress Bar - Horizontal", 'wpdance'),
		"base" => "wd_progress_bar",
		"icon" => "icon-wpb-wpdance",
		"category" => 'by WPDance',
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title", 'wpdance'),
				"param_name" => "title",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title Color", 'wpdance'),
				"param_name" => "title_color",
				"description" => ""
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Title Tag", 'wpdance'),
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",	
					"h5" => "h5",	
					"h6" => "h6",	
				),
				"description" => ""
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Percentage", 'wpdance'),
				"param_name" => "percent",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Percentage Color", 'wpdance'),
				"param_name" => "percent_color",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Active Background Color", 'wpdance'),
				"param_name" => "active_background_color",
				"description" => ""
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("No active Background Color", 'wpdance'),
				"param_name" => "noactive_background_color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Progress Bar Height (px)", 'wpdance'),
				"param_name" => "height",
				"description" => ""
			)
		)
) );



// **********************************************************************// 
// ! Register New Element: Vertical progress bar shortcode
// **********************************************************************//
vc_map( array(
		"name" => __("Progress Bar - Vertical", 'wpdance'),
		"base" => "wd_progress_bar_vertical",
		"icon" => "icon-wpb-wpdance",
		"category" => 'by WPDance',
		"allowed_container_element" => 'vc_row',
		"params" => array(
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title", 'wpdance'),
				"param_name" => "title",
				"description" => ""
			),
            array (
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title Color", 'wpdance'),
				"param_name" => "title_color",
				"description" => ""
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Title Tag", 'wpdance'),
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					"h2" => "h2",
					"h3" => "h3",
					"h4" => "h4",	
					"h5" => "h5",	
					"h6" => "h6",	
				),
				"description" => ""
            ),
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title Size", 'wpdance'),
				"param_name" => "title_size",
				"description" => ""
			),
			array (
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Active Background Color", 'wpdance'),
				"param_name" => "active_background_color",
				"description" => ""
			),
			array (
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("No active Background Color", 'wpdance'),
				"param_name" => "noactive_background_color",
				"description" => ""
			),
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Percent", 'wpdance'),
				"param_name" => "percent",
				"description" => ""
			),
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Percentage Text Size", 'wpdance'),
				"param_name" => "percentage_text_size",
				"description" => ""
			),
            array (
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => __("Percentage Color", 'wpdance'),
				"param_name" => "percentage_color",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Progress Bar Width", 'wpdance'),
				"param_name" => "width",
				"description" => ""
			),
            array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => __("Text", 'wpdance'),
				"param_name" => "text",
				"value" => "",
				"description" => "Put some content here"
			)
		)
) );

// **********************************************************************// 
// ! Register New Element: Quote
// **********************************************************************//
$quote_params = array(
	"name" => __("Quote", 'wpdance'),
	"base" => "quote",
	"icon" => "icon-wpb-wpdance",
	"category" => 'by WPDance',
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Extra Class", 'wpdance'),
			"param_name" => "class",
			"value" => "",
			"description" => ""
		),		
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'wpdance'),
			"param_name" => "content",
			"value" => "content content content",
			"description" => ""
		)
	)
);
vc_map( $quote_params );

// **********************************************************************// 
// ! Register New Element: Recent Blog Slider Shortcode
// **********************************************************************//
vc_map( array(
		"name" => __("Recent Blog", 'wpdance'),
		"base" => "wd_recent_blog",
		"category" => 'by WPDance',
		"icon" => "icon-wpb-wpdance",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"heading" => __("Widget title", 'wpdance'),
				"param_name" => "title"
			),
			array(
				"type" => "textfield",
				"heading" => __("Limit", 'wpdance'),
				"param_name" => "limit",
				"description" => __('How many posts to show? Enter number.', 'wpdance')
			),
			array(
				"type" => "dropdown",
				"heading" => __("Display type", 'wpdance'),
				"param_name" => "type",
				"value" => array( 
				  "", 
				  __("Slider", 'wpdance') => 'slider',
				  __("Grid", 'wpdance') => 'grid'
				)
			),
			array(
				"type" => "dropdown",
				"heading" => __("Auto play", 'wpdance'),
				"param_name" => "autoslide",
				"value" => array( 
				  "", 
				  __("Yes", 'wpdance') => '1',
				  __("No", 'wpdance') => '0'
				),
				"dependency" => Array('element' => "type", 'value' => array('slider'))
			),
			array(
				"type" => "textfield",
				"heading" => __("Interval", 'wpdance'),
				"param_name" => "interval",
				"description" => __('Interval between slides. In milliseconds. Default: 10000', 'wpdance'),
				"dependency" => Array('element' => "autoslide", 'value' => array('1'))
			),
			array(
				"type" => "dropdown",
				"heading" => __("Show Control Navigation", 'wpdance'),
				"param_name" => "navigation",
				"dependency" => Array('element' => "type", 'value' => array('slider')),
				"value" => array( 
				  "", 
				  __("Hide", 'wpdance') => false,
				  __("Show", 'wpdance') => true
				)
			),
			array(
				"type" => "wd_taxonomy",
				"taxonomy" => "category",
				"class" => "",
				"heading" => __("Category", 'wpdance'),
				"admin_label" => true,
				"param_name" => "category",
				"value" => "",
				"description" => __('Display testimonials from category.', 'wpdance')
			),
			array(
				"type" => "textfield",
				"heading" => __("Introtext word limit", 'wpdance'),
				"param_name" => "word_limit"
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'wpdance'),
				"param_name" => "class",
				"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpdance')
			)			
		)
) );


// **********************************************************************// 
// ! Register New Element: Single product
// **********************************************************************//
$product_params = array(
  'name' => 'Single product',
  'base' => 'wd_single_post',
  'icon' => 'icon-wpb-wpdance',
  'category' => 'by WPDance',
  'params' => array(
	array(
	  "type" => "textfield",
	  "heading" => __("Title", 'wpdance'),
	  "param_name" => "title"
	),
	array(
	  "type" => "textfield",
	  "heading" => __("Product ID", 'wpdance'),
	  "param_name" => "id"
	),
	array(
	  "type" => "textfield",
	  "heading" => __("Product SKU", 'wpdance'),
	  "param_name" => "sku"
	),
	array(
	  "type" => "textfield",
	  "heading" => __("Extra class name", 'wpdance'),
	  "param_name" => "class",
	  "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpdance')
	)
  )

);  
vc_map($product_params);



// **********************************************************************// 
// ! Register New Element: SoundCloud
// **********************************************************************//
$audio_params = array(
	"name" => __("SoundCloud", 'wpdance'),
	"base" => "wd_soundcloud",
	"icon" => "icon-wpb-wpdance",
	"category" => 'by WPDance',
	"allowed_container_element" => 'vc_row',
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'wpdance'),
			"param_name" => "title",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("URL", 'wpdance'),
			"param_name" => "url",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Width", 'wpdance'),
			"param_name" => "width",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Height", 'wpdance'),
			"param_name" => "height",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Comments", 'wpdance'),
			"param_name" => "comments",
			"value" => array(
				"No" => "false",
				"Yes" => "true"	
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Auto play", 'wpdance'),
			"param_name" => "auto_play",
			"value" => array(
				"No" => "false",
				"Yes" => "true"	
			),
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Color", 'wpdance'),
			"param_name" => "color",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'wpdance'),
			"param_name" => "class",
			"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpdance')
		)
	)
);
vc_map($audio_params);


// **********************************************************************// 
// ! Register New Element: Static Blocks
// **********************************************************************//
$staticblocks_params = array(
	'name' => 'Static Blocks',
	'base' => 'wd_staticblocks',
	'icon' => 'icon-wpb-wpdance',
	'category' => 'by WPDance',
	'params' => array(
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Color", 'wpdance'),
			"param_name" => "color"
		),
		array(
			"type" => "textfield",
			"heading" => __("Limit", 'wpdance'),
			"param_name" => "limit",
			"description" => __('How many testimonials to show? Enter number.', 'wpdance')
		),
		array(
			"type" => "dropdown",
			"heading" => __("Display type", 'wpdance'),
			"param_name" => "type",
			"value" => array( 
			  "", 
			  __("Slider", 'wpdance') => 'slider',
			  __("Grid", 'wpdance') => 'grid'
			)
		),
		array(
			"type" => "dropdown",
			"heading" => __("Auto play", 'wpdance'),
			"param_name" => "autoslide",
			"value" => array( 
			  "", 
			  __("Yes", 'wpdance') => '1',
			  __("No", 'wpdance') => '0'
			),
			"dependency" => Array('element' => "type", 'value' => array('slider'))
		),
		array(
			"type" => "textfield",
			"heading" => __("Interval", 'wpdance'),
			"param_name" => "interval",
			"description" => __('Interval between slides. In milliseconds. Default: 10000', 'wpdance'),
			"dependency" => Array('element' => "autoslide", 'value' => array('1'))
		),
		array(
			"type" => "dropdown",
			"heading" => __("Show Control Navigation", 'wpdance'),
			"param_name" => "navigation",
			"dependency" => Array('element' => "type", 'value' => array('slider')),
			"value" => array( 
			  "", 
			  __("Hide", 'wpdance') => false,
			  __("Show", 'wpdance') => true
			)
		),
		array(
			"type" => "wd_taxonomy",
			"taxonomy" => "wd_staticblocks_category",
			"class" => "",
			"heading" => __("Category", 'wpdance'),
			"admin_label" => true,
			"param_name" => "category",
			"value" => "",
			"description" => __('Display testimonials from category.', 'wpdance')
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'wpdance'),
			"param_name" => "class",
			"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpdance')
		)
	)

);  
vc_map($staticblocks_params);



// ! Team
vc_map( array(
	"name" => __("Team", 'wpdance'),
	"base" => "wd_team",
	"icon" => "icon-wpb-wpdance",
	"category" => 'by WPDance',
	"params" => array(

		// Terms
		array(
			"type" => "wd_taxonomy",
			"taxonomy" => "wd_team_category",
			"class" => "",
			"heading" => __("Categories", 'wpdance'),
			"admin_label" => true,
			"param_name" => "category"
		),

		// Appearance
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Appearance", 'wpdance'),
			"param_name" => "type",
			"value" => array(
				"Masonry" => "masonry",
				"Grid" => "grid"
			),
			"description" => ""
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between team members (px)", 'wpdance'),
			"description" => __("Team member paddings (e.g. 5 pixel padding will give you 10 pixel gaps between team members)", 'wpdance'),
			"param_name" => "padding",
			"value" => "20"
		),

		// Column width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column target width (px)", 'wpdance'),
			"param_name" => "column_width",
			"value" => "370"
		),

		// 100% width
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("100% width", 'wpdance'),
			"param_name" => "full_width",
			"value" => array(
				"" => "true",
			)
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of team members to show", 'wpdance'),
			"param_name" => "number",
			"value" => "12",
			"description" => __("(Integer)", 'wpdance')
		),

		// Order by
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", 'wpdance'),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", 'wpdance')
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
		)
	)
) );



// **********************************************************************// 
// ! Register New Element: Testimonials
// **********************************************************************//
$testimonials_params = array(
	'name' => 'Testimonials',
	'base' => 'testimonials',
	'icon' => 'icon-wpb-wpdance',
	'category' => 'by WPDance',
	'params' => array(
		array(
			"type" => "textfield",
			"heading" => __("Widget title", 'wpdance'),
			"param_name" => "heading",
			"description" => __("Blank if you don't want to display", 'wpdance')
		),
		array(
			"type" => "textfield",
			"heading" => __("Limit", 'wpdance'),
			"param_name" => "limit",
			"description" => __('How many testimonials to show? Enter number.', 'wpdance')
		),
		array(
			"type" => "dropdown",
			"heading" => __("Display type", 'wpdance'),
			"param_name" => "type",
			"value" => array( 
			  "", 
			  __("Slider", 'wpdance') => 'slider',
			  __("Grid", 'wpdance') => 'grid'
			)
		),
		array(
			"type" => "textfield",
			"heading" => __("Interval", 'wpdance'),
			"param_name" => "interval",
			"description" => __('Interval between slides. In milliseconds. Default: 10000', 'wpdance'),
			"dependency" => Array('element' => "type", 'value' => array('slider'))
		),
		array(
			"type" => "dropdown",
			"heading" => __("Show Control Navigation", 'wpdance'),
			"param_name" => "navigation",
			"dependency" => Array('element' => "type", 'value' => array('slider')),
			"value" => array( 
			  "", 
			  __("Hide", 'wpdance') => 0,
			  __("Show - Center", 'wpdance') => 1,
			  __("Show - Top", 'wpdance') => 2
			)
		),
		array(
			"type" => "dropdown",
			"heading" => __("Image type", 'wpdance'),
			"param_name" => "image",
			"value" => array(
				"Default" => "",
				"Circle" => "circle",
				"Rounded" => "rounded"
			),
			"description" => ""
		),
		array(
			"type" => "wd_taxonomy",
			"taxonomy" => "testimonial-category",
			"class" => "",
			"heading" => __("Category", 'wpdance'),
			"admin_label" => true,
			"param_name" => "category",
			"value" => "",
			"description" => __('Display testimonials from category.', 'wpdance')
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'wpdance'),
			"param_name" => "class",
			"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpdance')
		)
	)

);
vc_map($testimonials_params);



if(function_exists("is_woocommerce", 'wpdance')){

	// **********************************************************************// 
	// ! Register New Element: WooCommerce Products
	// **********************************************************************//

	$woo_products_params = array(
		"name" => __("WooCommerce Products", 'wpdance'),
		"base" => "wd_woo_products",
		"icon" => "icon-wpb-wpdance",
		"category" => 'by WPDance',
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Widget title", 'wpdance'),
				"param_name" => "title",
				"value" => "",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number", 'wpdance'),
				"param_name" => "number",
				"value" => "5",
				"description" => "Number of products to show"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show", 'wpdance'),
				"param_name" => "show",
				"value" => array(
					"All Products" => "",
					"Featured Products" => "featured",
					"On-sale Products" => "onsale"	
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order by", 'wpdance'),
				"param_name" => "orderby",
				"value" => array(
					"Date" => "date",
					"Price" => "price",
					"Random" => "random",
					"Sales" => "sales"	
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Sorting order", 'wpdance'),
				"param_name" => "order",
				"value" => array(
					"DESC" => "desc",
					"ASC" => "asc"
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hide free products", 'wpdance'),
				"param_name" => "hide_free",
				"value" => array(
					"No" => "0",
					"Yes" => "1"
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show hidden products", 'wpdance'),
				"param_name" => "show_hidden",
				"value" => array(
					"No" => "0",
					"Yes" => "1"
				)
			)
		)
	);

	vc_map( $woo_products_params );




}

// **********************************************************************// 
// ! Register New Element: WD Product Category
// **********************************************************************//
$product_category_params = array(
	"name" => __("WD Product Category", 'wpdance'),
	"base" => "custom_products_category",
	"icon" => "icon-wpb-wpdance",
	"category" => 'WPDance Slider',
	"params" => array(
	
		// Text
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Number", 'wpdance'),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "",
			"description" => ""
		),
		
		// Link Category Slug
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Category Slug", 'wpdance'),
			"param_name" => "category",
			"value" => "",
			"description" => ""
		),
		
		// add orderby dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order By", 'wpdance'),
			"admin_label" => true,
			"param_name" => "orderby",
			"value" => array(
				"Title" => "title",
				"Date" => "date",
				"Price" => "price",
				"Popularity" => "popularity",
				"Rating" => "rating",
				"Rand" => "rand"
			),
			"description" => ""
		),
		
		// add order dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order", 'wpdance'),
			"admin_label" => true,
			"param_name" => "order",
			"value" => array(
				"Desc" => "desc",
				"Asc" => "asc"	
			),
			"description" => ""
		),

		// add image dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Image", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add title dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Title", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Sku dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_sku",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Price dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Price", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Rating dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Rating", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_rating",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Label dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Label", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_label",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Categories of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_categories",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show all categories of each product", 'wpdance')
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Short Content of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_short_content",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show short content of each product", 'wpdance')
		),
	)
);
vc_map( $product_category_params );


// **********************************************************************// 
// ! Register New Element: WD Product Category Grid Style
// **********************************************************************//
$product_category_style2_params = array(
	"name" => __("WD Product Category Grid Style", 'wpdance'),
	"base" => "custom_products_category_grid_image",
	"icon" => "icon-wpb-wpdance",
	"category" => 'WPDance Slider',
	"params" => array(
			
		// Image Url
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Image Url", 'wpdance'),
			"admin_label" => true,
			"param_name" => "image_url",
			"value" => "",
			"description" => __("image url of big image on the left shortcode layout", 'wpdance')
		),
		
		// add Color dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Color", 'wpdance'),
			"admin_label" => true,
			"param_name" => "color",
			"value" => array(
				"black" => "black",
				"blue" => "blue",
				"green" => "green",
				"indigo" => "indigo",
				"orange" => "orange",
				"pink" => "pink",
				"red" => "red"
			),
			"description" => ""
		),
		
		// add orderby dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order By", 'wpdance'),
			"admin_label" => true,
			"param_name" => "orderby",
			"value" => array(
				"Title" => "title",
				"Date" => "date",
				"Price" => "price",
				"Rating" => "rating",
				"Popularity" => "popularity",
				"Rand" => "rand"
			),
			"description" => ""
		),
		
		// add order dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order", 'wpdance'),
			"admin_label" => true,
			"param_name" => "order",
			"value" => array(
				"Desc" => "desc",
				"Asc" => "asc"
			),
			"description" => ""
		),

		// Link Category Slug
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Category Slug", 'wpdance'),
			"param_name" => "category",
			"value" => "",
			"description" => ""
		),

		// add image dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Image", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add title dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Title", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Sku dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_sku",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Price dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Price", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Rating dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Rating", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_rating",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Label dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Label", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_label",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Categories of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_categories",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show all categories of each product", 'wpdance')
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Short Content of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_short_content",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show short content of each product", 'wpdance')
		),
	)
);
vc_map( $product_category_style2_params );

// **********************************************************************// 
// ! Register New Element: WD Product Category List Style
// **********************************************************************//
$product_category_list_params = array(
	"name" => __("WD Product Category List Style", 'wpdance'),
	"base" => "wd_product_category_list_slider",
	"icon" => "icon-wpb-wpdance",
	"category" => 'WPDance Slider',
	"params" => array(
	
		// Text
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Number", 'wpdance'),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "",
			"description" => ""
		),
		
		// add Color dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Color", 'wpdance'),
			"admin_label" => true,
			"param_name" => "color",
			"value" => array(
				"black" => "black",
				"blue" => "blue",
				"green" => "green",
				"indigo" => "indigo",
				"orange" => "orange",
				"pink" => "pink",
				"red" => "red"
			),
			"description" => ""
		),
		
		// Link Category Slug
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Category Slug", 'wpdance'),
			"param_name" => "category",
			"value" => "",
			"description" => ""
		),
		
		// add orderby dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order By", 'wpdance'),
			"admin_label" => true,
			"param_name" => "orderby",
			"value" => array(
				"Title" => "title",
				"Date" => "date",
				"Price" => "price",
				"Popularity" => "popularity",
				"Rating" => "rating",
				"Rand" => "rand"
			),
			"description" => ""
		),
		
		// add order dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order", 'wpdance'),
			"admin_label" => true,
			"param_name" => "order",
			"value" => array(
				"Desc" => "desc",
				"Asc" => "asc"
			),
			"description" => ""
		),

		// add image dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Image", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add title dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Title", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Sku dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_sku",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Price dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Price", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Rating dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Rating", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_rating",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Label dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Label", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_label",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Categories of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_categories",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show all categories of each product", 'wpdance')
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Short Content of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_short_content",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show short content of each product", 'wpdance')
		),
	)
);
vc_map( $product_category_list_params );

// **********************************************************************// 
// ! Register New Element: WD Popular Product Category
// **********************************************************************//
$product_popular_params = array(
	"name" => __("WD Popular Product by Category", 'wpdance'),
	"base" => "wd_popular_product",
	"icon" => "icon-wpb-wpdance",
	"category" => 'WPDance Slider',
	'description' => __( 'Show popular product of one category', 'wpdance' ),
	"params" => array(
	
		// Text
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "",
			"description" => __("product number show on slider", 'wpdance')
		),
		
		// Icon Url
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Icon Url", 'wpdance'),
			"admin_label" => true,
			"param_name" => "icon",
			"value" => "",
			"description" => __("icon url on the left category name", 'wpdance')
		),
		
		// add Color dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Color", 'wpdance'),
			"admin_label" => true,
			"param_name" => "color",
			"value" => array(
				"black" => "black",
				"blue" => "blue",
				"green" => "green",
				"indigo" => "indigo",
				"orange" => "orange",
				"pink" => "pink",
				"red" => "red"
			),
			"description" => ""
		),
		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Heading", 'wpdance'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => "",
			"description" => __("If it's empty,heading is title of category", 'wpdance')
		),
		
		// Link Category Slug
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Category Slug", 'wpdance'),
			"param_name" => "category",
			"value" => "",
			"description" => ""
		),
		
		// add orderby dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order By", 'wpdance'),
			"admin_label" => true,
			"param_name" => "orderby",
			"value" => array(
				"Title" => "title",
				"Date" => "date",
				"Price" => "price",
				"Popularity" => "popularity",
				"Rating" => "rating",
				"Rand" => "rand"
			),
			"description" => ""
		),
		
		// add order dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order", 'wpdance'),
			"admin_label" => true,
			"param_name" => "order",
			"value" => array(
				"Desc" => "desc",
				"Asc" => "asc"
			),
			"description" => ""
		),

		// add image dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Image", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add title dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Title", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Sku dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_sku",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Price dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Price", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Rating dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Rating", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_rating",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Label dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Label", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_label",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Categories of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_categories",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show all categories of each product", 'wpdance')
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Short Content of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_short_content",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show short content of each product", 'wpdance')
		),
		
		// add Related dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Related of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_related",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
	)
);
vc_map( $product_popular_params );


// **********************************************************************// 
// ! Register New Element: WD Feature Products
// **********************************************************************//
$feature_product_params = array(
	"name" => __("WD Feature Products", 'wpdance'),
	"base" => "featured_product_slider",
	"icon" => "icon-wpb-wpdance",
	"category" => 'WPDance Slider',
	"params" => array(
		
		// Columns
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "",
			"description" => __("product number visible on slider", 'wpdance')
		),
		
		// add Layout dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Layout", 'wpdance'),
			"admin_label" => true,
			"param_name" => "layout",
			"value" => array(
				"Small" => "small",
				"Big" => "big"
			),
			"description" => ""
		),
		
		// Per page
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Number", 'wpdance'),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "",
			"description" => __("product number in slider includes invisible products", 'wpdance')
		),
		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Heading", 'wpdance'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => "",
			"description" => ""
		),
		
		// desc
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Description", 'wpdance'),
			"admin_label" => true,
			"param_name" => "desc",
			"value" => "",
			"description" => ""
		),
		
		// product_tag
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Tags", 'wpdance'),
			"admin_label" => true,
			"param_name" => "product_tag",
			"value" => "",
			"description" => __("Get all products have this tag", 'wpdance')
		),
		
		// add nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add icon nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Icon Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_icon_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add image dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Image", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add title dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Title", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Sku dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_sku",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Price dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Price", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Rating dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Rating", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_rating",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Label dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Label", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_label",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Categories of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_categories",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show all categories of each product", 'wpdance')
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Short Content of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_short_content",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show short content of each product", 'wpdance')
		),
	)
);
vc_map( $feature_product_params );


// **********************************************************************// 
// ! Register New Element: WD Popular Products
// **********************************************************************//
$popular_product_params = array(
	"name" => __("WD Popular Products", 'wpdance'),
	"base" => "popular_product_slider",
	"icon" => "icon-wpb-wpdance",
	"category" => 'WPDance Slider',
	"params" => array(
		
		// Columns
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "",
			"description" => __("product number visible on slider", 'wpdance')
		),
		
		// add Layout dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Layout", 'wpdance'),
			"admin_label" => true,
			"param_name" => "layout",
			"value" => array(
				"Small" => "small",
				"Big" => "big"
			),
			"description" => ""
		),
		
		// Per page
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Number", 'wpdance'),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "",
			"description" => __("product number in slider includes invisible products", 'wpdance')
		),
		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Heading", 'wpdance'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => "",
			"description" => ""
		),
		
		// desc
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Description", 'wpdance'),
			"admin_label" => true,
			"param_name" => "desc",
			"value" => "",
			"description" => ""
		),
		
		// product_tag
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Tags", 'wpdance'),
			"admin_label" => true,
			"param_name" => "product_tag",
			"value" => "",
			"description" => __("Get all products have this tag", 'wpdance')
		),
		
		// add nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add icon nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Icon Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_icon_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add image dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Image", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add title dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Title", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Sku dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_sku",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Price dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Price", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Rating dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Rating", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_rating",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Label dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Label", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_label",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Categories of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_categories",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show all categories of each product", 'wpdance')
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Short Content of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_short_content",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show short content of each product", 'wpdance')
		),
	)
);
vc_map( $popular_product_params );

// **********************************************************************// 
// ! Register New Element: WD Recent Products
// **********************************************************************//
$popular_product_params = array(
	"name" => __("WD Recent Products", 'wpdance'),
	"base" => "recent_product_slider",
	"icon" => "icon-wpb-wpdance",
	"category" => 'WPDance Slider',
	"params" => array(
		
		// Columns
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "",
			"description" => __("product number visible on slider", 'wpdance')
		),
		
		// add Layout dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Layout", 'wpdance'),
			"admin_label" => true,
			"param_name" => "layout",
			"value" => array(
				"Small" => "small",
				"Big" => "big"
			),
			"description" => ""
		),
		
		// Per page
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Number", 'wpdance'),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "",
			"description" => __("product number in slider includes invisible products", 'wpdance')
		),
		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Heading", 'wpdance'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => "",
			"description" => ""
		),
		
		// desc
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Description", 'wpdance'),
			"admin_label" => true,
			"param_name" => "desc",
			"value" => "",
			"description" => ""
		),
		
		// product_tag
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Tags", 'wpdance'),
			"admin_label" => true,
			"param_name" => "product_tag",
			"value" => "",
			"description" => __("Get all products have this tag", 'wpdance')
		),
		
		// add nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add icon nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Icon Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_icon_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add image dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Image", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add title dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Title", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Sku dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_sku",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Price dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Price", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Rating dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Rating", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_rating",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Label dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Label", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_label",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Categories of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_categories",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show all categories of each product", 'wpdance')
		),
		
		// add Short content dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Short Content of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_short_content",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show short content of each product", 'wpdance')
		),
		
		// add Auto dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Auto Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "auto",
			"value" => array(
				"No" => "0",
				"Yes" => "1"
			),
			"description" => ""
		),
	)
);
vc_map( $popular_product_params );

// **********************************************************************// 
// ! Register New Element: WD Best Selling Products
// **********************************************************************//
$best_selling_product_params = array(
	"name" => __("WD Best Selling Products", 'wpdance'),
	"base" => "best_selling_product_slider",
	"icon" => "icon-wpb-wpdance",
	"category" => 'WPDance Slider',
	"description"	=> __('Show Top Sale Products', 'wpdance'),
	"params" => array(
		
		// Columns
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "",
			"description" => __("product number visible on slider", 'wpdance')
		),
		
		// add Layout dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Layout", 'wpdance'),
			"admin_label" => true,
			"param_name" => "layout",
			"value" => array(
				"Small" => "small",
				"Big" => "big"
			),
			"description" => ""
		),
		
		// Per page
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Number", 'wpdance'),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "",
			"description" => __("product number in slider includes invisible products", 'wpdance')
		),
		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Heading", 'wpdance'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => "",
			"description" => ""
		),
		
		// Show Heading
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Show Heading", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_heading_title",
			"value" => "",
			"description" => ""
		),
		
		// desc
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Description", 'wpdance'),
			"admin_label" => true,
			"param_name" => "desc",
			"value" => "",
			"description" => ""
		),
		
		// product_tag
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Tags", 'wpdance'),
			"admin_label" => true,
			"param_name" => "product_tag",
			"value" => "",
			"description" => __("Get all products have this tag", 'wpdance')
		),
		
		// add nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add icon nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Icon Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_icon_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add image dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Image", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add title dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Title", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Sku dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_sku",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Price dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Price", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Rating dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Rating", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_rating",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Label dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Label", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_label",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Categories of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_categories",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show all categories of each product", 'wpdance')
		),
		
		// add Short content dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Short Content of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_short_content",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show short content of each product", 'wpdance')
		),

	)
);
vc_map( $best_selling_product_params );

// **********************************************************************// 
// ! Register New Element: WD Best Selling By Category Products
// **********************************************************************//
$best_selling_product_by_category_params = array(
	"name" => __("WD Best Selling Products By Category", 'wpdance'),
	"base" => "best_selling_product_by_category_slider",
	"icon" => "icon-wpb-wpdance",
	"category" => 'WPDance Slider',
	"description"	=> __('Show Top Sale Products in the same category', 'wpdance'),
	"params" => array(
		
		// Columns
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "",
			"description" => __("product number visible on slider", 'wpdance')
		),
		
		// add Layout dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Layout", 'wpdance'),
			"admin_label" => true,
			"param_name" => "layout",
			"value" => array(
				"Small" => "small",
				"Big" => "big"
			),
			"description" => ""
		),
		
		// Per page
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Number", 'wpdance'),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "",
			"description" => __("product number in slider includes invisible products", 'wpdance')
		),
		
		// category
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Category Slug", 'wpdance'),
			"admin_label" => true,
			"param_name" => "cat_slug",
			"value" => "",
			"description" => ""
		),
		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Heading", 'wpdance'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => "",
			"description" => ""
		),
		
		// Show Heading
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Show Heading", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_heading_title",
			"value" => "",
			"description" => ""
		),
		
		// desc
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Description", 'wpdance'),
			"admin_label" => true,
			"param_name" => "desc",
			"value" => "",
			"description" => ""
		),
		
		// product_tag
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Tags", 'wpdance'),
			"admin_label" => true,
			"param_name" => "product_tag",
			"value" => "",
			"description" => __("Get all products have this tag", 'wpdance')
		),
		
		// add nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add icon nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Icon Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_icon_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add image dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Image", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add title dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Title", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Sku dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_sku",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Price dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Price", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Rating dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Rating", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_rating",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Label dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Label", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_label",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Categories of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_categories",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show all categories of each product", 'wpdance')
		),
		
		// add Short content dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Short Content of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_short_content",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show short content of each product", 'wpdance')
		),

	)
);
vc_map( $best_selling_product_by_category_params );

// **********************************************************************// 
// ! Register New Element: WD Recent Products By Category Products
// **********************************************************************//
$recent_product_by_category_params = array(
	"name" => __("WD Best Selling Products By Category", 'wpdance'),
	"base" => "recent_product_by_categories_slider",
	"icon" => "icon-wpb-wpdance",
	"category" => 'WPDance Slider',
	"description"	=> __('Show Recent products in the same category', 'wpdance'),
	"params" => array(
		
		// Columns
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "",
			"description" => __("product number visible on slider", 'wpdance')
		),
		
		// add Layout dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Layout", 'wpdance'),
			"admin_label" => true,
			"param_name" => "layout",
			"value" => array(
				"Small" => "small",
				"Big" => "big"
			),
			"description" => ""
		),
		
		// Per page
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Number", 'wpdance'),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "",
			"description" => __("product number in slider includes invisible products", 'wpdance')
		),
		
		// category
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Category Slug", 'wpdance'),
			"admin_label" => true,
			"param_name" => "cat_slug",
			"value" => "",
			"description" => ""
		),
		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Heading", 'wpdance'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => "",
			"description" => ""
		),
		
		// desc
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Description", 'wpdance'),
			"admin_label" => true,
			"param_name" => "desc",
			"value" => "",
			"description" => ""
		),
		
		// product_tag
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Tags", 'wpdance'),
			"admin_label" => true,
			"param_name" => "product_tag",
			"value" => "",
			"description" => __("Get all products have this tag", 'wpdance')
		),
		
		// add nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add icon nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Icon Nav Slider", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_icon_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add image dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Image", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add title dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Title", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Sku dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_sku",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Price dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Price", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Rating dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Rating", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_rating",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Label dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Label", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_label",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Categories dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Categories of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_categories",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show all categories of each product", 'wpdance')
		),
		
		// add Short content dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Short Content of Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_short_content",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => __("Show short content of each product", 'wpdance')
		),

	)
);
vc_map( $recent_product_by_category_params );
?>