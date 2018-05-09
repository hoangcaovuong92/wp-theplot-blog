<?php
/*
*	Template Name: Sitemap Template
*/
get_header(); ?>

<?php global $page_datas;?>

	<?php 
	
	$page_title  = '<h1 class="heading-title page-title">';
	$page_title .= get_the_title();
	$page_title .= '</h1>';
	$brd_data = array(
		'has_breadcrumb'	=> (isset($page_datas['hide_breadcrumb']) && absint($page_datas['hide_breadcrumb']) == 0),
		'has_page_title' 	=> ( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 ),
		'title'				=> $page_title,
	);
	global $tvlgiao_wpdance_wd_data;
	if( isset($tvlgiao_wpdance_wd_data) ){
		$style = 'style="background: url('.esc_url($tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs']).');"';
	}
	tvlgiao_wpdance_wd_printf_breadcrumb($brd_data,$style);
	
	?>

		<div id="wd-container" class="content-wrapper page-template container">
			<div id="content-inner" class="row" role="main">
				<div class="col-main" id="main-content">
					<div class="sitemap-content entry-content">
						<div class="col-sm-24">
								<?php the_content();?>
						</div>
						<!--Page-->
						<div class="col-sm-6">  
							<h3 class="heading-title"><?php _e( 'Pages', 'wpdance' ); ?></h3>
							<ul class='sitemap-archive'>
								<?php wp_list_pages( 'depth=0&sort_column=menu_order&title_li=' ); ?>
							</ul>
						</div>
		
						<!--Categories-->
						<div class="col-sm-6">
							<h3 class="heading-title"><?php _e('Categories', 'wpdance'); ?></h3>
							<ul class='sitemap-archive wp-categories'>
								<?php 
								wp_reset_postdata();	
								wp_list_categories('title_li=&show_count=true'); ?>
							</ul>
						</div>
						
						<!--Posts per category-->
						<div class="col-sm-12">
							<h3 class="heading-title"><?php _e( 'Posts per category', 'wpdance' ); ?></h3>
							<?php
					
								$cats = get_categories();
								foreach ( $cats as $cat ) {
									$args = array(
									'cat' =>  $cat->cat_ID,									
									);
									 $the_query = new WP_Query( $args );
							?>
							<ul class='sitemap-archive' >
							<li class="cat-item"><strong class="text-uppercase"><?php echo esc_attr($cat->cat_name); ?></strong>
							<ul class="children">
								<?php while (  $the_query->have_posts() ) {  $the_query->the_post(); ?>
								 <li><a href="<?php esc_url(the_permalink()); ?>"><?php esc_attr(the_title()); ?></a> - <?php _e( 'Comments', 'wpdance' ); ?> (<?php echo esc_attr($post->comment_count); ?>)</li>
								 <?php }  ?>
							</ul></li>
							</ul>
							<?php } ?>
						</div>			
					</div>
				</div>
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_footer(); ?>