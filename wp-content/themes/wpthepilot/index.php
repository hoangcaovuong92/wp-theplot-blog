<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php 
	$page_title = '';
	if ( is_category() ) {
			$page_title .= "<h1 class=\"page-title heading-title archive-title catagory-title site-title\">";
			$page_title .= sprintf( __( 'Category : %s', 'wpdance' ), single_cat_title( '', false ) );
			$page_title .= "</h1>";
		}
		elseif ( is_search() ) {
			$page_title .= '<h1 class="search-title page-title heading-title site-title">';
			$page_title .= sprintf( __( 'Search Results for : %s', 'wpdance' ), get_search_query() );
			$page_title .= '</h1>';
			 
		}elseif ( is_day() ) {
			$page_title .= '<h1 class="page-title heading-title archive-title site-title">';
			$page_title .= sprintf( __( 'Day : %s', 'wpdance' ), get_the_date() );
			$page_title .= '</h1>';
		} elseif ( is_month() ) {
			$page_title .= '<h1 class="page-title heading-title archive-title  site-title">';
			$page_title .= sprintf( __( 'Month : %s', 'wpdance' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'wpdance' ) ) ); 
			$page_title .= '</h1>';
	 
		} elseif ( is_year() ) {
			$page_title .= '<h1 class="page-title heading-title archive-title site-title">';
			$page_title .= sprintf( __( 'Year : %s', 'wpdance' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wpdance' ) ) ); 
			$page_title .= '</h1>';
		} elseif ( is_single() && !is_attachment() ) {
			$page_title .= '<div class="ads-info">';
			$page_title .= '<h1 class="page-title heading-title post-title single-title site-title">';
			$page_title .= $_echo_out_string;
			$page_title .= '</h1>';
			$_home_button_text = get_option(THEME_SLUG.'_home_button_text','Learn More');
			$_home_button_link = get_option(THEME_SLUG.'promotion_button_uri','http://wpdance.com');					
			$page_title .= '<a class="read_more" href="'.$_home_button_link.'">'.$_home_button_text.'</a>';
			$page_title .= "</div>";
		} elseif ( is_page() ) {
			$page_title .= '<h1 class="page-title heading-title single-title site-title">';
			$page_title .= get_the_title();
			$page_title .= '</h1>';
		} elseif ( is_attachment() ) {
			$page_title .= '<h1 class="page-title heading-title attachment-title single-title site-title">';
			$page_title .= get_the_title();
			$page_title .= '</h1>';
		} elseif ( is_tag() ) {
			$page_title .= '<h1 class="page-title heading-title tag-title archive-title site-title">';
			$page_title .= sprintf( __( 'Tag : %s', 'wpdance' ), single_tag_title( '', false ) );
			$page_title .= '</h1>';
	 
		} elseif ( is_author() ) {	
			global $author;
			$userdata = get_userdata($author);
			$page_title .= '<h1 class="page-title heading-title author-title archive-title site-title">';
			$page_title .= sprintf( __( 'Author : %s', 'wpdance' ), $userdata->display_name );
			$page_title .= '</h1>';
	 
		} elseif ( is_404() ) {
			$page_title .= '<h1 class="page-title heading-title title-404 page-title site-title">';
			$page_title .= __( 'OOPS! FILE NOT FOUND', 'wpdance' );
			$page_title .= '</h1>';
		} elseif( is_archive() ){
			$page_title .= '<h1 class="page-title heading-title attachment-title single-title site-title">';
			$page_title .= __( 'Archive', 'wpdance' );
			$page_title .= '</h1>';
		}
	$brd_data = array(
		'has_breadcrumb'	=> ( !is_home() && !is_front_page() ),
		'has_page_title' 	=> ( !is_home() && !is_front_page() ),
		'title'				=> $page_title,
	);
	tvlgiao_wpdance_wd_printf_breadcrumb($brd_data);
?>
<div id="container" class="page-template archive-page">
	<div id="content" class="container" role="main">
		<div id="container-main" class="col-sm-24">
			<div class="main-content">
				<?php if ( have_posts() ) : ?>
				<?php get_template_part( 'content', get_post_format() );?>
				<?php global $wp_query;
					$total_pages = max( 1, $wp_query->max_num_pages );
					if( $total_pages>1 ){
				?>
					<div class="page_navi">
						<div class="nav-content"><?php ew_pagination();?></div>
					</div>
				<?php } ?>
				
				<?php else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );?>
				<?php endif;?>
				
				<?php wp_reset_query();?>
				
			</div>
		</div>
	</div>
</div>
	
<?php
get_footer();
