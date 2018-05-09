<?php
/*
*	Template Name: One-Page Template
*/
get_header(); 
?>

<div id="fullpage" class="tvl-wd-header-slider <?php echo wp_is_mobile()? " disable_mobile":' enable_pc';?>">
	<?php
	if( have_posts() ) : the_post();
		get_template_part( 'content', 'onepage' );	
	endif;
	?>
</div>

<?php get_footer(); ?>