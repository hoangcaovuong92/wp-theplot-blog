<?php
/*************************** Custom Functions Start Here *********************************/


/**************************** Custom Functions End Here **********************************/

//Enqueue Parent Theme Style
add_action( 'wp_enqueue_scripts', 'tvlgiao_wpdance_enqueue_parent_styles' );
if( !function_exists('tvlgiao_wpdance_enqueue_parent_styles') ){
	function tvlgiao_wpdance_enqueue_parent_styles() {
	   wp_enqueue_style( 'wd-parent-theme-style', get_template_directory_uri().'/style.css' );
	}
}
?>