<?php
    /*
    Additional Setting Options:
        array(
            "type"          => "switch_button",
			"value"         => "true",
			"on"            => __( 'Yes', "ts_visual_composer_extend" ),
			"off"           => __( 'No', "ts_visual_composer_extend" ),
        )
    */
    if (!class_exists('TS_Parameter_Switch')) {
        class TS_Parameter_Switch {
            function __construct() {	
                if (function_exists('vc_add_shortcode_param')) {
                    vc_add_shortcode_param('switch_button', array(&$this, 'switch_button_settings_field'));
				} else if (function_exists('add_shortcode_param')) {
					add_shortcode_param('switch_button', array(&$this, 'switch_button_settings_field'));
				}
            }        
            function switch_button_settings_field($settings, $value) {
                global $VISUAL_COMPOSER_EXTENSIONS;
                $dependency     = vc_generate_dependencies_attributes($settings);
                $param_name     = isset($settings['param_name'])    ? $settings['param_name']   : '';
                $type           = isset($settings['type'])          ? $settings['type']         : '';
                $on            	= isset($settings['on'])            ? $settings['on']           : __( "Yes", "ts_visual_composer_extend" );
                $off            = isset($settings['off'])           ? $settings['off']          : __( "No", "ts_visual_composer_extend" );
				// Global Settings
                $suffix         = isset($settings['suffix'])        ? $settings['suffix']       : '';
                $class          = isset($settings['class'])         ? $settings['class']        : '';
				$render			= isset($settings['render'])        ? $settings['render']       : 'string';
                $url            = $VISUAL_COMPOSER_EXTENSIONS->TS_VCSC_PluginPath;
                $output         = '';
				$output .= '<div class="ts-switch-button ts-codestar-field-switcher" data-value="' . $value . '">';
					$output .= '<input type="hidden" style="display: none;" class="ts-codestar-value toggle-input wpb_vc_param_value ' . $param_name . ' ' . $type . '" value="' . $value . '" name="' . $param_name . '"/>';
					$output .= '<div class="ts-codestar-fieldset">';
						$output .= '<label class="ts-codestar-label">';										
							$output .= '<input id="' . $param_name . '-checkbox" value="' . $value . '" class="ts-codestar-checkbox" type="checkbox" ' . ($value == "true" ? 'checked="checked"' : '') . '> ';
							$output .= '<em data-on="'. $on .'" data-off="'. $off .'"></em>';
							$output .= '<span></span>';
						$output .= '</label>';
					$output .= '</div>';
				$output .= '</div>';
                return $output;
            }            
        }
    }
    if (class_exists('TS_Parameter_Switch')) {
        $TS_Parameter_Switch = new TS_Parameter_Switch();
    }
?>