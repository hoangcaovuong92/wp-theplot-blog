<?php
	global $VISUAL_COMPOSER_EXTENSIONS;
	
    $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name"                          => __( "TS Image Lightbox", "ts_visual_composer_extend" ),
		"base"                          => "TS-VCSC-Lightbox-Image",
		"icon" 	                        => "ts-composer-element-icon-lightbox-image",
		"class"                         => "ts_vcsc_main_lightbox_image",
		"category"                      => __( "VC Extensions", "ts_visual_composer_extend" ),
		"description"                   => __("Place an image in a lightbox element", "ts_visual_composer_extend"),
		"admin_enqueue_js"              => "",
		"admin_enqueue_css"             => "",
		"params"                        => array(
			// Single Image Content
			array(
				"type"                  => "seperator",
				"param_name"            => "seperator_1",
				"seperator"				=> "Lightbox Image",
			),				
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Image Shape", "ts_visual_composer_extend" ),
				"param_name"            => "content_shape",
				"width"                 => 150,
				"value"                 => array(
					__( 'Standard Shape Image', "ts_visual_composer_extend" )		=> "standard",
					__( 'Circle SVG Shape Image', "ts_visual_composer_extend" )		=> "circle",
					__( 'Losange Shape Image', "ts_visual_composer_extend" )		=> "losange",
					__( 'Diamond Shape Image', "ts_visual_composer_extend" )		=> "diamond",
					__( 'Hexagon Shape Image', "ts_visual_composer_extend" )		=> "hexagon",
					__( 'Octagon Shape Image', "ts_visual_composer_extend" )		=> "octagon",
				),
				"admin_label"           => true,
				"description"           => __( "Select which image shape should be used the lightbox image.", "ts_visual_composer_extend" ),
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Image Retrieval", "ts_visual_composer_extend" ),
				"param_name"            => "external_link_usage",
				"width"                 => 150,
				"value"                 => array(
					__( 'WordPress Media Library', "ts_visual_composer_extend" )			=> "false",
					__( 'Featured Image of this Page/Post', "ts_visual_composer_extend" )	=> "featured",
					__( 'External Image Path', "ts_visual_composer_extend" )				=> "true",
				),
				"admin_label"           => true,
				"description"           => __( "Select where the image for this element should be retrieved from.", "ts_visual_composer_extend" ),
				"dependency"            => "",
			),
			array(
				"type"                  => "attach_image",
				"holder" 				=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? "img" : ""),
				"heading"               => __( "Select Image", "ts_visual_composer_extend" ),
				"param_name"            => "content_image",
				"class"					=> "ts_vcsc_holder_image",
				"value"                 => "",
				"admin_label"           => ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorImagePreview == "true" ? false : true),
				"description"           => __( "Select the image for your preview and lightbox.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "external_link_usage", 'value' => 'false' ),
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Preview Image Source", "ts_visual_composer_extend" ),
				"param_name"            => "content_image_size",
				"width"                 => 150,
				"value"                 => array(
					__( 'Medium Size Image', "ts_visual_composer_extend" )			=> "medium",
					__( 'Thumbnail Size Image', "ts_visual_composer_extend" )		=> "thumbnail",
					__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
					__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
				),
				"admin_label"           => true,
				"description"           => __( "Select which image size based on WordPress settings should be used for the preview image.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "external_link_usage", 'value' => array('false', 'featured') ),
			),
			array(
				"type"              	=> "switch_button",
				"heading"			    => __( "Use Different Image for Lightbox", "ts_visual_composer_extend" ),
				"param_name"		    => "lightbox_alternative",
				"value"				    => "false",
				"description"		    => __( "Switch the toggle if you want to show a different image in the lightbox.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "external_link_usage", 'value' => 'false' ),
			),
			array(
				"type"                  => "attach_image",
				"holder" 				=> "",
				"heading"               => __( "Select Image", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_image",
				"class"					=> "ts_vcsc_holder_image",
				"value"                 => "",
				"admin_label"           => true,
				"description"           => __( "Select the image for your lightbox.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_alternative", 'value' => 'true' ),
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Lightbox Image Source", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_size",
				"width"                 => 150,
				"value"                 => array(
					__( 'Full Size Image', "ts_visual_composer_extend" )			=> "full",
					__( 'Large Size Image', "ts_visual_composer_extend" )			=> "large",
					__( 'Medium Size Image', "ts_visual_composer_extend" )			=> "medium",
				),
				"admin_label"           => true,
				"description"           => __( "Select which image size based on WordPress settings should be used for the lightbox image.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "external_link_usage", 'value' => array('false', 'featured') ),
			),				
			array(
				"type"                  => "textfield",
				"heading"               => __( "Image Path - Lightbox", "ts_visual_composer_extend" ),
				"param_name"            => "external_link_lightbox",
				"value"                 => "",
				"description"           => __( "Enter the full path to the external image version that is to be shown inside the lightbox.", "ts_visual_composer_extend" ),
				"admin_label"           => true,
				"dependency"            => array( 'element' => "external_link_usage", 'value' => 'true' ),
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "Image Path - Preview", "ts_visual_composer_extend" ),
				"param_name"            => "external_link_preview",
				"value"                 => "",
				"description"           => __( "Enter the full path to the external image version that is to be used as preview image on the page.", "ts_visual_composer_extend" ),
				"admin_label"           => true,
				"dependency"            => array( 'element' => "external_link_usage", 'value' => 'true' ),
			),
			array(
				"type"              	=> "switch_button",
				"heading"			    => __( "Add Custom ALT Attribute", "ts_visual_composer_extend" ),
				"param_name"		    => "attribute_alt",
				"value"				    => "false",
				"description"		    => __( "Switch the toggle if you want add a custom ALT attribute value, otherwise WordPress ALT data or file name will be set.", "ts_visual_composer_extend" ),
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "Enter ALT Attribute", "ts_visual_composer_extend" ),
				"param_name"            => "attribute_alt_value",
				"value"                 => "",
				"description"           => __( "Enter a custom value for the ALT attribute for this image.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "attribute_alt", 'value' => 'true' )
			),
			array(
				"type"              	=> "switch_button",
				"heading"			    => __( "Responsive Image", "ts_visual_composer_extend" ),
				"param_name"		    => "content_image_responsive",
				"value"				    => "true",
				"description"		    => __( "Switch the toggle if you want to use a responsive image size.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_shape", 'value' => 'standard' ),
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Auto Height Setting", "ts_visual_composer_extend" ),
				"param_name"            => "content_image_height",
				"width"                 => 150,
				"value"                 => array(
					__( '100% Height Setting', "ts_visual_composer_extend" )		=> "height: 100%;",
					__( 'Auto Height Setting', "ts_visual_composer_extend" )     	=> "height: auto;",
				),
				"description"           => __( "Select what CSS height setting should be applied to the image (change only if image height does not display correctly).", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_shape", 'value' => 'standard' ),
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Image Width", "ts_visual_composer_extend" ),
				"param_name"            => "content_image_width_r",
				"value"                 => "100",
				"min"                   => "1",
				"max"                   => "100",
				"step"                  => "1",
				"unit"                  => '%',
				"description"           => __( "Define the image width in percent (%).", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_image_responsive", 'value' => 'true' )
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Image Width", "ts_visual_composer_extend" ),
				"param_name"            => "content_image_width_f",
				"value"                 => "300",
				"min"                   => "1",
				"max"                   => "1980",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Define the image width in pixel (px).", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_image_responsive", 'value' => 'false' )
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Image Alignment", "ts_visual_composer_extend" ),
				"param_name"            => "content_align",
				"width"                 => 150,
				"value"                 => array(
					__( 'Center', "ts_visual_composer_extend" )						=> "center",
					__( 'Left', "ts_visual_composer_extend" )						=> "left",
					__( 'Right', "ts_visual_composer_extend" )						=> "right",
				),
				"admin_label"           => true,
				"description"           => __( "Select how the image should be aligned inside the column.", "ts_visual_composer_extend" ),
				"dependency"            => "",
			),
			// Overlay Settings
			array(
				"type"                  => "seperator",
				"param_name"            => "seperator_2",
				"seperator"             => "Overlay Settings",
				"dependency"        	=> array( 'element' => "content_shape", 'value' => 'standard' ),				
				"group" 				=> "Overlay Settings",
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Overlay Title Source", "ts_visual_composer_extend" ),
				"param_name"            => "content_overlay",
				"width"                 => 150,
				"value"                 => array(
					__( 'Custom Image Title', "ts_visual_composer_extend" )			=> "custom",
					__( 'WP Media ALT Tag', "ts_visual_composer_extend" )			=> "alt",
					__( 'WP Media Title', "ts_visual_composer_extend" )				=> "title",
					__( 'WP Media Caption', "ts_visual_composer_extend" )			=> "caption",
					__( 'WP Media Description', "ts_visual_composer_extend" )		=> "content",
				),
				"description"           => __( "Select which source should be used for the image title(s) shown in the (preview image) overlay(s).", "ts_visual_composer_extend" ),
				"group" 				=> "Overlay Settings",
			),		
			array(
				"type"                  => "textfield",
				"heading"               => __( "Overlay Title", "ts_visual_composer_extend" ),
				"param_name"            => "content_title",
				"value"                 => "",
				"description"           => __( "Enter a title for the lightbox image; will be used as overlay for standard image shape (and optionally for lightbox).", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "content_overlay", 'value' => 'custom' ),
				"group" 				=> "Overlay Settings",
			),
			array(
				"type"              	=> "colorpicker",
				"heading"           	=> __( "Overlay: Background Color", "ts_visual_composer_extend" ),
				"param_name"        	=> "overlay_background",
				"value"             	=> "rgba(24, 24, 24, 0.3)",
				"description"       	=> __( "Select the background color and opacity for the overlay.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "content_shape", 'value' => 'standard' ),	
				"edit_field_class"		=> "vc_col-sm-6 vc_column",
				"group" 				=> "Overlay Settings"
			),			
			array(
				"type"              	=> "dropdown",
				"heading"           	=> __( "Overlay: Animation", "ts_visual_composer_extend" ),
				"param_name"        	=> "overlay_animation",
				"width"             	=> 300,
				"value"             	=> array(
					__( "Zoom Effect", "ts_visual_composer_extend" )				=> "zoom",
					__( "Zoom + Rotate Effect", "ts_visual_composer_extend" )		=> "rotate",
					__( "No Effect", "ts_visual_composer_extend" )					=> "none",
				),
				"description"       	=> __( "Select if and what type of animation should be applied to the image on hover.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "content_shape", 'value' => 'standard' ),
				"edit_field_class"		=> "vc_col-sm-6 vc_column",					
				"group" 				=> "Overlay Settings"
			),			
			array(
				"type"              	=> "dropdown",
				"heading"           	=> __( "Overlay: Decoration", "ts_visual_composer_extend" ),
				"param_name"        	=> "overlay_decoration",
				"width"             	=> 300,
				"value"             	=> array(
					__( "Default Image", "ts_visual_composer_extend" )				=> "default",
					__( "Custom Internal Image", "ts_visual_composer_extend" )		=> "image",
					__( "Custom External Image", "ts_visual_composer_extend" )		=> "external",
					__( "Font Icon", "ts_visual_composer_extend" )					=> "icon",
					__( "No Decoration", "ts_visual_composer_extend" )				=> "none",
				),
				"description"       	=> __( "Select if and how the overlay should be decorated.", "ts_visual_composer_extend" ),
				"edit_field_class"		=> "vc_col-sm-6 vc_column",
				"dependency"        	=> array( 'element' => "content_shape", 'value' => 'standard' ),	
				"group" 				=> "Overlay Settings",
			),
			array(
				"type"              	=> "dropdown",
				"heading"           	=> __( "Overlay: Visibility", "ts_visual_composer_extend" ),
				"param_name"        	=> "overlay_visibility",
				"width"             	=> 300,
				"value"             	=> array(
					__( "Show Only On Hover", "ts_visual_composer_extend" )			=> "hover",
					__( "Always Show Decoration", "ts_visual_composer_extend" )		=> "only_deco",
					__( "Always Show Title", "ts_visual_composer_extend" )			=> "only_title",
					__( "Always Show Full Overlay", "ts_visual_composer_extend" )	=> "always",
				),
				"admin_label"           => true,
				"description"       	=> __( "Select if and when the overlay should be visible.", "ts_visual_composer_extend" ),
				"edit_field_class"		=> "vc_col-sm-6 vc_column",
				"dependency"        	=> array( 'element' => "content_shape", 'value' => 'standard' ),	
				"group" 				=> "Overlay Settings",
			),			
			array(
				"type"              	=> "attach_image",
				"heading"           	=> __( "Overlay: Decoration Image", "ts_visual_composer_extend" ),
				"param_name"        	=> "overlay_image",
				"value"             	=> "",
				"description"       	=> __( "Select an image to be used as decoration for the overlay.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "overlay_decoration", 'value' => 'image' ),
				"group" 				=> "Overlay Settings",
			),	
			array(
				"type"              	=> "textfield",
				"heading"           	=> __( "Overlay: Decoration Image", "ts_visual_composer_extend" ),
				"param_name"        	=> "overlay_external",
				"value"             	=> "",
				"description"       	=> __( "Enter the full path to the image to be used as decoration for the overlay.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "overlay_decoration", 'value' => 'external' ),
				"group" 				=> "Overlay Settings",
			),
			array(
				'type' 					=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorType,
				'heading' 				=> __( 'Overlay: Decoration Icon', 'ts_visual_composer_extend' ),
				'param_name' 			=> 'overlay_icon_name',
				'value'					=> '',
				'source'				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorValue,
				'settings' 				=> array(
					'emptyIcon' 				=> false,
					'type' 						=> 'extensions',
					'iconsPerPage' 				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorPager,
					'source' 					=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorSource,
				),
				"description"       	=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_EditorVisualSelector == "true" ? __( "Select the icon to be used as decoration for the overlay.", "ts_visual_composer_extend" ) : $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_IconSelectorString),
				"dependency"        	=> array( 'element' => "overlay_decoration", 'value' => 'icon' ),
				"group" 				=> "Overlay Settings",
			),	
			array(
				"type"              	=> "colorpicker",
				"heading"           	=> __( "Overlay: Decoration Color", "ts_visual_composer_extend" ),
				"param_name"        	=> "overlay_icon_color",
				"value"             	=> "#ededed",
				"description"       	=> __( "Select the color for the decoration element.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "overlay_decoration", 'value' => 'icon' ),
				"group" 				=> "Overlay Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Overlay: Decoration Size", "ts_visual_composer_extend" ),
				"param_name"            => "overlay_size",
				"value"                 => "100",
				"min"                   => "50",
				"max"                   => "200",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Define the size of the decoration element in the overlay.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "overlay_decoration", 'value' => array('icon', 'image', 'external') ),
				"group" 				=> "Overlay Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Overlay: Decoration Opacity", "ts_visual_composer_extend" ),
				"param_name"            => "overlay_opacity",
				"value"                 => "75",
				"min"                   => "50",
				"max"                   => "100",
				"step"                  => "1",
				"unit"                  => '%',
				"description"           => __( "Define the opacity of the decoration element in the overlay.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "overlay_decoration", 'value' => array('icon', 'image', 'external') ),
				"group" 				=> "Overlay Settings",
			),
			array(
				"type"              	=> "colorpicker",
				"heading"           	=> __( "Overlay: Title Color", "ts_visual_composer_extend" ),
				"param_name"        	=> "overlay_title_color",
				"value"             	=> "#ffffff",
				"description"       	=> __( "Select the font color for the overlay title.", "ts_visual_composer_extend" ),
				"edit_field_class"		=> "vc_col-sm-6 vc_column",
				"dependency"        	=> array( 'element' => "content_shape", 'value' => 'standard' ),	
				"group" 				=> "Overlay Settings",
			),
			array(
				"type"              	=> "colorpicker",
				"heading"           	=> __( "Overlay: Title Background", "ts_visual_composer_extend" ),
				"param_name"        	=> "overlay_title_back",
				"value"             	=> "rgba(0, 0, 0, 0.4)",
				"description"       	=> __( "Select the background color and opacity for the overlay title.", "ts_visual_composer_extend" ),
				"edit_field_class"		=> "vc_col-sm-6 vc_column",
				"dependency"        	=> array( 'element' => "content_shape", 'value' => 'standard' ),	
				"group" 				=> "Overlay Settings",
			),
			// Lightbox Settings
			array(
				"type"                  => "seperator",
				"param_name"            => "seperator_3",
				"seperator"             => "Lightbox Settings",
				"group" 				=> "Lightbox Settings",
			),
			array(
				"type"              	=> "switch_button",
				"heading"			    => __( "Create AutoGroup", "ts_visual_composer_extend" ),
				"param_name"		    => "lightbox_group",
				"value"				    => "true",
				"description"		    => __( "Switch the toggle if you want the plugin to group this image with all other non-gallery images on the page.", "ts_visual_composer_extend" ),
				"group" 				=> "Lightbox Settings",
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "Group Name", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_group_name",
				"value"                 => "",
				"admin_label"           => true,
				"description"           => __( "Enter a custom group name to manually build group with other non-gallery items.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_group", 'value' => 'false' ),
				"group" 				=> "Lightbox Settings",
			),			
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Lightbox Title Source", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_title",
				"width"                 => 150,
				"value"                 => array(
					__( 'Overlay Image Title', "ts_visual_composer_extend" )		=> "overlay",
					__( 'WP Media ALT Tag', "ts_visual_composer_extend" )			=> "alt",
					__( 'WP Media Title', "ts_visual_composer_extend" )				=> "title",
					__( 'WP Media Caption', "ts_visual_composer_extend" )			=> "caption",
					__( 'WP Media Description', "ts_visual_composer_extend" )		=> "content",
				),
				"description"           => __( "Select which source should be used for the image title in the lightbox.", "ts_visual_composer_extend" ),
				"dependency"            => "",
				"group" 				=> "Lightbox Settings",
			),	
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Transition Effect", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_effect",
				"width"                 => 150,
				"value"                 => $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Lightbox_Animations,
				"default" 				=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Default_Animation,
				"std" 					=> $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_Default_Animation,
				"admin_label"           => true,
				"description"           => __( "Select the transition effect to be used for the image in the lightbox.", "ts_visual_composer_extend" ),
				"dependency"            => "",
				"group" 				=> "Lightbox Settings",
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Backlight Effect", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_backlight",
				"width"                 => 150,
				"value"                 => array(
					__( 'Auto Color', "ts_visual_composer_extend" )					=> "auto",
					__( 'Custom Color', "ts_visual_composer_extend" )				=> "custom",
					__( 'Transparent Backlight', "ts_visual_composer_extend" )		=> "hideit",
					__( 'Fully Remove Backlight', "ts_visual_composer_extend" )		=> "remove",
				),
				"admin_label"           => true,
				"description"           => __( "Select the backlight effect for the image.", "ts_visual_composer_extend" ),
				"dependency"            => "",
				"group" 				=> "Lightbox Settings",
			),
			array(
				"type"                  => "colorpicker",
				"heading"               => __( "Custom Backlight Color", "ts_visual_composer_extend" ),
				"param_name"            => "lightbox_backlight_color",
				"value"                 => "#ffffff",
				"description"           => __( "Define the backlight color for the lightbox image.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_backlight", 'value' => 'custom' ),
				"group" 				=> "Lightbox Settings",
			),
			array(
				"type"                  => "dropdown",
				"heading"			    => __( "Force CORS Requests", "ts_visual_composer_extend" ),
				"param_name"		    => "lightbox_usecors",
				"width"                 => 150,
				"value"                 => array(
					__( 'Use Global Setting', "ts_visual_composer_extend" )       	=> "global",
					__( 'Force CORS Requests', "ts_visual_composer_extend" )		=> "true",
					__( 'Disable CORS Requests', "ts_visual_composer_extend" )		=> "false",
				),
				"description"		    => __( "Switch the toggle if you want to use CORS requests for the lightbox to retrieve color information for the backlight. Use only if your image(s) are served from an external server (i.e. CDN) and the server supports CORS.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "lightbox_backlight", 'value' => 'auto' ),
				"group" 				=> "Lightbox Settings",
			),	
			array(
				"type"              	=> "switch_button",
				"heading"			    => __( "Social Share Buttons", "ts_visual_composer_extend" ),
				"param_name"		    => "lightbox_social",
				"value"				    => "false",
				"description"		    => __( "Switch the toggle if you want show social share buttons with deeplinking for each image (if hashtag navigation enabled).", "ts_visual_composer_extend" ),
				"group" 				=> "Lightbox Settings",
			),
			array(
				"type"              	=> "switch_button",
				"heading"			    => __( "Remove Hashtag Navigation", "ts_visual_composer_extend" ),
				"param_name"		    => "lightbox_nohashes",
				"value"				    => "true",
				"description"		    => __( "Switch the toggle if you want to remove the hashtag navigation links from the lightbox.", "ts_visual_composer_extend" ),
				"group" 				=> "Lightbox Settings",
			),
			// Other Settings
			array(
				"type"                  => "seperator",
				"param_name"            => "seperator_4",
				"seperator"				=> "Other Settings",
				"group" 				=> "Other Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Margin: Top", "ts_visual_composer_extend" ),
				"param_name"            => "margin_top",
				"value"                 => "0",
				"min"                   => "0",
				"max"                   => "200",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Select the top margin for the element.", "ts_visual_composer_extend" ),
				"group" 				=> "Other Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Margin: Bottom", "ts_visual_composer_extend" ),
				"param_name"            => "margin_bottom",
				"value"                 => "0",
				"min"                   => "0",
				"max"                   => "200",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Select the bottom margin for the element.", "ts_visual_composer_extend" ),
				"group" 				=> "Other Settings",
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "Define ID Name", "ts_visual_composer_extend" ),
				"param_name"            => "el_id",
				"value"                 => "",
				"description"           => __( "Enter an unique ID for the element.", "ts_visual_composer_extend" ),
				"group" 				=> "Other Settings",
			),
			array(
				"type"                  => "tag_editor",
				"heading"           	=> __( "Extra Class Names", "ts_visual_composer_extend" ),
				"param_name"            => "el_class",
				"value"                 => "",
				"description"      		=> __( "Enter additional class names for the element.", "ts_visual_composer_extend" ),
				"group" 				=> "Other Settings",
			),
		)
	);
		
	if ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_LeanMap == "true") {
		return $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element;
	} else {			
		vc_map($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element);
	}
?>