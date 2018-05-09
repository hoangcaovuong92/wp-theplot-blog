<?php
	global $tvlgiao_wpdance_wd_data;
?>
<div class="related_post related">
	<div class="title"><h3><strong><?php echo stripslashes(esc_attr($tvlgiao_wpdance_wd_data['wd_blog_details_relatedlabel'])); ?></strong></h3></div>	
	<div class="related_post_slider wd-loading">
		<div class="slides grid-posts">
		<?php
			$gallery_ids = array();
			$galleries = wp_get_post_terms($post->ID,'gallery');
			if(!is_array($galleries))
				$galleries = array();
			foreach($galleries as $gallery){
				if( $gallery->count > 0 ){
					array_push( $gallery_ids,$gallery->term_id );
				}	
			}
			if(!empty($galleries) && count($gallery_ids) > 0 )
				$args = array(
					'post_type'=>$post->post_type,
						'tax_query' => array(
						array(
							'taxonomy' => 'gallery',
							'field' => 'id',
							'terms' => $gallery_ids
						)
					),
					'post__not_in'=>array($post->ID),
					'posts_per_page'=> get_option('posts_per_page'),//get_option(THEME_SLUG.'num_post_related', 10)
				);
			else
				$args = array(
				'post_type'=>$post->post_type,
				'post__not_in'=>array($post->ID),
				'posts_per_page'=> get_option('posts_per_page'),//get_option(THEME_SLUG.'num_post_related', 10)
			);
			wp_reset_postdata();
			$related=new wp_query($args);$cout=0;
	$i = 0;		
	if($related->have_posts()) : 
	
	while($related->have_posts()) :
		$related->the_post(); global $post;global $wp_query;
	?>
		<div class="item <?php if( $i == 0 ) echo ' first';?><?php if( $i == $related->post_count-1) echo ' last';?>">
					
			<div class="item-content">
				<div class="post-info-thumbnail display-flex ">
					<a class="thumbnail effect_color" href="<?php the_permalink(); ?>">
						<?php 
							$post_thumbnail_type = "blog_shortcode_auto";
							the_post_thumbnail( $post_thumbnail_type,array('class' => 'thumbnail-effect-1') );
						?>
									<!--div class="effect_hover_image"></div-->
					</a>
				</div>
				<div class="meta-post post-info-content">
					<h3 class="heading-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="wpt_title" title="<?php echo esc_attr(get_the_title($post->ID));?>" ><?php echo get_the_title($post->ID); ?></a></h3>					
					<div class="post-info-meta-top post-info-meta">
						<?php if( $tvlgiao_wpdance_wd_data['wd_blog_time'] == 1 ) : ?>
						<div class="entry-date"><?php echo get_the_date('F d, Y') ?></div>
						<?php endif;?>		
						<span class="author">
							<i class="fa fa-user"></i><?php //_e('Post by','wpdance')?><?php the_author_posts_link(); ?>
						</span>				
					</div>	
					<?php if( $tvlgiao_wpdance_wd_data['wd_blog_excerpt'] == 1 ) : ?>
					<p class="excerpt"><?php 
						the_excerpt_max_words(15,$post); ?>
					</p>
					<?php endif;?>		
				</div>	
			</div>
		</div>
	<?php 	$i++;
	endwhile;
	endif;	
			
			
			wp_reset_postdata();
		?>
		</div>
		
	</div>
</div>

				<script type='text/javascript'>
					//<![CDATA[
						jQuery(document).ready(function() {
							"use strict";
							var temp_visible = 4;
							
							var row = 1;
							var item_width = 350;
							
							var show_nav = true;
							var prev,next,pagination;

							var show_icon_nav = false;
							
							var object_selector = ".related_post_slider .slides";
							var autoplay = false;
                            //generate_horizontal_slide(temp_visible,row,item_width,show_nav,show_icon_nav,autoplay,object_selector, [1,2,2,2,3]);
							
							var $_this = jQuery('.related_post_slider');
							var owl = $_this.find('.slides').owlCarousel({
								item : temp_visible
								,loop : false
								,nav : true
								,dots : false
								,navText		: [ '<', '>' ]
								,lazyload		:true
								,responsiveBaseElement: $_this
								,responsive		:{
									0:{
										items:1
									},
									480:{
										items:2
									},
									768:{
										items: 3
									},
									992:{
										items: 3
									},
									1200:{
										items: temp_visible
									}
								}
								,onInitialized: function(){
									$_this.addClass('wd-loaded').removeClass('wd-loading');
								}
								
							});
							
							
							
						});
					//]]>	
					</script>