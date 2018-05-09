<?php
/**
 *	Template Name: Comming Soon 1
 */	 
 
get_header();
$feedburner_id= "WpComic-Manga";
$default_logo = get_template_directory_uri()."/images/logo_black.png";
?>
<div class="content-comingsoon-1">
<div id="wd-container" class="container blank-template content-wrapper">
	<div id="content-inner" class="row">	
		<div id="main-content" class="col-sm-24">
			<div class="entry-content">	
				<div class="logo heading-title"><a href="<?php   echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url($default_logo); ?>"  alt="<?php echo get_bloginfo('name');?>" title="<?php echo get_bloginfo('name');?>"/></a></div>
				<h3>We Are <span>Coming Soon</span> </h3>
				<?php
					// Start the Loop.
					if( have_posts() ) : the_post();
						get_template_part( 'content', 'page' );	
					endif;
				?>
				<div class="action">
					 <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back To Homepage</a>
				</div>
			</div>
		</div>
	</div>	
</div><!-- #container -->
</div>
<?php get_footer(); ?>
