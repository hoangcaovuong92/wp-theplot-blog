<?php
	global $VISUAL_COMPOSER_EXTENSIONS;
	
    $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name"                      => __( "TS Icon List Item", "ts_visual_composer_extend" ),
		"base"                      => "TS-VCSC-Icon-List",
		"icon" 	                    => "ts-composer-element-icon-icon-list",
		"class"                     => "",
		"category"                  => __( "VC Extensions", "ts_visual_composer_extend" ),
		"description"               => __("Place an icon list item", "ts_visual_composer_extend"),
		"js_view"     				=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorLivePreview == "true" ? "TS_VCSC_IconListItemViewCustom" : ""),
		"admin_enqueue_js"			=> "",
		"admin_enqueue_css"			=> "",
		"params"					=> array(
			// Icon Settings
			array(
				"type"              => "seperator",
				"param_name"        => "seperator_1",
				"seperator"			=> "Icon Settings",
			),
			array(
				'type' 				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorType,
				'heading' 			=> __( 'Select Icon', 'ts_visual_composer_extend' ),
				'param_name' 		=> 'icon',
				'value'				=> '',
				'source'			=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorValue,
				'settings' 			=> array(
					'emptyIcon' 			=> false,
					'type' 					=> 'extensions',
					'iconsPerPage' 			=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorPager,
					'source' 				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorSource,
				),
				"admin_label"       => true,
				"description"       => ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorVisualSelector == "true" ? __( "Select the icon to be used before the list item.", "ts_visual_composer_extend" ) : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorString),
			),	
			array(
				"type"				=> "colorpicker",
				"class"				=> "",
				"heading"			=> __( "Icon Color", "ts_visual_composer_extend" ),
				"param_name"		=> "color",
				"value"				=> "#7dbd21",
				"description"		=> __( "Select your icon color.", "ts_visual_composer_extend" ),
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Icon Size", "ts_visual_composer_extend" ),
				"param_name"        => "icon_size",
				"value"             => "12",
				"min"               => "0",
				"max"               => "100",
				"step"              => "1",
				"unit"              => 'px',
				"admin_label"       => true,
				"description"       => __( "Define the size for the icon.", "ts_visual_composer_extend" ),
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Icon Margin", "ts_visual_composer_extend" ),
				"param_name"        => "margin_right",
				"value"             => "10",
				"min"               => "0",
				"max"               => "100",
				"step"              => "1",
				"unit"              => 'px',
				"description"       => __( "Enter an additional side margin to increase space between icon and text.", "ts_visual_composer_extend" ),
			),
			array(
				"type"				=> "dropdown",
				"class"				=> "",
				"heading"			=> __( "Icon Position", "ts_visual_composer_extend" ),
				"param_name"		=> "position",
				"value"				=> array(
					__('Left', "ts_visual_composer_extend") 		=> 'left',
					__('Right', "ts_visual_composer_extend") 		=> 'right',
				),
				"description"		=> __( "Select where the icon should be placed in relation to the text.", "ts_visual_composer_extend" )
			),
			// Content Settings
			array(
				"type"              => "seperator",
				"param_name"        => "seperator_2",
				"seperator"			=> "Content Settings",
				"group" 			=> "Content + Link",
			),
			array(
				"type"				=> "textarea",
				"class"				=> "",
				"heading"			=> __( "Content", "ts_visual_composer_extend" ),
				"param_name"		=> "content",
				"value"				=> "Item List Item Text",
				"description"		=> __( "Enter the list item content here.", "ts_visual_composer_extend" ),
				"group" 			=> "Content + Link",
			),
			array(
				"type"				=> "colorpicker",
				"class"				=> "",
				"heading"			=> __( "Font Color", "ts_visual_composer_extend" ),
				"param_name"		=> "font_color",
				"value"				=> "#000000",
				"description"		=> __( "Select a custom font color for the list item.", "ts_visual_composer_extend" ),
				"group" 			=> "Content + Link",
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Font Size", "ts_visual_composer_extend" ),
				"param_name"        => "font_size",
				"value"             => "12",
				"min"               => "6",
				"max"               => "512",
				"step"              => "1",
				"unit"              => 'px',
				"admin_label"       => true,
				"description"       => __( "Define a font size for the content.", "ts_visual_composer_extend" ),
				"dependency"        => "",
				"group" 			=> "Content + Link",
			),
			array(
				"type"				=> "dropdown",
				"class"				=> "",
				"heading"			=> __( "Text Align", "ts_visual_composer_extend" ),
				"param_name"		=> "text_align",
				"value"				=> array(
					__('Left', "ts_visual_composer_extend") 		=> 'left',
					__('Center', "ts_visual_composer_extend")		=> 'center',
					__('Right', "ts_visual_composer_extend") 		=> 'right',
					__('Justify', "ts_visual_composer_extend") 		=> 'justify',
				),
				"description"		=> __( "Select your preferred text alignment.", "ts_visual_composer_extend" ),
				"group" 			=> "Content + Link",
			),
			// Icon Link Settings
			array(
				"type"              => "seperator",
				"param_name"        => "seperator_3",
				"seperator"			=> "Link Settings",
				"group" 			=> "Content + Link",
			),
			array(
				"type"              => "textfield",
				"heading"           => __( "Link", "ts_visual_composer_extend" ),
				"param_name"        => "link",
				"value"             => "",
				"description"       => __( "Enter the link to the page or file here (starting with http://).", "ts_visual_composer_extend" ),
				"group" 			=> "Content + Link",
			),
			array(
				"type"              => "dropdown",
				"heading"           => __( "Link Target", "ts_visual_composer_extend" ),
				"param_name"        => "link_target",
				"value"             => array(
					__( "Same Window", "ts_visual_composer_extend" )                    => "_parent",
					__( "New Window", "ts_visual_composer_extend" )                     => "_blank"
				),
				"description"       => __( "Select how the link should be opened.", "ts_visual_composer_extend" ),
				"dependency"        => array( 'element' => "link", 'not_empty' => true ),
				"group" 			=> "Content + Link",
			),
			// List Item Tooltip
			array(
				"type"              => "seperator",
				"param_name"        => "seperator_4",
				"seperator"			=> "Tooltip Settings",
				"group" 			=> "Tooltip",
			),
			array(
				"type"              => "switch_button",
				"heading"			=> __( "Use Advanced Tooltip", "ts_visual_composer_extend" ),
				"param_name"		=> "tooltip_css",
				"value"				=> "false",
				"description"		=> __( "Switch the toggle if you want to apply am advanced tooltip to the list item.", "ts_visual_composer_extend" ),
				"group" 			=> "Tooltip",
			),
			array(
				"type"				=> "textarea",
				"class"				=> "",
				"heading"			=> __( "Tooltip Content", "ts_visual_composer_extend" ),
				"param_name"		=> "tooltip_content",
				"value"				=> "",
				"description"		=> __( "Enter the tooltip content here (do not use quotation marks).", "ts_visual_composer_extend" ),
				"group" 			=> "Tooltip",
			),
			array(
				"type"				=> "dropdown",
				"class"				=> "",
				"heading"			=> __( "Tooltip Position", "ts_visual_composer_extend" ),
				"param_name"		=> "tooltip_position",
				"value"					=> array(
					__( "Top", "ts_visual_composer_extend" )                            => "ts-simptip-position-top",
					__( "Bottom", "ts_visual_composer_extend" )                         => "ts-simptip-position-bottom",
				),
				"description"		=> __( "Select the tooltip position in relation to the list item.", "ts_visual_composer_extend" ),
				"dependency"		=> array( 'element' => "tooltip_css", 'value' => 'true' ),
				"group" 			=> "Tooltip",
			),
			array(
				"type"				=> "dropdown",
				"class"				=> "",
				"heading"			=> __( "Tooltip Style", "ts_visual_composer_extend" ),
				"param_name"		=> "tooltip_style",
				"value"             => array(
					__( "Black", "ts_visual_composer_extend" )                          => "",
					__( "Gray", "ts_visual_composer_extend" )                           => "ts-simptip-style-gray",
					__( "Green", "ts_visual_composer_extend" )                          => "ts-simptip-style-green",
					__( "Blue", "ts_visual_composer_extend" )                           => "ts-simptip-style-blue",
					__( "Red", "ts_visual_composer_extend" )                            => "ts-simptip-style-red",
					__( "Orange", "ts_visual_composer_extend" )                         => "ts-simptip-style-orange",
					__( "Yellow", "ts_visual_composer_extend" )                         => "ts-simptip-style-yellow",
					__( "Purple", "ts_visual_composer_extend" )                         => "ts-simptip-style-purple",
					__( "Pink", "ts_visual_composer_extend" )                           => "ts-simptip-style-pink",
					__( "White", "ts_visual_composer_extend" )                          => "ts-simptip-style-white"
				),
				"description"		=> __( "Select the tooltip style.", "ts_visual_composer_extend" ),
				"dependency"		=> array( 'element' => "tooltip_css", 'value' => 'true' ),
				"group" 			=> "Tooltip",
			),
			// List Item Animations
			array(
				"type"              => "seperator",
				"param_name"        => "seperator_5",
				"seperator"			=> "Animations",
				"group" 			=> "Animations",
			),
			array(
				"type"              => "dropdown",
				"heading"           => __( "Icon Animation Style", "ts_visual_composer_extend" ),
				"param_name"        => "animation_effect",
				"width"             => 150,
				"value"             => array(
					__( "Hover Only Effect", "ts_visual_composer_extend" )    			=> "hover",
					__( "Infinite (Looping) Effect", "ts_visual_composer_extend" )		=> "infinite",
				),
				"description"       => __( "Select the animation style for the icon / image.", "ts_visual_composer_extend" ),
				"group" 			=> "Animations",
			),
			array(
				"type"				=> "css3animations",
				"class"				=> "",
				"heading"			=> __("Icon Animation", "ts_visual_composer_extend"),
				"param_name"		=> "animation_class",
				"standard"			=> "false",
				"prefix"			=> "",
				"connector"			=> "css3animations_in",
				"noneselect"		=> "true",
				"default"			=> "",
				"value"				=> "",
				"admin_label"		=> false,
				"description"		=> __("Select the animation for the icon.", "ts_visual_composer_extend"),
				"group" 			=> "Animations",
			),
			array(
				"type"				=> "hidden_input",
				"heading"			=> __( "Icon Animation", "ts_visual_composer_extend" ),
				"param_name"		=> "css3animations_in",
				"value"				=> "",
				"admin_label"		=> true,
				"description"		=> "",
				"group" 			=> "Animations",
			),
			array(
				"type"				=> "css3animations",
				"class"				=> "",
				"heading"			=> __("Viewport Animation", "ts_visual_composer_extend"),
				"param_name"		=> "animation_view",
				"standard"			=> "false",
				"prefix"			=> "ts-viewport-css-",
				"connector"			=> "css3animations_view",
				"noneselect"		=> "true",
				"default"			=> "",
				"value"				=> "",
				"admin_label"		=> false,
				"description"		=> __("Select the viewport animation for the list item.", "ts_visual_composer_extend"),
				"group" 			=> "Animations",
			),
			array(
				"type"				=> "hidden_input",
				"heading"			=> __( "Viewport Animation", "ts_visual_composer_extend" ),
				"param_name"		=> "css3animations_view",
				"value"				=> "",
				"admin_label"		=> true,
				"description"		=> "",
				"group" 			=> "Animations",
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Animation Delay", "ts_visual_composer_extend" ),
				"param_name"        => "animation_delay",
				"value"             => "0",
				"min"               => "0",
				"max"               => "5000",
				"step"              => "100",
				"unit"              => 'ms',
				"description"       => __( "Define an optional delay for the viewport animation.", "ts_visual_composer_extend" ),
				"dependency"        => array( 'element' => "animation_view", 'not_empty' => true ),
				"group" 			=> "Animations",
			),
			// Other Settings
			array(
				"type"              => "seperator",
				"param_name"        => "seperator_6",
				"seperator"			=> "Other Settings",
				"group" 			=> "Other Settings",
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Margin: Top", "ts_visual_composer_extend" ),
				"param_name"        => "margin_top",
				"value"             => "0",
				"min"               => "-50",
				"max"               => "200",
				"step"              => "1",
				"unit"              => 'px',
				"description"       => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
				"group" 			=> "Other Settings",
			),
			array(
				"type"              => "nouislider",
				"heading"           => __( "Margin: Bottom", "ts_visual_composer_extend" ),
				"param_name"        => "margin_bottom",
				"value"             => "10",
				"min"               => "-50",
				"max"               => "200",
				"step"              => "1",
				"unit"              => 'px',
				"description"       => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
				"group" 			=> "Other Settings",
			),
			array(
				"type"              => "textfield",
				"heading"           => __( "Define ID Name", "ts_visual_composer_extend" ),
				"param_name"        => "el_id",
				"value"             => "",
				"description"       => __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
				"group" 			=> "Other Settings",
			),
			array(
				"type"				=> "tag_editor",
				"heading"			=> __( "Extra Class Names", "ts_visual_composer_extend" ),
				"param_name"		=> "el_class",
				"value"				=> "",
				"description"		=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
				"group"				=> "Other Settings",
			),
		)
	);
	
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
		return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
	} else {			
		vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
	}
?>