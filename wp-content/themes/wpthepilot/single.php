<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage wp_glory
 * @since Wpdance Glory
 */

get_header(); ?>
	<?php 
	
	$blog_gallery = get_post_meta( get_the_ID(), THEME_SLUG.'post_thumb_shortcode', true )? get_post_meta(get_the_ID(), THEME_SLUG.'post_thumb_shortcode', true): false;
	
	$_post_config = get_post_meta($post->ID,THEME_SLUG.'custom_post_config',true);
	if( strlen($_post_config) > 0 ){
		$_post_config = unserialize($_post_config);
	}
	
	$thumbnail_url = '';
	if($blog_gallery && $blog_gallery=='breadcrumb' && has_post_thumbnail()) {
		$thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	}
	
	$page_title  = '<h1 class="heading-title page-title">';
	$page_title .= get_the_title();
	$page_title .= '</h1>';
	$brd_data = array(
		'has_breadcrumb'	=> true,
		'has_page_title' 	=> ( apply_filters( 'woocommerce_show_page_title', true ) ),
		'title'				=> $page_title,
		'backg_url'			=> $thumbnail_url,
		'type'				=> 'postdetail'
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
				
				$_layout_config = explode("-",$tvlgiao_wpdance_wd_data['wd_post_layout']);
				//$_layout_config = explode("-", '0-1-0');
				$_left_sidebar = (int)$_layout_config[0];
				$_right_sidebar = (int)$_layout_config[2];
				$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );
			?>
			
			<?php if( $_left_sidebar ): ?>
			<div id="left-content" class="col-sm-6">
				<div class="sidebar-content wd-sidebar">
				<?php
					if ( is_active_sidebar($tvlgiao_wpdance_wd_data['wd_post_left_sidebar']) ) : ?>
						<ul class="xoxo">
							<?php dynamic_sidebar($tvlgiao_wpdance_wd_data['wd_post_left_sidebar']); ?>
						</ul>
				<?php endif; ?>
				</div>
			</div><!-- end left sidebar -->
			<?php endif; ?>
			
			<div id="main-content" class="<?php echo esc_attr( $_main_class )?>">	
				
				<div class="single-content">
					<?php	
						if(have_posts()) : while(have_posts()) : the_post(); 
						global $post,$tvlgiao_wpdance_wd_data;										
						?>
								<?php if( isset($tvlgiao_wpdance_wd_data['wd_top_blog_code']) && $tvlgiao_wpdance_wd_data['wd_top_blog_code'] != ''):?>
								<div class="custom_code">
									<?php echo stripslashes($tvlgiao_wpdance_wd_data['wd_top_blog_code']);?>
								</div>
								<?php endif;?>
							<?php if( $tvlgiao_wpdance_wd_data['wd_blog_details_thumbnail'] == 1 ) : ?>
									<div class="thumbnail">
										<?php 
											
											if( isset($_post_config['post_type']) && $_post_config['post_type'] == 'video' && isset($_post_config['video_url'])){
											?><div class="wd-audio-post" style="margin-bottom: 20px;"><?php 
												echo wd_get_embbed_video( $_post_config['video_url'], $_post_config['video_width'], $_post_config['video_height'] );
											?></div><?php 
											}
											elseif( isset($_post_config['post_type']) && $_post_config['post_type'] == 'audio' && (isset($_post_config['audio_mp3']) || isset($_post_config['audio_ogg']) || isset($_post_config['audio_wav']))){
											?><div class="wd-audio-post" style="max-width: 420px; margin-bottom: 20px;"><?php 
												$audio_ops = array(
													'preload'	=> 'none'
												);
												if(isset($_post_config['audio_mp3']) && $_post_config['audio_mp3'])
													$audio_ops['mp3'] = $_post_config['audio_mp3'];
												if(isset($_post_config['audio_wav']) && $_post_config['audio_wav'])
													$audio_ops['wav'] = $_post_config['audio_wav'];
												if(isset($_post_config['audio_ogg']) && $_post_config['audio_ogg'])
													$audio_ops['ogg'] = $_post_config['audio_ogg'];
												
												echo wp_audio_shortcode($audio_ops);
												
											?></div><?php 
											} else{
												if($blog_gallery) {
													if($blog_gallery !=='breadcrumb') echo do_shortcode($blog_gallery);
												} elseif ( has_post_thumbnail() ) {
												?>
												<div class="image">
													<?php 

														if ( has_post_thumbnail() ) {
															the_post_thumbnail('blog_single',array('class' => 'thumbnail-blog'));
															
														} 			
													?>	
												</div>
												<div class="entry-date body_color">
													<p class="month"><?php echo get_the_date('M') ?></p>
													<p class="day"><?php echo get_the_date('d') ?></p>
												</div>
												<?php 
												}
												
											}
										?>	
									</div>
								<?php endif;?>
							<div class="post-title">
							<h2 class="heading-title"><?php the_title(); ?></h2>								 
								<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="wd-edit-link hidden-phone">', '</span>' ); ?>	
							</div>	
							
							<div <?php post_class("single-post");?>>
								
								
								<div class="post_inner">	
									<div class="author">
										<?php _e('Post by','wpdance')?><?php the_author_posts_link(); ?>
									</div>
									<div class="post-info-meta-top post-info-meta">									
										<?php 
										if(isset($tvlgiao_wpdance_wd_data['wd_blog_details_comment']) && absint($tvlgiao_wpdance_wd_data['wd_blog_details_comment']) == 1) {
											$time_class = " delimiter";
											$author_class = " delimiter";
										} else {
											$author_class = "";
											if(isset($tvlgiao_wpdance_wd_data['wd_blog_details_author']) && absint($tvlgiao_wpdance_wd_data['wd_blog_details_author']) == 1) {
												$time_class = "";
											}
										}
										
										 if( absint($tvlgiao_wpdance_wd_data['wd_blog_details_comment']) == 1 ) : ?>
											<div class="comments-count"><i class="fa fa-comments"></i><?php $comments_count = wp_count_comments($post->ID);
											if(absint($comments_count->approved) == 0) echo absint($comments_count->approved) . ' ' . __('Comment', 'wpdance');
											else echo absint($comments_count->approved) . ' ' . _n( "Comment", "Comments", absint($comments_count->approved), 'wpdance');?></div>
										<?php endif; 
										if( isset($tvlgiao_wpdance_wd_data['wd_blog_details_time']) && absint($tvlgiao_wpdance_wd_data['wd_blog_details_time']) == 1 ) : ?>			
											<div class="entry-date<?php echo esc_attr($author_class);?>"><?php echo get_the_date('F d, Y') ?></div>
										<?php endif; ?>
										
								
									</div>
									
								
									
									<div class="post-info-content">
										<div class="post-description"><?php the_content(); ?></div>
										
										<?php wp_link_pages(); ?>
										
									</div>
									
								<!--Category List-->
									<?php if( $tvlgiao_wpdance_wd_data['wd_blog_details_categories'] == 1 ) : ?>
										<?php if ( is_object_in_taxonomy( get_post_type(), 'category' ) ) : // Hide category text when not supported ?>
										<?php
											/* translators: used between list items, there is a space after the comma */
											$categories_list = get_the_category_list( __( ', ', 'wpdance' ) );
												if ( $categories_list ):
											?>
											<div class="categories">
												<span class="cat-links">
													<?php printf( __( '<span class="%1$s heading-title">Categories:</span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );?>
												</span>
											</div>
											<?php endif; // End if categories ?>
										<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'category' ) ?>	
									
									<?php endif;?>	
									
									<?php if( (isset($tvlgiao_wpdance_wd_data['wd_blog_details_tags']) && absint($tvlgiao_wpdance_wd_data['wd_blog_details_tags']) == 1) || (isset($tvlgiao_wpdance_wd_data['wd_blog_details_socialsharing']) && absint($tvlgiao_wpdance_wd_data['wd_blog_details_socialsharing']) == 1) ) : ?>
										<?php if ( is_object_in_taxonomy( get_post_type(), 'post_tag' ) ) : // Hide tag text when not supported ?>
										<?php
											/* translators: used between list items, there is a space after the comma */
											$tags_list = get_the_tag_list('',', ','');
											 
											if ( $tags_list ):
											?>
												<div class="tags">
													<?php if(isset($tvlgiao_wpdance_wd_data['wd_blog_details_tags']) && absint($tvlgiao_wpdance_wd_data['wd_blog_details_tags']) == 1):?>
													<span class="tag-title"><?php _e('Tags:','wpdance');?></span>
													<span class="tag-links">
														<?php //_e( '<span class="entry-utility-prep entry-utility-prep-tag-links"></span>'.$tags_list, 'wpdance' );  ?>
														<?php printf( __( '%s', 'wpdance' ), $tags_list );
														$show_sep = true; ?>
													</span>
													<?php endif;?>
																										
												</div>
											<?php endif; // End if $tags_list ?>
										<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'post_tag' ) ?>
									<?php endif; ?>
											
								</div>
								<div class="post-info-meta-bottom">	
									<?php if( isset($tvlgiao_wpdance_wd_data['wd_blog_details_socialsharing']) && absint($tvlgiao_wpdance_wd_data['wd_blog_details_socialsharing']) == 1 ) : ?>
														
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
														
									<?php endif;?>
																				
								</div>
								<div class="navi">
									<div class="navi-prev"><?php previous_post_link('%link', 'Previous Post'); ?> </div>
									<div class="navi-next"><?php next_post_link('%link', 'Next Post'); ?></div>
								</div>
							</div>
																																	
								<?php if( isset($tvlgiao_wpdance_wd_data['wd_blog_details_commentlist']) && absint($tvlgiao_wpdance_wd_data['wd_blog_details_commentlist']) ): ?>
								<?php comments_template( '', true );?>
								<?php endif;?>
								<div class="custom-bottom-code">
								<?php if( isset($tvlgiao_wpdance_wd_data['wd_bottom_blog_code']) && $tvlgiao_wpdance_wd_data['wd_bottom_blog_code'] != 'null') echo stripslashes($tvlgiao_wpdance_wd_data['wd_bottom_blog_code']);?>	
								</div>
							
						<?php						
						endwhile;
						endif;	
						wp_reset_postdata();
					?>	
				</div>
				
			</div>
			
			<?php if( $_right_sidebar  ): ?>
					<div id="right-content" class="col-sm-6">
						<div class="sidebar-content wd-sidebar">
						<?php
							if ( is_active_sidebar( $tvlgiao_wpdance_wd_data['wd_post_right_sidebar']) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( $tvlgiao_wpdance_wd_data['wd_post_right_sidebar'] ); ?>
								</ul>
						<?php endif; ?>
						</div>
					</div><!-- end right sidebar -->
		<?php endif;?>
			
		</div>
	</div><!-- #primary -->

<?php
get_footer();
