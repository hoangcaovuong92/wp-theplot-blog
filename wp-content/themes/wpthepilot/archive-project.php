<?php 
get_header(); ?>

<?php 
	$page_title  = "<h1 class=\"page-title heading-title archive-title catagory-title site-title\">";
	$page_title .= __("Projects", 'wpdance');
	$page_title .= "</h1>";
	$brd_data = array(
		'has_breadcrumb'	=> true,
		'has_page_title' 	=> ( apply_filters( 'woocommerce_show_page_title', true ) ),
		'title'				=> $page_title,
	);
	tvlgiao_wpdance_wd_printf_breadcrumb($brd_data);
	
	?>
		
		<div id="container" class="page-template archive-page">
			<div id="content" class="container" role="main">
				
				<div id="container-main">
					<div class="main-content">
								
						<?php	
							get_template_part( 'content', get_post_format() );
						?>
						
						<?php global $wp_query;
							$total_pages = max( 1, $wp_query->max_num_pages );
							if( $total_pages>1 ){
						?>
							<div class="page_navi">
								
								<div class="nav-content"><?php ew_pagination();?></div>
								
							</div>
						<?php } ?>
					<?php wp_reset_postdata();?>
	
					</div>
				</div><!-- end content -->
					
				<?php wp_reset_postdata();?>
			
			</div><!-- #content -->
		</div><!-- #container -->
		
<?php get_footer(); ?>