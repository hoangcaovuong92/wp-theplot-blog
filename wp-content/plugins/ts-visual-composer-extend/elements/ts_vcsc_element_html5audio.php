<?php
    global $VISUAL_COMPOSER_EXTENSIONS;
	
    $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_VisualComposer_Element = array(
		"name"                          => __( "TS Audio HTML5", "ts_visual_composer_extend" ),
		"base"                          => "TS_VCSC_HTML5_Audio",
		"icon" 	                        => "ts-composer-element-icon-html5-audio",
		"class"                         => "",
		"category"                      => __( "VC Extensions", "ts_visual_composer_extend" ),
		"description"                   => __("Place a HTML5 audio element", "ts_visual_composer_extend"),
		"admin_enqueue_js"              => "",
		"admin_enqueue_css"             => "",
		"params"                        => array(
			// Audio Sources
			array(
				"type"                  => "seperator",
				"param_name"            => "seperator_1",
				"seperator"				=> "Audio Sources",
			),
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "MP3 Audio Source", "ts_visual_composer_extend" ),
				"param_name"		    => "audio_mp3_source",
				"value"                 => "true",
				"description"		    => __( "Switch the toggle if you want to use a local or remote MP4 audio file.", "ts_visual_composer_extend" )
			),
			array(
				"type"                  => "audioselect",
				"heading"               => __( "MP3 Audio", "ts_visual_composer_extend" ),
				"param_name"            => "audio_mp3_local",
				"audio_format"			=> "mp3,mpeg",
				"value"                 => "",
				"description"           => __( "Select a local MP3 audio from WordPress.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_mp3_source", 'value' => 'true' ),
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "MP3 Audio", "ts_visual_composer_extend" ),
				"param_name"            => "audio_mp3_remote",
				"value"                 => "",
				"description"           => __( "Enter the remote path to the MP3 version of the audio.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_mp3_source", 'value' => 'false' ),
			),				
			array(
				"type"              	=> "messenger",
				"param_name"        	=> "messenger",
				"color"					=> "#006BB7",
				"size"					=> "14",
				"value"					=> "",
				"message"            	=> __( "If no alternative audio format (OGG) is provided, the player will attempt to use the flash fallback in order to play the MP3 version on browsers without MP3 support.", "ts_visual_composer_extend" ),
				"description"       	=> ""
			),							
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "OGG Audio Source", "ts_visual_composer_extend" ),
				"param_name"		    => "audio_ogg_source",
				"value"                 => "true",
				"description"		    => __( "Switch the toggle if you want to use a local or remote OGV audio file.", "ts_visual_composer_extend" )
			),
			array(
				"type"                  => "audioselect",
				"heading"               => __( "OGG Audio", "ts_visual_composer_extend" ),
				"param_name"            => "audio_ogg_local",
				"audio_format"			=> "ogg,ogv",
				"value"                 => "",
				"description"           => __( "Select a local OGG audio from WordPress.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_ogg_source", 'value' => 'true' ),
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "OGG Audio", "ts_visual_composer_extend" ),
				"param_name"            => "audio_ogg_remote",
				"value"                 => "",
				"description"           => __( "Enter the remote path to the OGG version of the audio.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_ogg_source", 'value' => 'false' ),
			),							
			// Audio Settings
			array(
				"type"                  => "seperator",
				"param_name"            => "seperator_2",
				"seperator"				=> "Fixed Player",
				"group" 				=> "Player Settings",
			),
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Show as Fixed Player", "ts_visual_composer_extend" ),
				"param_name"		    => "audio_fixed",
				"value"                 => "false",
				"admin_label"           => true,
				"description"		    => __( "Switch the toggle if you want to show the player fixed on the screen.", "ts_visual_composer_extend" ),
				"group" 				=> "Player Settings"
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Fixed Position", "ts_visual_composer_extend" ),
				"param_name"            => "audio_fixed_position",
				"width"                 => 150,
				"value"                 => array(
					__( 'Bottom Left', "ts_visual_composer_extend" )		=> "bottomleft",
					__( 'Bottom Right', "ts_visual_composer_extend" )		=> "bottomright",
					__( 'Top Left', "ts_visual_composer_extend" )			=> "topleft",
					__( 'Top Right', "ts_visual_composer_extend" )			=> "topright",
				),
				"description"           => __( "Select the fixed position for the player on the screen.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Fixed Adjustment", "ts_visual_composer_extend" ),
				"param_name"            => "audio_fixed_adjust",
				"value"                 => "0",
				"min"                   => "0",
				"max"                   => "500",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Define an additional position adjustment for the fixed player; i.e. to account for fixed menu bars.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Fixed Control", "ts_visual_composer_extend" ),
				"param_name"            => "audio_fixed_switch",
				"width"                 => 150,
				"value"                 => array(
					__( 'Show / Hide Toggle', "ts_visual_composer_extend" )	=> "toggle",
					__( 'Remove Switch', "ts_visual_composer_extend" )		=> "remove",
					__( 'None', "ts_visual_composer_extend" )				=> "none",
				),
				"description"           => __( "Select if and which additional controls should be added to the fixed player.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),				
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Show on Page Load", "ts_visual_composer_extend" ),
				"param_name"		    => "audio_fixed_show",
				"value"                 => "true",
				"admin_label"           => false,
				"description"		    => __( "Switch the toggle if you want to show the fixed player on page load or initially hide it.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed_switch", 'value' => 'toggle' ),
				"group" 				=> "Player Settings"
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Fixed Width", "ts_visual_composer_extend" ),
				"param_name"            => "audio_fixed_width",
				"value"                 => "250",
				"min"                   => "250",
				"max"                   => "500",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Define the width for the fixed player.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Fixed Height", "ts_visual_composer_extend" ),
				"param_name"            => "audio_fixed_height",
				"value"                 => "140",
				"min"                   => "100",
				"max"                   => "500",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Define the height for the fixed player; will not apply if 'Show Bar Only' has been selected.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),
			// Player Style
			array(
				"type"                  => "seperator",
				"param_name"            => "seperator_3",
				"seperator"				=> "Player Style",
				"group" 				=> "Player Settings",
			),
			array(
				"type"				    => "dropdown",
				"class"				    => "",
				"heading"			    => __( "Player Theme", "ts_visual_composer_extend" ),
				"param_name"		    => "audio_theme",
				"value"                 => array(
					__("Maccaco", "ts_visual_composer_extend")					=> "maccaco",                        
					__("Totally Looks Alike", "ts_visual_composer_extend")		=> "totallylookslike",
					__("Minimum", "ts_visual_composer_extend")					=> "minimum",
				),
				"description"		    => __( "Select the overall theme for the player.", "ts_visual_composer_extend" ),
				"dependency"		    => "",
				"group" 				=> "Player Settings",
			),		
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Show Bar Only", "ts_visual_composer_extend" ),
				"param_name"		    => "audio_bar_only",
				"value"                 => "false",
				"admin_label"           => true,
				"description"		    => __( "Switch the toggle if you just want to show the player bar without poster.", "ts_visual_composer_extend" ),
				"group" 				=> "Player Settings"
			),
			array(
				"type"                  => "attach_image",
				"heading"               => __( "Audio Poster", "ts_visual_composer_extend" ),
				"param_name"            => "audio_poster",
				"value"                 => "",
				"description"           => __( "Select the image that should be used as audio poster.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_bar_only", 'value' => 'false' ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "Audio Title", "ts_visual_composer_extend" ),
				"param_name"            => "audio_title",
				"value"                 => "",
				"description"           => __( "Enter a title or name for the audio.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_bar_only", 'value' => 'false' ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"                  => "seperator",
				"param_name"            => "seperator_4",
				"seperator"				=> "Player Settings",
				"group" 				=> "Player Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Audio Volume", "ts_visual_composer_extend" ),
				"param_name"            => "audio_volume",
				"value"                 => "50",
				"min"                   => "0",
				"max"                   => "100",
				"step"                  => "1",
				"unit"                  => '%',
				"description"           => __( "Select the startup volume for the media; set to 0 (Zero) to mute; desktop only (valid for first session).", "ts_visual_composer_extend" ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Audio Auto-Play", "ts_visual_composer_extend" ),
				"param_name"		    => "audio_auto",
				"value"                 => "false",
				"admin_label"           => true,
				"description"		    => __( "Switch the toggle if you want the media to start playing upon page load (non-mobile devices).", "ts_visual_composer_extend" ),
				"group" 				=> "Player Settings"
			),			
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Auto-Play On Mobile", "ts_visual_composer_extend" ),
				"param_name"		    => "audio_mobile",
				"value"                 => "false",
				"description"		    => __( "Switch the toggle if you want to force the auto-play on mobile devices as well.", "ts_visual_composer_extend" ),
				"dependency"        	=> array( 'element' => "audio_auto", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),			
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Audio Auto-Stop", "ts_visual_composer_extend" ),
				"param_name"		    => "audio_stop",
				"value"                 => "true",
				"admin_label"           => true,
				"description"		    => __( "Switch the toggle if you want all other medias to stop once this one starts playing.", "ts_visual_composer_extend" ),
				"group" 				=> "Player Settings"
			),
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Audio Loop", "ts_visual_composer_extend" ),
				"param_name"		    => "audio_loop",
				"value"                 => "false",
				"admin_label"           => true,
				"description"		    => __( "Switch the toggle if you want the media to loop and start over each time it has finished.", "ts_visual_composer_extend" ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"                  => "switch_button",
				"heading"			    => __( "Audio Share Buttons", "ts_visual_composer_extend" ),
				"param_name"		    => "audio_share",
				"value"                 => "true",
				"admin_label"           => true,
				"description"		    => __( "Switch the toggle if you want to show social share button for the media.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_bar_only", 'value' => 'false' ),
				"group" 				=> "Player Settings"
			),				
			// Tooltip Settings
			array(
				"type"				    => "seperator",
				"param_name"		    => "seperator_5",
				"value"					=> "",
				"seperator"				=> "Audio Tooltip",
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"                  => "textfield",
				"heading"               => __( "Tooltip Title", "ts_visual_composer_extend" ),
				"param_name"            => "content_tooltip_title",
				"value"                 => "",
				"description"           => __( "Enter an optional title for the tooltip.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"				    => "textarea",
				"class"				    => "",
				"heading"			    => __( "Tooltip Content", "ts_visual_composer_extend" ),
				"param_name"		    => "content_tooltip_content",
				"value"				    => "",
				"description"		    => __( "Enter the tooltip content here (do not use quotation marks).", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"				    => "dropdown",
				"class"				    => "",
				"heading"			    => __( "Tooltip Position", "ts_visual_composer_extend" ),
				"param_name"		    => "content_tooltip_position",
				"value"                 => array(
					__("Top", "ts_visual_composer_extend")                    	=> "ts-simptip-position-top",
					__("Bottom", "ts_visual_composer_extend")                 	=> "ts-simptip-position-bottom",
					__("Left", "ts_visual_composer_extend")                    	=> "ts-simptip-position-left",
					__("Right", "ts_visual_composer_extend")                 	=> "ts-simptip-position-right",
				),
				"description"		    => __( "Select the tooltip position in relation to the player.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"				    => "dropdown",
				"class"				    => "",
				"heading"			    => __( "Tooltip Style", "ts_visual_composer_extend" ),
				"param_name"		    => "content_tooltip_style",
				"value"                 => array(
					__("Black", "ts_visual_composer_extend")                  	=> "ts-simptip-style-black",
					__("Gray", "ts_visual_composer_extend")                   	=> "ts-simptip-style-gray",
					__("Green", "ts_visual_composer_extend")                  	=> "ts-simptip-style-green",
					__("Blue", "ts_visual_composer_extend")                   	=> "ts-simptip-style-blue",
					__("Red", "ts_visual_composer_extend")                    	=> "ts-simptip-style-red",
					__("Orange", "ts_visual_composer_extend")                 	=> "ts-simptip-style-orange",
					__("Yellow", "ts_visual_composer_extend")                 	=> "ts-simptip-style-yellow",
					__("Purple", "ts_visual_composer_extend")                 	=> "ts-simptip-style-purple",
					__("Pink", "ts_visual_composer_extend")                   	=> "ts-simptip-style-pink",
					__("White", "ts_visual_composer_extend")                  	=> "ts-simptip-style-white"
				),
				"description"		    => __( "Select the tooltip style.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Other Settings",
			),
			array(
				"type"					=> "nouislider",
				"heading"				=> __( "Tooltip X-Offset", "ts_visual_composer_extend" ),
				"param_name"			=> "tooltipster_offsetx",
				"value"					=> "0",
				"min"					=> "-100",
				"max"					=> "100",
				"step"					=> "1",
				"unit"					=> 'px',
				"description"			=> __( "Define an optional X-Offset for the tooltip position.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),
			array(
				"type"					=> "nouislider",
				"heading"				=> __( "Tooltip Y-Offset", "ts_visual_composer_extend" ),
				"param_name"			=> "tooltipster_offsety",
				"value"					=> "0",
				"min"					=> "-100",
				"max"					=> "100",
				"step"					=> "1",
				"unit"					=> 'px',
				"description"			=> __( "Define an optional Y-Offset for the tooltip position.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_fixed", 'value' => 'true' ),
				"group" 				=> "Player Settings",
			),		
			// Logo Settings
			array(
				"type"                  => "seperator",
				"param_name"            => "seperator_6",
				"seperator"				=> "Logo Settings",
				"group" 				=> "Logo Settings",
			),		
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Show Logo", "ts_visual_composer_extend" ),
				"param_name"            => "audio_logo_show",
				"width"                 => 150,
				"value"                 => array(
					__( 'No Logo', "ts_visual_composer_extend" )							=> "logonone",
					__( 'Show Logo on Top of Video', "ts_visual_composer_extend" )			=> "logotop",
					__( 'Show Logo in Controlbar', "ts_visual_composer_extend" )			=> "logocontrol",
				),
				"description"           => __( "Select if and where an additional logo should be shown.", "ts_visual_composer_extend" ),
				"dependency"            => "",
				"group" 				=> "Logo Settings",
			),				
			array(
				"type"                  => "attach_image",
				"heading"               => __( "Logo Image", "ts_visual_composer_extend" ),
				"param_name"            => "audio_logo_image",
				"value"                 => "",
				"description"           => __( "Select the logo image that will be shown on top of the media or the player control bar.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_logo_show", 'value' => array('logotop','logocontrol') ),
				"group" 				=> "Logo Settings",
			),
			array(
				"type"                  => "dropdown",
				"heading"               => __( "Logo Position", "ts_visual_composer_extend" ),
				"param_name"            => "audio_logo_position",
				"width"                 => 150,
				"value"                 => array(
					__( 'Top Left', "ts_visual_composer_extend" )			=> "topleft",
					__( 'Top Right', "ts_visual_composer_extend" )			=> "topright",
					__( 'Bottom Left', "ts_visual_composer_extend" )		=> "bottomleft",
					__( 'Bottom Right', "ts_visual_composer_extend" )		=> "bottomright",
				),
				"description"           => __( "Select the position for the logo that will be shown on top of the media; only applies if 'Show Bar Only' is set to 'No'.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_logo_show", 'value' => 'logotop' ),
				"group" 				=> "Logo Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Max. Logo Height", "ts_visual_composer_extend" ),
				"param_name"            => "audio_logo_height",
				"value"                 => "50",
				"min"                   => "25",
				"max"                   => "200",
				"step"                  => "1",
				"unit"                  => 'px',
				"description"           => __( "Define the maximum height in px for the logo that is shown on top of the media; only applies if 'Show Bar Only' is set to 'No'.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_logo_show", 'value' => 'logotop' ),
				"group" 				=> "Logo Settings",
			),
			array(
				"type"                  => "nouislider",
				"heading"               => __( "Logo Opacity", "ts_visual_composer_extend" ),
				"param_name"            => "audio_logo_opacity",
				"value"                 => "50",
				"min"                   => "0",
				"max"                   => "100",
				"step"                  => "1",
				"unit"                  => '%',
				"description"           => __( "Define the opacity for the logo that is shown on top of the media.", "ts_visual_composer_extend" ),
				"dependency"            => array( 'element' => "audio_logo_show", 'value' => array('logotop','logocontrol') ),
				"group" 				=> "Logo Settings",
			),
			array(
				"type" 					=> ($VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_ParameterLinkPicker['enabled'] == "false" ? "vc_link" : "advancedlinks"),
				"heading" 				=> __("Logo Link + Title", "ts_visual_composer_extend"),
				"param_name" 			=> "audio_logo_link",
				"description" 			=> __("Provide an optional link to another site/page for the logo.", "ts_visual_composer_extend"),
				"dependency"            => array( 'element' => "audio_logo_show", 'value' => array('logotop','logocontrol') ),
				"group" 				=> "Logo Settings",
			),
			// Other Settings
			array(
				"type"				    => "seperator",
				"param_name"		    => "seperator_7",
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