<?php 
get_header(); ?>
	
<?php 
	
	$page_title = '';
	if( true ) {
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
	}
	
	
	
	$brd_data = array(
		'has_breadcrumb'	=> ( !is_home() && !is_front_page() ),
		'has_page_title' 	=> true,
		'title'				=> $page_title,
	);
	tvlgiao_wpdance_wd_printf_breadcrumb($brd_data);
	
		$_left_sidebar = 0;
		$_right_sidebar = 1;
		$_main_class = 'col-sm-18';
		$_left_sidebar_name = '';
		$_right_sidebar_name = 'blog-right-widget-area';
		if( is_category() ){
			global $tvlgiao_wpdance_wd_data;
			$_layout_config = explode("-",$tvlgiao_wpdance_wd_data['wd_blog_layout']);
			
			$_left_sidebar = (int)$_layout_config[0];
			$_right_sidebar = (int)$_layout_config[2];
			$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );		
			$_left_sidebar_name = $tvlgiao_wpdance_wd_data['wd_blog_left_sidebar'];
			$_right_sidebar_name = $tvlgiao_wpdance_wd_data['wd_blog_right_sidebar'];
		}
	
	?>	
		
		<div id="container" class="page-template archive-page">
			<div id="content" class="container" role="main">
				
				<?php if( $_left_sidebar ): ?>
						<div id="left-content" class="col-sm-6">
							<div class="sidebar-content wd-sidebar">
								<?php
									if ( is_active_sidebar( $_left_sidebar_name ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( $_left_sidebar_name ); ?>
										</ul>
								<?php endif; ?>
							</div>
						</div>
					<?php wp_reset_postdata();?>
				<?php endif;?>
				
				<div id="container-main" class="<?php echo esc_attr($_main_class);?>">
					<div class="main-content">
								
						<?php	
							get_template_part( 'content-blog', get_post_format() ); 
						?>
						<?php global $wp_query;
							$total_pages = max( 1, $wp_query->max_num_pages );
							if( $total_pages>1 ){
						?>
							<div class="page_navi">
								<!--div class="nav-previous"><?php previous_posts_link( __( 'Prev Entries', 'wpdance' ) ); ?></div-->
								<div class="nav-content"><?php ew_pagination();?></div>
								<!--div class="nav-next"><?php next_posts_link( __( 'Next Entries', 'wpdance' ) ); ?></div-->
							</div>
						<?php } ?>
					<?php wp_reset_postdata();?>
	
					</div>
				</div><!-- end content -->
				
				
				<?php if( $_right_sidebar ): ?>
					<div id="right-content" class="col-sm-6">
						<div class="sidebar-content wd-sidebar">
						<?php
							if ( is_active_sidebar( $_right_sidebar_name ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( $_right_sidebar_name ); ?>
								</ul>
						<?php endif; ?>
						</div>
					</div>
					<?php wp_reset_postdata();?>
				<?php endif;?>
			
			</div><!-- #content -->
		</div><!-- #container -->
		
<?php get_footer(); ?>