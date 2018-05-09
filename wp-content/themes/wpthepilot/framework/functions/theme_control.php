<?php 
/*
	Generate theme control.
	Input : 
		- int $num_pages_per_phrase : the number of page per group.
	No output.
*/


add_action( 'template_redirect', 'my_page_template_redirect' );
function my_page_template_redirect(){
	global $wp_query,$post,$page_datas,$tvlgiao_wpdance_wd_data;
	$tvlgiao_wpdance_wd_data['wd_layout_style'] = (isset($tvlgiao_wpdance_wd_data['wd_layout_styles']) ? $tvlgiao_wpdance_wd_data['wd_layout_styles'] : 'wide' ) ;
	$tvlgiao_wpdance_wd_data['wd_layout_header'] =(isset($tvlgiao_wpdance_wd_data['wd_header_styles']) ? $tvlgiao_wpdance_wd_data['wd_header_styles'] : 'wide' ) ;
	$tvlgiao_wpdance_wd_data['wd_layout_main_content'] = (isset($tvlgiao_wpdance_wd_data['wd_maincontent_styles']) ? $tvlgiao_wpdance_wd_data['wd_maincontent_styles'] : 'wide' );
	$tvlgiao_wpdance_wd_data['wd_layout_footer'] = (isset($tvlgiao_wpdance_wd_data['wd_footer_styles']) ? $tvlgiao_wpdance_wd_data['wd_footer_styles'] : 'wide' );
	
	
	if($wp_query->is_page()){
		global $page_datas,$wd_custom_style_config,$tvlgiao_wpdance_wd_data;
		$page_datas = unserialize(get_post_meta($post->ID,THEME_SLUG.'page_configuration',true));
		$page_datas = wd_array_atts(array(	
											"page_layout" 			=> '0'
											,"main_content_layout"	=> 'wide'
											,"header_layout"		=> 'wide'
											,"footer_layout"		=> 'wide'
											,"main_slider_layout"	=> 'wide'
											,"header_style"			=> '0'
											,"page_column" 			=> '0-1-0'
											,"left_sidebar" 		=> 'primary-widget-area'
											,"right_sidebar" 		=> 'primary-widget-area'
											,"page_slider" 			=> 'none'
                                            ,"page_slider_pos" 		=> 'after_header'
											,"page_revolution" 		=> ''
											,"page_layerslider"		=> ''
											,"page_flex" 			=> ''
											,"page_nivo" 			=> ''		
											,"product_tag"			=> ''
											,"hide_breadcrumb" 		=> 0		
											,"hide_title" 			=> 0
											,"toggle_vertical_menu" => 1
											,"hide_top_content" 	=> 1											
										),$page_datas);		
		$tvlgiao_wpdance_wd_data['wd_layout_style'] = strcmp($page_datas['page_layout'],'0') == 0 ? (isset($tvlgiao_wpdance_wd_data['wd_layout_styles']) ? $tvlgiao_wpdance_wd_data['wd_layout_styles'] : 'wide' ) : $page_datas['page_layout'] ;
		$tvlgiao_wpdance_wd_data['wd_layout_header'] = (strcmp($page_datas['page_layout'],'0')== 0 || strcmp($page_datas['header_layout'],'wide') == 0) ? (isset($tvlgiao_wpdance_wd_data['wd_layout_styles']) ? $tvlgiao_wpdance_wd_data['wd_header_styles'] : 'wide' ) : $page_datas['header_layout'] ;
		$tvlgiao_wpdance_wd_data['wd_layout_main_content'] = (strcmp($page_datas['page_layout'],'0')== 0 || strcmp($page_datas['main_content_layout'],'wide') == 0) ? (isset($tvlgiao_wpdance_wd_data['wd_maincontent_styles']) ? $tvlgiao_wpdance_wd_data['wd_maincontent_styles'] : 'wide' ) : $page_datas['main_content_layout'] ;
		$tvlgiao_wpdance_wd_data['wd_layout_footer'] = (strcmp($page_datas['page_layout'],'0')== 0 || strcmp($page_datas['footer_layout'],'wide') == 0) ? (isset($tvlgiao_wpdance_wd_data['wd_footer_styles']) ? $tvlgiao_wpdance_wd_data['wd_footer_styles'] : 'wide' ) : $page_datas['footer_layout'] ;
		if($tvlgiao_wpdance_wd_data['wd_layout_style'] == 'boxed') {
			$tvlgiao_wpdance_wd_data['wd_layout_header'] = 'boxed';
			$tvlgiao_wpdance_wd_data['wd_layout_main_content'] = 'boxed';
			$tvlgiao_wpdance_wd_data['wd_layout_footer'] = 'boxed';
		}
		
	}
	
	if(is_single()){
		global $tvlgiao_wpdance_wd_data,$post;
		/******************* Start Load Config On Single Post ******************/
		$_post_config = get_post_meta($post->ID,THEME_SLUG.'custom_post_config',true);
		
		if( strlen($_post_config) > 0 ){
			$_post_config = unserialize($_post_config);
			
			if( is_array($_post_config) && count($_post_config) > 0 ){
				$tvlgiao_wpdance_wd_data['wd_post_layout'] = ( isset($_post_config['layout']) && strlen($_post_config['layout']) > 0 && strcmp($_post_config["layout"],'0') != 0 ) ? $_post_config['layout'] : $tvlgiao_wpdance_wd_data['wd_post_layout'];
				$tvlgiao_wpdance_wd_data['wd_post_left_sidebar'] = ( isset($_post_config['left_sidebar']) && strlen($_post_config['left_sidebar']) > 0 && strcmp($_post_config["left_sidebar"],'0') != 0 ) ? $_post_config['left_sidebar'] : $tvlgiao_wpdance_wd_data['wd_post_left_sidebar'];
				$tvlgiao_wpdance_wd_data['wd_post_right_sidebar'] = ( isset($_post_config['right_sidebar']) && strlen($_post_config['right_sidebar']) > 0 && strcmp($_post_config["right_sidebar"],'0') != 0 ) ? $_post_config['right_sidebar'] : $tvlgiao_wpdance_wd_data['wd_post_right_sidebar'];
				if( ( strcmp( trim($_post_config['left_sidebar']),"0" ) != 0 || strcmp( trim($_post_config['right_sidebar']),"0" ) != 0 ) && strcmp($tvlgiao_wpdance_wd_data['wd_prod_layout'],'0-1-0') != 0 ){
				}
			}
		}	
	}
	
	
	if($tvlgiao_wpdance_wd_data['wd_catelog_mod'] == 0){	
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
		remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
		remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
		remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
		
		remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart', 8 );
		//add to cart ajax
		remove_action( 'woocommerce_after_shop_loop_item_title', 'wd_list_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );; 
		remove_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_add_to_cart', 11 );  	
	}
}



/**************************important hook**************************/

//add_filter( 'option_posts_per_page' , 'wd_change_posts_per_page'); //filter and change posts_per_page
add_action ('pre_get_posts','prepare_post_query',9); //hook into pre_get_posts to reset some querys

/*merge query post type function*/

function merge_post_type($query,$new_type = array()){
	$defaut_post_type = ( post_type_exists( 'portfolio' ) ? array('portfolio','post') : array('post') );
	$new_type = (is_array($new_type) && count($new_type) > 0) ? $new_type : $defaut_post_type;
	$default_post_type = $query->get('post_type');
	if(is_array($default_post_type)){
		$new_type = array_merge($default_post_type, $new_type);
	}else{
		$new_type = array_merge(array($default_post_type), $new_type);
	}
	return ( $new_type = array_unique($new_type) );
}
/*end merge query post type function*/

function remove_page_from_search_query($where_query){
	global $wpdb;
	$where_query .= " AND ".$wpdb->prefix."posts.post_type NOT IN ('page') ";
	return $where_query;
}

function add_a2z_query($where_query){
	global $wpdb;
	$_start_char = get_query_var('start_char');
	$_up_char = strtoupper($_start_char);
	$_down_char = strtolower($_start_char);
	$where_query .= " AND left(".$wpdb->prefix."posts.post_title,1) IN ('{$_up_char}','{$_down_char}') ";
	return $where_query;
}


function prepare_post_query($query){
	
	global $page_datas,$post;
	$paged = (int)get_query_var('paged');
		
	
	if($paged>0){
		set_query_var('page',$paged);
	}
	if($query->is_tag()){
		$query->set('post_type',merge_post_type($query) );
	}
	if($query->is_search()){	
		add_action( "posts_where", "remove_page_from_search_query", 10 );
	}	
	if($query->is_date()){
		$query->set('post_type',merge_post_type($query) );
	}

	if($query->is_author()){
		$query->set('post_type',merge_post_type($query) );
	}
	if($query->is_archive){
		if(isset($_GET['term']) && $_GET['term']=="" && isset($_GET['s']) && $_GET['s']=="" && isset($_GET['taxonomy']))
			$query->query_vars['taxonomy'] = "";
	}
	return $query;
	
}



function wd_change_posts_per_page($option_posts_per_page){
	global $wp_query;
	if($wp_query->is_search()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_search') > 0 ? (int)get_option(THEME_SLUG.'num_post_search') : $option_posts_per_page );
        return $posts_per_page;
	}
	//if($wp_query->is_front_page() || $wp_query->is_home()){
	if( $wp_query->is_home() ){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_home') > 0 ? (int)get_option(THEME_SLUG.'num_post_home') : $option_posts_per_page );
        return $posts_per_page;
	}
	//if( is_page_template('page-templates/blog-template.php') ){
	if( $wp_query->is_page() ){
		$blog_template_array = array('blog-template.php','blogtemplate.php','portfolio.php');
		//$template_name = get_post_meta( $wp_query->queried_object_id, '_wp_page_template', true );
		$template_name = get_post_meta( $wp_query->query_vars['page_id'], '_wp_page_template', true );
		if(in_array($template_name,$blog_template_array)){
			$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_blog_page') > 0 ? (int)get_option(THEME_SLUG.'num_post_blog_page') : $option_posts_per_page );
			return $posts_per_page;
		}
	}

	if($wp_query->is_single()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_related') > 0 ? (int)get_option(THEME_SLUG.'num_post_related') : $option_posts_per_page );
        return $posts_per_page;
	}
	if($wp_query->is_category()){
		
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_cat') > 0 ? (int)get_option(THEME_SLUG.'num_post_cat') : $option_posts_per_page );
        return $posts_per_page;
	}
	if($wp_query->is_tag()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_tag') > 0 ? (int)get_option(THEME_SLUG.'num_post_tag') : $option_posts_per_page );
        return $posts_per_page;
	}
    if ($wp_query->is_category() ) {
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_cat') > 0 ? (int)get_option(THEME_SLUG.'num_post_cat') : $option_posts_per_page );
        return $posts_per_page;
    }
	if($wp_query->is_archive()){
		$posts_per_page = ( (int)get_option(THEME_SLUG.'num_post_archive') > 0 ? (int)get_option(THEME_SLUG.'num_post_archive') : $option_posts_per_page );
        return $posts_per_page;
	}
    return $option_posts_per_page;
}

/**************************end the hook**************************/


if( !function_exists('wd_is_woocommerce') ){
	function wd_is_woocommerce(){
		if( in_array( "woocommerce/woocommerce.php", apply_filters( 'active_plugins', get_option( 'active_plugins' )  ) ) ){
			return true;
		}
		return false;
	}
}


?>