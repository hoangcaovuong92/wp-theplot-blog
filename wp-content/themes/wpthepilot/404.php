<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage RoeDok
 * @since WD_Responsive
 */	
get_header(); 
$page_title = '<h1 class="heading-title page-title">'.get_the_title().'</h1>';

$brd_data = array(
		'has_breadcrumb'	=> 1,
		'has_page_title' 	=> ( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 ),
		'title'				=> $page_title,
);
tvlgiao_wpdance_wd_printf_breadcrumb($brd_data);
?>

	<div class="swapper-404 background-404">
		<div  class="content-wrapper container-404 container">
			<div id="content-inner" class="row">
					<div class="entry-content table-cell">
						
						<div>
							<h2 class="my-account-title"><?php esc_html_e('Page not found','wpdance') ?></h2>
							<div>
								<p>
									<?php _e( 'Oops! That page can not be found', 'wpdance');	?>
								</p>
								<p>
									<?php _e('It looks like nothing was found at this location. Maybe try to use a search?', 'wpdance' );?>
								</p>
								
							</div>
							<?php if(isset($tvlgiao_wpdance_wd_data['wd_page404_content'])) echo do_shortcode(stripslashes($tvlgiao_wpdance_wd_data['wd_page404_content']));?>
						</div>
					</div>
			</div><!-- #content -->
		</div><!-- #container -->
	</div><!--swapper-404-->
<?php get_footer(); ?>
