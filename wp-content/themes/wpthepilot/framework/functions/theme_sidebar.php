<?php
	global $default_sidebars;
	
	$default_sidebars = array(

						array(
							'name' => __( 'Primary Widget Area', 'wpdance' ),
							'id' => 'primary-widget-area',
							'description' => __( 'The primary sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Header Top Left Widget Area', 'wpdance' ),
							'id' => 'wd-header-top-wider-area-left',
							'description' => __( 'The Header top sidebar widget area - left', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Header Top Right Widget Area', 'wpdance' ),
							'id' => 'wd-header-top-wider-area-right',
							'description' => __( 'The Header top sidebar widget area - left', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Header Top Right Widget Area 2', 'wpdance' ),
							'id' => 'wd-header-top-wider-area-right2',
							'description' => __( 'The Header top sidebar widget area - left', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Header Middle Slidshow Widget Area', 'wpdance' ),
							'id' => 'wd-header-middle-slidshow-wider-area',
							'description' => __( 'Using for header v4 (SuperMarket)', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						
						,array(
							'name' => __( 'Top Content Widget Area', 'wpdance' ),
							'id' => 'wd-top-content-wider-area',
							'description' => __( 'The widget area top content', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						
						,array(
							'name' => __( 'Category Widget Area', 'wpdance' ),
							'id' => 'category-widget-area',
							'description' => __( 'The Category sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Pages Widget Area', 'wpdance' ),
							'id' => 'pages-widget-area',
							'description' => __( 'The Pages sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)										
						,array(
							'name' => __( 'Blog Left Widget Area', 'wpdance' ),
							'id' => 'blog-left-widget-area',
							'description' => __( 'The Blog left sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						
						,array(
							'name' => __( 'Blog Right Widget Area', 'wpdance' ),
							'id' => 'blog-right-widget-area',
							'description' => __( 'The Blog left sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						
						,array(
							'name' => __( 'Shop Left Widget Area', 'wpdance' ),
							'id' => 'shop-left-widget-area',
							'description' => __( 'The Category sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						
						,array(
							'name' => __( 'Shop Right Widget Area', 'wpdance' ),
							'id' => 'shop-right-widget-area',
							'description' => __( 'The Category sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						
						,array(
							'name' => __( 'Product Widget Area', 'wpdance' ),
							'id' => 'product-widget-area',
							'description' => __( 'Product default sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'First Footer Widget Area 1', 'wpdance' ),
							'id' => 'first-footer-widget-area-1',
							'description' => __( 'Product default sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control open_def" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'First Footer Widget Area 2', 'wpdance' ),
							'id' => 'first-footer-widget-area-2',
							'description' => __( 'Product default sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control open_def" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'First Footer Widget Area 3', 'wpdance' ),
							'id' => 'first-footer-widget-area-3',
							'description' => __( 'Product default sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control open_def" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'First Footer Widget Area 4', 'wpdance' ),
							'id' => 'first-footer-widget-area-4',
							'description' => __( 'Product default sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control open_def" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Recent Blogs Widget Area ', 'wpdance' ),
							'id' => 'recent-blogs-widget-area',
							'description' => __( 'Recent Blogs sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control open_def" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Second Footer Widget Area 1', 'wpdance' ),
							'id' => 'second-footer-widget-area-1',
							'description' => __( 'Product default sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control open_def" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Second Footer Widget Area 2', 'wpdance' ),
							'id' => 'second-footer-widget-area-2',
							'description' => __( 'Product default sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control open_def" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)						
						,array(
							'name' => __( 'Third Footer Widget Area 1', 'wpdance' ),
							'id' => 'third-footer-widget-area-1',
							'description' => __( 'Product default sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control open_def" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Third Footer Widget Area 2', 'wpdance' ),
							'id' => 'third-footer-widget-area-2',
							'description' => __( 'Product default sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control open_def" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Third Footer Widget Area 3', 'wpdance' ),
							'id' => 'third-footer-widget-area-3',
							'description' => __( 'Product default sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control open_def" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Third Footer Widget Area 4', 'wpdance' ),
							'id' => 'third-footer-widget-area-4',
							'description' => __( 'Product default sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control open_def" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
							
						)
						
	);

function wpdance_widgets_init() {
	global $default_sidebars;
	
	$custom_sidebar_str = get_option(THEME_SLUG.'areas');
	if($custom_sidebar_str){
		$custom_sidebar_arr = json_decode($custom_sidebar_str);		
	}else{
		$custom_sidebar_arr = array();
	}	

		
	$_init_sidebar_array = array();	
	if( count($custom_sidebar_arr) > 0 ){
		
			foreach( $custom_sidebar_arr as $_area ){
				$_area_name = stripslashes(esc_html (ucwords( str_replace("-"," ",$_area) ) ));
				$_init_sidebar_array[] = array(
							'name' => sprintf( __( '%s Widget Area','wpdance' ), $_area_name ) //__( "{$_area_name} Widget Area", 'wpdance' )
							,'id' => strtolower( str_replace(" ","-",$_area) )
							,'description' => sprintf( __( '%s sidebar widget area','wpdance' ), $_area_name ) //__( "{$_area_name} sidebar widget area", 'wpdance' )
							,'before_widget' => '<li id="%1$s" class="widget-container %2$s">'
							,'after_widget' => '</li>'
							,'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">'
							,'after_title' => '</h3></div>'
				);	
				
			}	
	}	
	
	$default_sidebars = array_merge($default_sidebars,$_init_sidebar_array);
	
	foreach( $default_sidebars as $sidebar ){
		register_sidebar($sidebar);
	}	
}
/** Register sidebars by running wpdance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'wpdance_widgets_init' );

?>