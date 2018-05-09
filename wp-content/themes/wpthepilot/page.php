<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage wp_glory
 * @since Wpdance Glory
 */

get_header();
global $page_datas,$post;
$page_title = '<h1 class="heading-title page-title">'.get_the_title().'</h1>';

$brd_data = array(
		'has_breadcrumb'	=> (isset($page_datas['hide_breadcrumb']) && absint($page_datas['hide_breadcrumb']) == 0),
		'has_page_title' 	=> ( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 ),
		'title'				=> $page_title,
);
tvlgiao_wpdance_wd_printf_breadcrumb($brd_data);

?>
<?php

	$_layout_config = explode("-",$page_datas['page_column']);
	$_left_sidebar = (int)$_layout_config[0];
	$_right_sidebar = (int)$_layout_config[2];
	$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );	
	$slideshow_show = (!is_page() || (!isset($page_datas['toggle_vertical_menu']) || absint($page_datas['toggle_vertical_menu']) == 1 ) )? false: true;
?>

<div id="wd-container" class="content-wrapper page-template container">
	
	<div id="content-inner" class="row">
		<div class="header-static-slideshow">
			<div class="row">
				<div class="col-sm-6 col-xs-12 wd-space"></div>					
					<?php
					  if($slideshow_show):
							if ( is_active_sidebar( 'shop-right-widget-area' ) ) : ?>
							<div class="customer_choice col-sm-6 col-xs-12">
							<div class="wp_box">
								<ul class="xoxo">
									<?php dynamic_sidebar( 'shop-right-widget-area' ); ?>
								</ul>
							</div>	
							</div>	
						<?php endif;
                    endif;?>
			</div>
	    </div>
		<?php if( $_left_sidebar ): ?>
			<div id="left-content" class="col-sm-6">
				<div class="sidebar-content wd-sidebar">
					<?php
						if ( is_active_sidebar( $page_datas['left_sidebar'] ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( $page_datas['left_sidebar'] ); ?>
							</ul>
					<?php endif; ?>
				</div>
			</div><!-- end left sidebar -->		
			<?php wp_reset_postdata();?>
		<?php endif;?>	
		<div id="main-content" class="<?php echo esc_attr($_main_class);?>">
			<?php
				// Start the Loop.
				if( have_posts() ) : the_post();
					get_template_part( 'content', 'page' );	
				endif;
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
		</div><!-- end content -->
		<?php if( $_right_sidebar ): ?>
			<div id="right-content" class="col-sm-6">
				<div class="sidebar-content wd-sidebar">
				<?php
					if ( is_active_sidebar( $page_datas['right_sidebar'] ) ) : ?>
						<ul class="xoxo">
							<?php dynamic_sidebar( $page_datas['right_sidebar'] ); ?>
						</ul>
				<?php endif; ?>
				</div>
			</div><!-- end right sidebar -->
			<?php wp_reset_postdata();?>
		<?php endif;?>
	</div><!-- end container -->
</div><!-- #main-content -->

<?php
get_footer();
