<?php global $tvlgiao_wpdance_wd_data, $page_datas;
?>

<div class="wd-sticky animated" id="wd-sticky">
	<div class="header-middle hidden-xs" style="float: none;">
		<div class="header-middle-content">
			<div class="container">
				<div class="row">
				<div class="header-middle-inner">
					<div class="header-middle-left col-sm-6">
					<?php tvlgiao_wpdance_theme_logo();?>
					</div>
					<div class="nav wd_mega_menu_wrapper">
						<?php 
							if ( function_exists( 'ubermenu' ) && has_nav_menu( 'primary' )): 
						      ubermenu( 'main',array('theme_location'=>'primary') );
							 else:
							 wp_nav_menu( array( 'menu_class' => 'sf-menu') );
							 endif;
						?>
					</div>
					<div class="clear"></div>
				</div>
				</div>
			</div>
		</div>
	</div><!-- end .header-middle -->	
	<?php wp_reset_postdata();?>

	
	
</div><!-- #wd-sticky -->

