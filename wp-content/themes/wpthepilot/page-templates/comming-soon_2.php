<?php
/**
 *	Template Name: Comming Soon 2
 */	
 
get_header();
$feedburner_id= "WpComic-Manga";
?>
<div class="content-comingsoon-2">
<div id="wd-container" class="blank-template content-wrapper">
	<div id="content-inner" class="row">	
		<div id="main-content" class="col-sm-24">
			<div class="entry-content">	
				<?php tvlgiao_wpdance_theme_logo();?>
				<h3>We Are Coming Soon </h3>
				<?php
					// Start the Loop.
					if( have_posts() ) : the_post();
						get_template_part( 'content', 'page' );	
					endif;
				?>
			<div class="commingsoon_newsletter">
				<div>
					<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr($feedburner_id);?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
					<p class="subscribe-email"><input type="text" name="email" class="subscribe_email" placeholder="<?php _e('enter your email address','wpdance');?>" /></p>
					<input type="hidden" value="<?php echo esc_attr($feedburner_id);?>" name="uri"/>
					<input type="hidden" value="<?php echo esc_attr(get_bloginfo( 'name' ));?>" name="title"/>
					<input type="hidden" name="loc" value="en_US"/>
					<button class="button" type="submit" title="Subscribe"><span><span>Subscribe</span></span></button>
					<p style="display:none;">Delivered by <a href="<?php echo "http://www.feedburner.com"; ?>" target="_blank">FeedBurner</a></p>
				</form>
				</div>
			</div><!-- end #footer-first-area -->
			<div class="social_sharing wd-social share-list" style="margin-bottom: 0px">	
				<div class="social_icon">					
					<div class="facebook" style="margin-bottom: 0px">
						<a class="social_item" title="<?php _e("share on facebook", 'wpdance')?>" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_permalink());?>"><i class="fa fa-facebook"></i></a>
					</div>
					
					<div class="twitter" style="margin-bottom: 0px">
						<a class="social_item" title="<?php _e("Tweet on Twitter", 'wpdance')?>" href="https://twitter.com/home?status=<?php echo esc_url(get_permalink());?>"><i class="fa fa-twitter"></i></a>
					</div>
					
					<div class="google" style="margin-bottom: 0px">
						<a class="social_item" title="<?php _e("share on Google +", 'wpdance')?>" href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink());?>"><i class="fa fa-google-plus"></i></a>
					</div>
					
					<div class="pinterest" style="margin-bottom: 0px">
						<?php $image_link  = wp_get_attachment_url( get_post_thumbnail_id() );?>
						<a class="social_item" title="<?php _e("Pin it", 'wpdance')?>" href="<?php echo esc_url("https://pinterest.com/pin/create/button/?url=" . get_permalink() . '&media=' . $image_link );?>"><i class="fa fa-pinterest"></i></a>
					</div>
					
					<script type="text/javascript">
						jQuery(document).ready(function(){
							"use strict";
							jQuery('.social_icon .social_item').click(function(){
								var url = jQuery(this).attr('href');
								var title = jQuery(this).attr('title');
								window.open(url, title,"width=700, height=520");
								return false;
							});
						});
					</script>
					
					
				</div>            
			</div>
			</div>
		</div>
		<div class="action">
			 <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back To Homepage</a>
		</div>
	</div>	
</div><!-- #container -->
</div>
<?php get_footer(); ?>