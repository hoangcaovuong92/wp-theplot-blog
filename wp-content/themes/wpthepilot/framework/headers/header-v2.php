<?php global $tvlgiao_wpdance_wd_data, $page_datas;
$logo =  get_template_directory_uri()."/images/logo_black.png";
if($tvlgiao_wpdance_wd_data['wd_header_style']== 'v2')
	$logo = esc_url($tvlgiao_wpdance_wd_data['wd_logo']);
?>
<div id="sticket-scroll-header-point"></div>
<div class="wd-sticky animated" id="wd-sticky">
	<div id="header" class="header-top hidden-xs header_v2 animated">
		<div class="header-top-content">
			<div class="row">					
				<div class="header-wrapper">					
					<div class="header-top-left-area col-sm-15">
						<?php 
							if ( function_exists( 'ubermenu' ) && has_nav_menu( 'primary' )): 
							  ubermenu( 'main',array('theme_location'=>'primary') );
							 else:
							 wp_nav_menu( array( 'menu_class' => 'sf-menu') );
							 endif;
						?>
					</div>					
					<div class="header-top-right-area col-sm-9">					
						<?php if ( is_active_sidebar( 'wd-header-top-wider-area-right2' )): ?>
						<div class="header-top-custom-sidebar hidden-xs">
							<ul class="xoxo">
								<?php dynamic_sidebar( 'wd-header-top-wider-area-right2' ); ?>
							</ul>
						</div>
						<?php endif; ?>		
						<div class="wd-header-search-control" style="position: relative;">
							<div class="wd-search-box"><?php wd_get_search_form(); ?></div>
						</div>							
					</div>				
				</div>
			</div>
		</div>
		<div class="logo heading-title">
		<?php if( strlen( trim($logo) ) > 0 ){?>
				<a href="<?php  echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url($logo);?>" alt="<?php  get_bloginfo('name');?>" title="<?php get_bloginfo('name');?>"/></a>	
		<?php } ?>
		</div>
	</div>
	<?php wp_reset_postdata();?>

	
	
</div><!-- #wd-sticky -->
<script type="text/javascript">			
			<?php 
				global $tvlgiao_wpdance_wd_data;
				
			?>
			var _enable_sticky_menu = <?php echo absint($tvlgiao_wpdance_wd_data['wd_sticky_menu']); ?>;
			jQuery('.menu li').each(function(){
				if(jQuery(this).children('.sub-menu').length > 0) jQuery(this).addClass('parent');
			});
		</script>
