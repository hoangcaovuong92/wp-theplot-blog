<?php 


add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax_blog'); 
add_action('wp_ajax_more_post_ajax', 'more_post_ajax_blog');

function more_post_ajax_blog(){ 
		global $tvlgiao_wpdance_wd_data;
		$i=0;
	
		$columns =  3;	
		$span_class = "col-lg-".(24/$columns);
		$span_class .= ' col-md-'.(24/ round( $columns * 992 / 1200));
		$span_class .= ' col-sm-'.(24/round( $columns * 768 / 1200));
		$span_class .= ' col-xs-'.(24/2);
		
		
		$span_class .= ' col-mb-12';
		$offset = $_POST["offset"];
		$ppp = $_POST["ppp"];
		header("Content-Type: text/html");

		$args2 = array(
			'posts_per_page' => $ppp,
			'offset' => $offset-1,
		);
		$id_widget = 'list-posts';
		$custom2 = new WP_Query($args2);
		$num_count = $custom2->post_count;
		if($custom2->have_posts()):			
		while ($custom2->have_posts()) : $custom2->the_post(); 
		   $_post_config = get_post_meta($custom2->post->ID,THEME_SLUG.'custom_post_config',true);
		   if( strlen($_post_config) > 0 ){
			$_post_config = unserialize($_post_config);
		     } ?>
		<div class="item isotope-item <?php echo esc_attr($span_class); ?><?php if( $i == 0 || $i % $columns == 0 ) echo ' first';?><?php if( $i == $num_count-1 || $i % $columns == $columns-1 ) echo ' last';?>"> 
		<div class="item-content">
			<div class="post-info-thumbnail">
				<div class="post-icon-box">
			<?php if(isset($_post_config['post_type'])):?>
						<?php 
							switch($_post_config['post_type']){
								case 'video':
									if(strlen(trim($_post_config['video_url'])) > 0){
										$video_url = trim($_post_config['video_url']);
											if (!empty($video_url)) {
												
												echo wd_get_embbed_video( $video_url, 1200, 240 );
											}
										}
										break;
									case 'audio':
										if(( isset($_post_config['audio_soundcloud']) || isset($_post_config['audio_mp3']))  )
										{											
											if (isset($_post_config['audio_soundcloud'])) {
												$audio_url = trim($_post_config['audio_soundcloud']);
										echo do_shortcode( '[soundcloud url='.$audio_url.' height ="166" width="100%" ]' );
											}
											else {
										
										if (strlen(trim($_post_config['audio_mp3'])) > 0) {
											$audio_url = trim($_post_config['audio_mp3']);
											$attr = array(
												'src'      => $audio_url,
												'loop'     => '',
												'autoplay' => '',
												'preload' => 'none'
												);
											echo wp_audio_shortcode( $attr );
										}
									}
										}
										break;									
							}
					 endif;?>
					</div>
					 <?php $gallery_ids = get_post_meta($custom2->post->ID, THEME_SLUG.'post_gallery', true);
								if( $gallery_ids != '' ){
									$gallery_ids = explode(',', $gallery_ids);
								}
								if( is_array($gallery_ids) ){
									if( has_post_thumbnail() ){
										array_unshift($gallery_ids, get_post_thumbnail_id());
									}
									?>
									<div class="images blog-image-slider loading">
										<?php foreach( $gallery_ids as $id ): ?>
											<div class="image">
												<a class="thumb-image" href="<?php the_permalink() ; ?>">
													<?php echo wp_get_attachment_image( $id, 'blog_thumb' ); ?>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
									<?php
								} 
		          if(  has_post_thumbnail($custom2->post->ID) && $_post_config['post_type']== 0 && $gallery_ids == '' ): ?>
					<a class="thumbnail effect_color" href="<?php esc_url(the_permalink()); ?>">
						<?php 
							$post_thumbnail_type = "blog_shortcode_auto";
							the_post_thumbnail( $post_thumbnail_type,array('class' => 'thumbnail-effect-1') );
						?>
									<!--div class="effect_hover_image"></div-->
					</a>
					<?php endif; ?>
			<div class="entry-date body_color">
						<p class="month"><?php echo get_the_date('M') ?></p>
						<p class="day"><?php echo get_the_date('d') ?></p>
			</div>
			</div>
			<div class="meta-post post-info-content">
					<h3 class="heading-title"><a href="<?php echo esc_url(get_permalink($custom2->post->ID)); ?>" class="wpt_title" title="<?php echo esc_attr(get_the_title($custom2->post->ID));?>" ><?php echo esc_attr(get_the_title($custom2->post->ID)); ?></a></h3>	
					<div class="author">
						<?php _e('Post by','wpdance')?><?php the_author_posts_link(); ?>
					</div>
					<div class="post-info-meta-top post-info-meta">						
						<?php if( $tvlgiao_wpdance_wd_data['wd_blog_comment_number'] == 1 ) : ?>
						<div class="comments-count"><?php $comments_count = wp_count_comments($custom2->post->ID);
						if(absint($comments_count->approved) == 0) echo absint($comments_count->approved) . ' ' . __('Comment', 'wpdance');
						else echo absint($comments_count->approved) . ' ' . _n( "Comment", "Comments", absint($comments_count->approved), 'wpdance');?>
						</div>
						<?php endif;?>
						<?php if( $tvlgiao_wpdance_wd_data['wd_blog_time'] == 1 ) : ?>
						<div class="entry-date"><?php echo get_the_date('F d, Y') ?></div>
						<?php endif;?>
					</div>
					<?php if( $tvlgiao_wpdance_wd_data['wd_blog_excerpt'] == 1 ) : ?>
					<p class="excerpt"><?php 
						$words_limit = ($tvlgiao_wpdance_wd_data['wd_blog_excerpt_words_limit']!=='' && is_numeric($tvlgiao_wpdance_wd_data['wd_blog_excerpt_words_limit']))? absint($tvlgiao_wpdance_wd_data['wd_blog_excerpt_words_limit']): 60;
						the_excerpt_max_words($words_limit,$custom2->post); ?>
					</p>
					<?php endif;?>
					<?php if( $tvlgiao_wpdance_wd_data['wd_blog_readmore'] == 1 ) : ?>		
					<a class="button" href="<?php esc_url(the_permalink()); ?>"><?php _e("Read more", "wpdance");?></a>
					<?php endif;?>
								
				</div>	
			</div>
			</div>
	<?php 	$i++;
		endwhile;
		endif;
		exit; ?>

			
		
<?php } ?>