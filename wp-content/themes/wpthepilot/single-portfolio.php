<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage wp_glory
 * @since Wpdance Glory
 */

get_header();

$page_title  = '<h1 class="heading-title page-title">';
$page_title .= get_the_title();
$page_title .= '</h1>';
$brd_data = array(
	'has_breadcrumb'	=> true,
	'has_page_title' 	=> ( apply_filters( 'woocommerce_show_page_title', true ) ),
	'title'				=> $page_title,
);
global $tvlgiao_wpdance_wd_data;
	if( isset($tvlgiao_wpdance_wd_data) ){
		$style = 'style="background: url('.esc_url($tvlgiao_wpdance_wd_data['wd_bg_breadcrumbs']).');"';
	}
tvlgiao_wpdance_wd_printf_breadcrumb($brd_data,$style);
	
?>
	
	<div id="wd-container" class="blog-template content-wrapper content-area container">
		<div id="content-inner" class="row">
			<?php
				global $tvlgiao_wpdance_wd_data;
				$style         = get_post_meta($post->ID,'wd-portfolio-style',true);
				$_layout_config = explode("-",'0-1-0');
				$_left_sidebar = (int)$_layout_config[0];
				$_right_sidebar = (int)$_layout_config[2];
				$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );
			?>
			
			<div id="main-content" class="<?php echo esc_attr( $_main_class) ?>">	
				
				<div class="single-content <?php echo esc_attr($style);?>">
					<div class="image-thumb-content">
					<?php	
					$portfolio_slider = get_post_meta($post->ID,'_wd_slider',true);
					$portfolio_slider = unserialize($portfolio_slider);
					$checkbox         = get_post_meta($post->ID,'wd-portfolio-checkbox',true);
					
				if($checkbox =="image"):
					foreach( $portfolio_slider as $single_slider ): ?>
					<img  class="preview-img" src="<?php echo $single_slider['image_url'];?>" alt="<?php echo $single_slider['alt'];?>" title="<?php echo $single_slider['title'];?>">
					<?php	endforeach;					
				else :	?>
				<div class="wd-portfolio-slider">
					<ul class="port-slides">
						<?php foreach( $portfolio_slider as $slide ){ ?>	
						<?php $_thumb_uri = wp_get_attachment_image_src( $slide['thumb_id'], false );
							$_thumb_uri = $_thumb_uri[0];
							$_sub_thumb_uri = wp_get_attachment_image_src( $slide['thumb_id'], 'portfolio_image', false );
							$_sub_thumb_uri = $_sub_thumb_uri[0]; 
						?>
							<li data-thumb="<?php  echo esc_url($_sub_thumb_uri);//echo print_thumbnail($slide['image_url'],true,$post_title,124,68,'',false,true); ?>"><a href="<?php echo esc_url($slide['url']);?>"><img alt="<?php echo esc_html($slide['alt']);?>" class="opacity_0" src="<?php echo  esc_url($_thumb_uri);//echo print_thumbnail($slide['image_url'],true,$post_title,620,340,'',false,true); ?>"/></a></li>
							
						<?php } ?>
					</ul>				
				</div>
				<?php endif; ?>
					<?php	if(have_posts()) : while(have_posts()) : the_post(); 
						global $post,$tvlgiao_wpdance_wd_data;										
						?>
								<div class="custom_code">
									<?php if( isset($tvlgiao_wpdance_wd_data['wd_top_blog_code']) && $tvlgiao_wpdance_wd_data['wd_top_blog_code'] != 'null') echo stripslashes($tvlgiao_wpdance_wd_data['wd_top_blog_code']);?>
								</div>
							
							<?php if( 1||$data['wd_blog_details_thumbnail'] == 1 ) : ?>
									<div class="thumbnail">
										<?php 
											$video_url = get_post_meta( $post->ID, THEME_SLUG.'url_video', true);
											if( $video_url!= ''){
												echo get_embbed_video( $video_url, 280, 246 );
											}
											else{
												?>
												<div class="image">
													
													<?php 
														if ( has_post_thumbnail() ) {
															the_post_thumbnail('blog_single',array('class' => 'thumbnail-blog'));
															
														} 			
													?>	
														
												</div>
												<?php
											}
										?>	
									</div>
								<?php endif;?>
							</div>	
							<div class="detail-content-port">
							<div class="post-title">
								<h2 class="heading-title"><?php the_title(); ?></h2>								
								<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="wd-edit-link hidden-phone">', '</span>' ); ?>	
							</div>	
							
							<div <?php post_class("single-post");?>>
								
								<div class="post_inner">	
																										
									<div class="post-info-content">
										<div class="post-description"><?php the_content(); ?></div>
										
										<?php wp_link_pages(); ?>
										
									</div>
									<div class="wd-other-info">
									
										<?php $client =  get_post_meta( $post->ID, 'wd-portfolio-client', true); ?>
										<?php if(!empty($client)){ ?>
											<div class="wd-client">
												<span class="heading-title">Client:</span>
												<span class="client-name"><?php echo esc_html($client); ?></span>
											</div>
										<?php } ?>
										
										<?php $skills =  get_post_meta( $post->ID, 'wd-portfolio-agency', true); ?>
										<?php if(!empty($skills)){ ?>
											<div class="wd-skills">
												<span class="heading-title">Agency:</span>
												<span class="skills-content"><?php echo esc_html($skills); ?></span>
											</div>
										<?php } ?>
										    <div class="wd-date">
												<span class="heading-title">Date:</span>
												<span class="date-content"><?php echo get_the_date('M d Y'); ?></span>
											</div>
										<?php $url =  get_post_meta( $post->ID, 'wd-portfolio-url', true); ?>
										<?php if(!empty($url)){ ?>
											<div class="wd-url">
												<span class="heading-title">Website:</span>
												<span class="url-name"><?php echo esc_html($url); ?></span>
											</div>
										<?php } ?>
										
										<?php 
										
											$cat_post =  wp_get_post_terms(get_the_ID(),'wd-portfolio-category');										
											if(is_array($cat_post)){
												$categories = '';
												foreach($cat_post as $cat){
														$temp  = '<a href="'.get_term_link($cat->slug,$cat->taxonomy).'">'.$cat->name.'</a>'. ', ';
														$categories .= $temp ;
												}      
											}
											$categories = substr($categories,0,-2) .''  ;
											
											if ( $categories ){
											?>
												<div class="categories">
													<span class="cat-links">
														<?php printf( __( '<span class="%1$s heading-title">Categories:</span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories );?>
													</span>
												</div>
												<?php
											}
											
										?>									 										
														
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
							</div>				
						<?php						
						endwhile;
						endif;	
						wp_reset_postdata();
					?>	
				</div>
				</div>
				
			</div>
			
		</div>
	</div><!-- #primary -->
	<script type="text/javascript">
		jQuery(function() {
	if(jQuery('.wd-portfolio-slider ul').length > 0 ){
									window.setTimeout( function(){
										var li_width = 350;
										
										jQuery('.wd-portfolio-slider').each(function(i,value){
											jQuery(value).siblings('a.image.image-holder').hide();
											jQuery(value).show();											
											var control_prev =  jQuery('<div class="wd_portfolio_control_' + i +'"><a class="prev" id="wd_portfolio_prev_' + i + '" href="#">&lt;</a><a class="next" id="wd_portfolio_next_' + i + '" href="#" >&gt;</a> </div>');
											jQuery(value).append(control_prev);
											jQuery(value).children('ul.port-slides').carouFredSel({
												responsive: true
												,width	: li_width
												,scroll  : {
													items	: 1,
													duration        : 1000,       
													auto	: false,
													pauseOnHover    : true
												}
												,swipe	: { onMouse: false, onTouch: true }
												,auto    : false
												,items   : { 
													width		: li_width
													,height		: 'auto'					
												}
												,prev    : '#wd_portfolio_prev_' + i
												,next 	 : '#wd_portfolio_next_' + i
											});								
										});	
									},0);	
								}
		});
	</script>
<?php
get_footer();
