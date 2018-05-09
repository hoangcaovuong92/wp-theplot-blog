<?php
/*
*	Template Name: Archive Template
*/
get_header(); 
global $page_datas,$post;
?>
<?php
if(isset($page_datas['page_slider']) && $page_datas['page_slider'] != 'none'):
?>
<div class="slideshow-wrapper main-slideshow <?php echo strcmp($page_datas['main_slider_layout'],'wide') == 0 ? "wd_wide" : "wd_box"; ?>">
	<div class="slideshow-sub-wrapper <?php echo strcmp($page_datas['main_slider_layout'],'wide') == 0 ? "wide-wrapper" : "col-sm-24"; ?>">
		<?php show_page_slider();?>
	</div>
</div>
<?php
endif;
?>

<?php 
	
	$page_title  = '<h1 class="heading-title page-title">';
	$page_title .= get_the_title();
	$page_title .= '</h1>';
	$brd_data = array(
		'has_breadcrumb'	=> (isset($page_datas['hide_breadcrumb']) && absint($page_datas['hide_breadcrumb']) == 0),
		'has_page_title' 	=> ( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 ),
		'title'				=> $page_title,
	);
	tvlgiao_wpdance_wd_printf_breadcrumb($brd_data);
	
	?>
	
<?php
	global $page_datas;
	//show_page_slider();
	$_layout_config = explode("-",$page_datas['page_column']);
	$_left_sidebar = (int)$_layout_config[0];
	$_right_sidebar = (int)$_layout_config[2];
	$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );		
?>
	<div id="wd-container" class="content-wrapper page-template container">
		<div id="content-inner" class="row">
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
			<div id="main-content" class="<?php echo esc_attr($_main_class);?> container">
				<div class="archive-content entry-content">
					<div class="gama">		
						<div class='col-sm-24'>
							<div class="alpha omega"><?php the_content();?></div>
						</div>				
						<div class="col-sm-12">
							<div class="alpha">
								<h4 class="heading-title"><?php _e('The Latest 30 Posts', 'wpdance'); ?></h4>
								<ul class="sitemap-archive">
									<?php query_posts( 'posts_per_page=30' ); ?>
									<?php while ( have_posts() ) { the_post(); ?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php the_time('Y.m.d'); ?> - <?php _e( 'Comments', 'wpdance' ); ?> (<?php echo esc_html($post->comment_count); ?>)</li>
									<?php } ?>            
								</ul><!-- Latest Posts -->
							</div>
						</div>
										
						<div class="col-sm-6">
							<div class="alpha">
								<h4 class="heading-title"><?php _e('Categories', 'wpdance'); ?></h4>
								<ul class='sitemap-archive'>
									<?php wp_list_categories('title_li=&show_count=true'); ?>
								</ul>
							</div>
						</div><!-- Categories -->
										
						<div class="col-sm-6">
							<div class="alpha">
								<h4 class="heading-title"><?php _e('Monthly Archives', 'wpdance'); ?></h4>
								<ul class='sitemap-archive'>
									<?php wp_get_archives('type=monthly&show_post_count=true'); ?>
								</ul>
							</div>
						</div><!-- Monthly Archives -->
					</div>		
				</div>
			</div>
			
			
		</div>
	</div>


<?php get_footer(); ?>
