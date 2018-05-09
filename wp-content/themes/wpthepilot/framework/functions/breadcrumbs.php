<?php 
/* 
	Show breadcrumbs with format : 
		Home � Category � Subcategory � Post Title
		Home � Subcategory � Post Title
		Home � Page Level 1 � Page Level 2 � Page Level 3
*/
if(!function_exists('tvlgiao_wpdance_dimox_breadcrumbs')){
	function tvlgiao_wpdance_dimox_breadcrumbs() {
 
		$delimiter = '<span class="brn_arrow">&raquo;</span>';
		$home = esc_html__('Home','wpgeneral'); // text for the 'Home' link
		$before = '<span class="current">'; // tag before the current crumb
		$after = '</span>'; // tag after the current crumb
		global $wp_rewrite;
		$rewriteUrl = $wp_rewrite->using_permalinks();
		if ( !is_home() && !is_front_page() || is_paged() ) {
		
			echo '<div id="crumbs" class="container heading">';
			
			global $post;
			$homeLink = home_url('/'); //get_bloginfo('url');
		
			echo '<a href="' . esc_url($homeLink) . '">' . $home . '</a> ' . $delimiter . ' ';
	 
			if ( is_category() ) {
				
				 global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
				echo wp_kses_post( $before . single_cat_title('', false) . $after);
			} elseif ( is_search() ) {
				echo  wp_kses_post($before . esc_html__('Search results for "','wpgeneral') . get_search_query() . '"' . $after);
			} elseif ( is_day() ) {
				echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo '<a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
				echo  wp_kses_post($before . get_the_time('d') . $after);
			} elseif ( is_month() ) {
				echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo  wp_kses_post($before . get_the_time('F') . $after);
	 
			} elseif ( is_year() ) {
				echo  wp_kses_post($before . get_the_time('Y') . $after);
			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					$post_type_name = $post_type->labels->singular_name;
					if(strcmp('Portfolio Item',$post_type->labels->singular_name)==0){
						$post_type_name = esc_html__('Portfolio','wpgeneral');
					}
					if(strcmp('Product',$post_type->labels->singular_name)==0){
						$post_type_name = esc_html__('Shop','wpgeneral');
					}
					
					if($rewriteUrl){
						echo '<a href="' .  esc_url($homeLink) . $slug['slug'] . '/">' . $post_type_name . '</a> ' /*. $delimiter . ' '*/;
					}else{
						echo '<a href="' .  esc_url($homeLink) . '/?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' /*. $delimiter . ' '*/;
					}
					
					//$pos = strpos(get_the_title(), ' ');
					// $before . substr(get_the_title(), 0, $pos) . '...' . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cat_break_str = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					$cat_break_pos = strrpos($cat_break_str, $delimiter);
					if(strlen($cat_break_str) <= absint($cat_break_pos) + strlen($delimiter) + 1) {
						$cat_break_str = substr($cat_break_str, 0, $cat_break_pos);
					}
					
					echo wp_kses_post($cat_break_str);
					//$pos = strpos(get_the_title(), ' ');
					// $before . substr(get_the_title(), 0, $pos) . '...' . $after;
					
				}
	 
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				if(isset($post_type)){
					$slug = $post_type->rewrite;
					$post_type_name = $post_type->labels->singular_name;
				
					if(strcmp('Portfolio Item',$post_type->labels->singular_name)==0){
						$post_type_name = esc_html__('Portfolio','wpgeneral');
					}
					if(strcmp('Product',$post_type->labels->singular_name)==0){
						$post_type_name = esc_html__('Shop','wpgeneral');
					}
				 }
				else
					$post_type_name = esc_html__('Shop','wpgeneral');
				if ( is_tag() ) {
					echo  wp_kses_post($before . esc_html__('Tagged "','wpgeneral') . single_tag_title('', false) . '"' . $after);
				} elseif(is_taxonomy_hierarchical(get_query_var('taxonomy'))){
				
					if($rewriteUrl){
						if( strpos( $slug['slug'], '/' ) == 0 ) $slug['slug'] = substr($slug['slug'], 1);
						echo '<a href="' .  esc_url($homeLink) . '/' . $slug['slug'] . '/">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}else{
						echo '<a href="' .  esc_url($homeLink) . '/?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
					}			
				
					$curTaxanomy = get_query_var('taxonomy');
					$curTerm = get_query_var( 'term' );
					
					$termNow = get_term_by( "slug",$curTerm, $curTaxanomy);
					
					$pushPrintArr = array();
					while ((int)$termNow->parent != 0){
					
						$parentTerm = get_term((int)$termNow->parent,get_query_var('taxonomy'));
						array_push($pushPrintArr,'<a href="' . get_term_link((int)$parentTerm->term_id,$curTaxanomy) . '">' . $parentTerm->name . '</a> ' . $delimiter . ' ');
					
						$curTerm = $parentTerm->name;
						$termNow = get_term_by( "slug",$curTerm, $curTaxanomy);
					}
					$pushPrintArr = array_reverse($pushPrintArr);
					
					//array_push($pushPrintArr,$before  . get_query_var( 'term' ) . $after);
					$cat_break_str = implode($pushPrintArr);
					if($cat_break_str !== ''){
						$cat_break_pos = strrpos($cat_break_str, $delimiter);
						if(strlen($cat_break_str) <= absint($cat_break_pos) + strlen($delimiter) + 1) {
							$cat_break_str = substr($cat_break_str, 0, $cat_break_pos);
						}
					} else {
						$termNow = get_term_by( "slug",$curTerm, $curTaxanomy);
						array_push($pushPrintArr,$before  . $termNow->name . $after);
						$cat_break_str = implode($pushPrintArr);
					}
					echo wp_kses_post($cat_break_str);
					
				}else{
					echo  wp_kses_post($before . $post_type_name . $after);
				}			  
			} elseif ( is_attachment() ) {
			
				if( (int)$post->post_parent > 0 ){
					$parent = get_post($post->post_parent);
					$cat = get_the_category($parent->ID);
					if( count($cat) > 0 ){
						$cat = $cat[0];
						echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					}
					echo '<a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
				}
				echo wp_kses_post($before . get_the_title() . $after);
			} elseif ( is_page() && !$post->post_parent ) {
				echo wp_kses_post($before . get_the_title() . $after);
	 
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_post($parent_id);
					$breadcrumbs[] = '<a href="' .  esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo wp_kses_post($crumb . ' ' . $delimiter . ' ');
				echo wp_kses_post($before . get_the_title() . $after);
	 
			} elseif ( is_tag() ) {
				echo wp_kses_post($before . esc_html__('Tagged "','wpgeneral') . single_tag_title('', false) . '"' . $after);
	 
			} elseif ( is_author() ) {
				 $author = TvlgiaoWpdanceClassNameVar::TVLGiao_wpdance_GetVar("author");
				$userdata = get_userdata($author);
				echo wp_kses_post($before . esc_html__('Articles posted by ','wpgeneral') . $userdata->display_name . $after);
	 
			} elseif ( is_404() ) {
				echo wp_kses_post($before . esc_html__('404','wpgeneral') . $after);
			}
	 
			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ) {
					echo wp_kses_post($before .' (');
					echo esc_html__('Page','wpgeneral') . ' ' . get_query_var('paged');
				}
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ) echo ')'. $after;
			} else{ 
				if ( get_query_var('page') ) {
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ) {
						echo wp_kses_post($before .' (');
						echo esc_html__('Page','wpgeneral') . ' ' . get_query_var('page');
					}
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ) echo ')'. $after;
				}
			}
			echo '</div>';
	 
		}

	} // end ew_breadcrumbs()  
}

if(!function_exists("tvlgiao_wpdance_wd_show_breadcrumbs")){
	function tvlgiao_wpdance_wd_show_breadcrumbs(){ ?>
		<div class="top-page">
			<?php tvlgiao_wpdance_dimox_breadcrumbs();?>
		</div>
<?php
	}
}


?>