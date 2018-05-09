<?php 
function parse_gallery_width($array_width){
		$arr_ret = array();
		$size_arr = explode(',', trim($array_width));
		foreach($size_arr as $k => $v){
			$arr_temp = explode('_', trim($v));
			$width_percent = round($arr_temp[0] * 100 / $arr_temp[1],3,PHP_ROUND_HALF_DOWN);
			$arr_ret[$k] = $width_percent;
		}
		return $arr_ret;
	}
	function find_min_size($arr_size){
		$min = 1000;
		foreach($arr_size as $v => $k){
			if($k < $min)
				$min = $k;
		}
		return $min;
	}
if(!function_exists ('wd_recent_blogs_functions')){
	function wd_recent_blogs_functions($atts,$content = false){
		extract(shortcode_atts(array(
			'category'		=>	''
			,'columns'		=> 2
			,'number_posts'	=> 4
			,'show_type' 	=> 'list-posts'
			,'text_position' => 'left'
			,'show_type_isotope' => 1
			,'title'		=> 'yes'
			,'thumbnail'	=> 'yes'
			,'meta'			=> 'yes'
			,'excerpt'		=> 'yes'
			,'read_more'	=> 'yes'
			,'view_more'	=> 'yes'
			,'thumb_auto'	=> 'no'
			,'view_more_link'	=> ''
			,'excerpt_words'=> 10
		),$atts));

		wp_reset_query();	

		$args = array(
				'post_type' 			=> 'post'
				,'ignore_sticky_posts' 	=> 1
				,'showposts' 			=> $number_posts
		);	
		if( strlen($category) > 0 ){
			$args = array(
				'post_type' 			=> 'post'
				,'ignore_sticky_posts' 	=> 1
				,'showposts' 			=> $number_posts
				,'category_name' 		=> $category
			);	
		}		
		$title 		= strcmp('yes',$title) == 0 ? 1 : 0;
		$show_type_isotope 	= strcmp('yes',$show_type_isotope) == 0 ? 1 : 0;
		$thumbnail 	= strcmp('yes',$thumbnail) == 0 ? 1 : 0;
		$meta 		= strcmp('yes',$meta) == 0 ? 1 : 0;
		$excerpt 	= strcmp('yes',$excerpt) == 0 ? 1 : 0;
		$read_more 	= strcmp('yes',$read_more) == 0 ? 1 : 0;
		$view_more 	= strcmp('yes',$view_more) == 0 ? 1 : 0;
		
		//$span_class = "col-sm-".(24/$columns);
		
		$span_class = "col-lg-".(24/$columns);
		$span_class .= ' col-md-'.(24/round( $columns * 992 / 992));
		$span_class .= ' col-sm-'.(24/round( $columns * 992 / 992));
		$span_class .= ' col-xs-24';
		$span_class .= ' col-mb-24';
		
		//add_image_size('blog_thumb_garely',300,450,true);
		//add_image_size('blog_shortcode_recent',360,240, true);
		$num_count = count(query_posts($args));	
		if( have_posts() ) :
			$id_widget = 'recent-blogs-shortcode'.rand(0,1000);
			ob_start();
			
			if($show_type !== "widget"){
				echo '<div id="'. $id_widget .'" class="shortcode-recent-blogs display-flex '.$show_type.' columns-'.$columns.'">';
				$i = 0;
				while(have_posts()) {
					the_post();
					global $post;
					
					$_post_config = get_post_meta($post->ID,THEME_SLUG.'custom_post_config',true);
					if( strlen($_post_config) > 0 ){
						$_post_config = unserialize($_post_config);
					}
					
					?>
					<div class="item <?php echo $span_class ?><?php if( $i == 0 || $i % $columns == 0 ) echo ' first';?><?php if( $i == $num_count-1 || $i % $columns == $columns-1 ) echo ' last';?>">
					
						<div class="item-content">
							<div class="post-info-thumbnail display-flex <?php if(!$thumbnail) echo "hidden-element"?>">
								<div class="post-icon-box">
									<?php if(isset($_post_config['post_type'])):									
										switch($_post_config['post_type']){
											case 'video':
												if(strlen(trim($_post_config['video_url'])) > 0){
												$video_url = trim($_post_config['video_url']);
													if (!empty($video_url)) {
														$var = apply_filters('the_content', '[embed width="1200" height="225"]' . $video_url . '[/embed]');
														echo  $var;
													}
												}
												break;
											case 'audio':
										if(( isset($_post_config['audio_soundcloud']) || isset($_post_config['audio_mp3']))  )
										{											
											if (isset($_post_config['audio_soundcloud'])) {
												$audio_url = trim($_post_config['audio_soundcloud']);
										echo do_shortcode( '[soundcloud url='.$audio_url.' height ="220" width="100%" ]' );
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
											case 'shortcode':
												?><div class="sticky-post shortcode"><i class="fa fa-cog"></i></div><?php 
												break;
										}
									?>
									<?php endif;?>
								</div>
								<?php $gallery_ids = get_post_meta($post->ID, THEME_SLUG.'post_gallery', true);
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
													<?php echo wp_get_attachment_image( $id, 'blog_shortcode' ); ?>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
									<?php
								} ?>
								<?php  if(has_post_thumbnail($post->ID) && $_post_config['post_type']==0 && $gallery_ids == '') :?>
								<a class="thumbnail effect_color" href="<?php the_permalink(); ?>">
									<?php 
										if($show_type == 'list-posts') $post_thumbnail_type = "blog_shortcode";
										else {
											$post_thumbnail_type = strcmp(trim($thumb_auto),'yes') == 0? "blog_shortcode_auto": "blog_shortcode";
										}
										the_post_thumbnail( $post_thumbnail_type,array('class' => 'thumbnail-effect-1') );
									?>
									<!--div class="effect_hover_image"></div-->
								</a>
								<?php endif;?>
								<div class="entry-date body_color">
									<p class="month"><?php echo get_the_date('M') ?></p>
									<p class="day"><?php echo get_the_date('d') ?></p>
								</div>
							</div>
							<div class="meta-post post-info-content <?php if(!$thumbnail) echo ' noimage';?>">
								<h3 class="heading-title <?php if(!$title) echo 'hidden-element'; ?>"><a href="<?php echo get_permalink($post->ID); ?>" class="wpt_title" title="<?php echo esc_attr(get_the_title($post->ID));?>" ><?php echo get_the_title($post->ID); ?></a></h3>
								<div class="author">
									<?php _e('Post by','wpdance')?><?php the_author_posts_link(); ?>
								</div>
								
								<p class="excerpt <?php if(!$excerpt) echo 'hidden-element'; ?>"><?php the_excerpt_max_words($excerpt_words); ?></p>
								
								<?php if($read_more):?>
									<a class="button" href="<?php the_permalink(); ?>"><?php _e("Read more", "wpdance");?></a>
								<?php endif;?>
								
							</div>	
						</div>
					</div>
					
					
			<?php
					$i++;
					
				}
				echo '</div>';
				?>
				
				<?php if($view_more && $view_more_link!==''):?>
					<p style="text-align:center"><a class="button" href="<?php echo esc_url($view_more_link);?>"><?php esc_attr_e("View more post", "wpdance");?></a></p>
				<?php endif;?>
				
				<?php 
				
			} else {
				echo '<div class="shortcode-recent-blogs display-vertical '.$show_type.' columns-'.$columns.'">';
				$i=0;
				while(have_posts()) {
					the_post();
					global $post;
					
					$_post_config = get_post_meta($post->ID,THEME_SLUG.'custom_post_config',true);
					if( strlen($_post_config) > 0 ){
						$_post_config = unserialize($_post_config);
					}
					
					?>
					<div class="item <?php echo $span_class ?> <?php if( $i == 0 || $i % $columns == 0 ) echo ' first';?><?php if( $i == $num_count-1 || $i % $columns == $columns-1 ) echo ' last';?>">
					
						<div class="item-content <?php echo $text_position ?>">
							<div class="post-info-thumbnail display-flex <?php if(!$thumbnail) echo "hidden-element"?>">
								<div class="post-icon-box">
									<?php if(isset($_post_config['post_type'])):									
										switch($_post_config['post_type']){
											case 'video':
												if(strlen(trim($_post_config['video_url'])) > 0){
												$video_url = trim($_post_config['video_url']);
													if (!empty($video_url)) {
														$var = apply_filters('the_content', '[embed width="600" height="306"]' . $video_url . '[/embed]');
														echo  $var;
													}
												}
												break;
											case 'audio':
										if(( isset($_post_config['audio_soundcloud']) || isset($_post_config['audio_mp3']))  )
										{											
											if (isset($_post_config['audio_soundcloud'])) {
												$audio_url = trim($_post_config['audio_soundcloud']);
										echo do_shortcode( '[soundcloud url='.$audio_url.' height ="220" width="100%" ]' );
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
											case 'shortcode':
												?><div class="sticky-post shortcode"><i class="fa fa-cog"></i></div><?php 
												break;
										}
									?>
									<?php endif;?>
								</div>
								<?php $gallery_ids = get_post_meta($post->ID, THEME_SLUG.'post_gallery', true);
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
													<?php echo wp_get_attachment_image( $id, array(360,230),true ); ?>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
									<?php
								} ?>
								<?php  if(has_post_thumbnail($post->ID) && $_post_config['post_type']==0 && $gallery_ids == '') :?>
								<a class="thumbnail effect_color" href="<?php the_permalink(); ?>">
									<?php 
										
									
											$post_thumbnail_type = "blog_shortcode_recent";
										the_post_thumbnail( array(400, 400), array( 'class' => 'alignleft' ) );

									?>
									<!--div class="effect_hover_image"></div-->
								</a>
								<?php endif;?>								
							</div>
							<div class="meta-post post-info-content <?php if(!$thumbnail) echo ' noimage';?>">
								<h3 class="heading-title <?php if(!$title) echo 'hidden-element'; ?>"><a href="<?php echo get_permalink($post->ID); ?>" class="wpt_title" title="<?php echo esc_attr(get_the_title($post->ID));?>" ><?php echo get_the_title($post->ID); ?></a></h3>
								<div class="author">
									<?php _e('Post by','wpdance')?><?php the_author_posts_link(); ?>
								</div>
								
								<p class="excerpt <?php if(!$excerpt) echo 'hidden-element'; ?>"><?php the_excerpt_max_words(15); ?></p>
																
								<div class="entry-date body_color">
									<p class="month"><?php echo get_the_date('M') ?></p>
									<p class="day"><?php echo get_the_date('d') ?></p>
								</div>
							</div>	
						</div>
					</div>
					
					
			<?php
					$i++;
				}
				echo '</div>';
			}
			?>
			
			<?php
			$ret_html = ob_get_contents();
			ob_end_clean();
			//ob_end_flush();
		endif;
		wp_reset_query();
		return $ret_html;
	}
} 
add_shortcode('wd_recent_blogs','wd_recent_blogs_functions');

 
if(!function_exists ('wd_simple_recent_blogs_functions')){
	function wd_simple_recent_blogs_functions($atts,$content = false){
		extract(shortcode_atts(array(
			'slug_simple'		=>	'0',
			'show_image'		=> 1,
			'style'				=> 'style1'
		),$atts));

		wp_reset_query();	
		$post_7 = get_post($slug_simple); 
		$title = $post_7->post_title;
		ob_start();
		$_post_config = get_post_meta($post_7->ID,THEME_SLUG.'custom_post_config',true);
					if( strlen($_post_config) > 0 ){
						$_post_config = unserialize($_post_config);
					}
		echo '<div class ="simple_blog_recent">';
	if($style == "style1"):
		if($show_image):
		?>	
		<div class="meta-post post-info-content">
		<h3 class="heading-title"><a href="<?php echo get_permalink($post_7->ID); ?>" class="wpt_title" title="<?php echo esc_attr(get_the_title($post_7->ID));?>" ><?php echo get_the_title($post_7->ID); ?></a></h3>
		<div class="author">
			<?php _e('By ','wpdance')?><?php the_author_posts_link(); ?>
		</div>
		</div>
		<div class="post-info-thumbnail">
		<div class="post-icon-box">
				<?php if(isset($_post_config['post_type'])):									
					switch($_post_config['post_type']){
						case 'video':
							if(strlen(trim($_post_config['video_url'])) > 0){
							$video_url = trim($_post_config['video_url']);
								if (!empty($video_url)) {
									echo wd_get_embbed_video( $video_url, 1200, 280 );									
								}
							}
							break;
						case 'audio':
					if(( isset($_post_config['audio_soundcloud']) || isset($_post_config['audio_mp3']))  )
					{											
						if (isset($_post_config['audio_soundcloud'])) {
							$audio_url = trim($_post_config['audio_soundcloud']);
					echo do_shortcode( '[soundcloud url='.$audio_url.' height ="220" width="100%" ]' );
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
				?>
				<?php endif;?>
				<?php $gallery_ids = get_post_meta($post_7->ID, THEME_SLUG.'post_gallery', true);
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
												<a class="thumb-image" href="<?php the_permalink($post_7->ID); ?>">
													<?php echo wp_get_attachment_image( $id, array(360,230),true ); ?>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
									<?php
								} ?>
			</div>
		<div class="entry-date body_color">
			<p class="month"><?php echo get_the_date('M') ?></p>
			<p class="day"><?php echo get_the_date('d') ?></p>
		</div>
		<?php  if(has_post_thumbnail($post_7->ID) && $_post_config['post_type']== '0' && $gallery_ids == '' ) :?>
		<a class="thumbnail effect_color" href="<?php the_permalink($post_7->ID); ?>">
		<?php 			
			echo get_the_post_thumbnail( $post_7->ID,array(400, 400) );
		?>									
		</a>
		<?php endif;?>	
		</div>
		<p class="excerpt"><?php the_excerpt_max_words(15,$post_7)?></p>
		<?php 
		else: ?>
		<a href="<?php the_permalink($post_7->ID); ?>">
		<div class="simple_text">
			<p class="excerpt"><?php the_excerpt_max_words(15,$post_7)?></p>
			<div class="author">
			<?php the_author_posts_link(); ?>
		    </div>
		</div>
		</a>
		<?php endif;
		else: 
			 $categories = get_the_category( $post_7->ID );
		?>
		<div class="simple-blog-heading">
		<div class="category-blog">
			<?php foreach( $categories as $category ) {
				echo  $category->cat_name . ' ';
			} ?>
		</div>
		<div class="entry-date body_color">
			<p class="month"><?php echo get_the_date('M') ?></p>
			<p class="day"><?php echo get_the_date('d') ?></p>
		</div>
		</div>
		<div class="post-info-thumbnail">
		<div class="post-icon-box">
				<?php if(isset($_post_config['post_type'])):									
					switch($_post_config['post_type']){
						case 'video':
							if(strlen(trim($_post_config['video_url'])) > 0){
							$video_url = trim($_post_config['video_url']);
								if (!empty($video_url)) {
									echo wd_get_embbed_video( $video_url, 1200, 280 );									
								}
							}
							break;
						case 'audio':
					if(( isset($_post_config['audio_soundcloud']) || isset($_post_config['audio_mp3']))  )
					{											
						if (isset($_post_config['audio_soundcloud'])) {
							$audio_url = trim($_post_config['audio_soundcloud']);
					echo do_shortcode( '[soundcloud url='.$audio_url.' height ="220" width="100%" ]' );
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
				?>
				<?php endif;?>
				<?php $gallery_ids = get_post_meta($post_7->ID, THEME_SLUG.'post_gallery', true);
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
												<a class="thumb-image" href="<?php the_permalink($post_7->ID);?>">
													<?php echo wp_get_attachment_image( $id, "full",true ); ?>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
									<?php
								} 
				$post_gallery = get_post_meta($post_7->ID,THEME_SLUG.'_post_gallerys',true);
				$post_gallery = unserialize($post_gallery);
				if( is_array($post_gallery) && count($post_gallery) > 0){
					$post_gallery_config = get_post_meta($post_7->ID,THEME_SLUG.'_post_gallery_config',true);
					$post_gallery_config = unserialize($post_gallery_config);
					$id_gallery = 'gallery-'.rand(0,1000).time();	
					$arr_width = parse_gallery_width($post_gallery_config['gallery_width']);
					$min_width = find_min_size($arr_width);
					?>
					<div class="post-gallery">
						<div id="<?php echo  $id_gallery;?>" class="post_mansory" data-min="<?php echo esc_attr($min_width);?>">
							<?php 
								$count = 0;
								foreach( $post_gallery as $_image ){ 
									$image_attributes = wp_get_attachment_image_src( $_image['id'],'full' );
									
								?>
									<div class="gallery_item" data-width="<?php echo esc_attr($arr_width[$count]);?>"><a class="thumbnail" href="<?php echo esc_url($image_attributes[0]);?>"><?php echo wp_get_attachment_image($_image['id'], 'full', false);?>
									</a></div>
								<?php 
									$count ++;
								} 
							?>
						</div>
					</div>
					<?php
				}
					?>				
			</div>
		<?php  if(has_post_thumbnail($post_7->ID) && $_post_config['post_type']== '0' && $gallery_ids == '' ) :?>
		<a class="thumbnail effect_color" href="<?php the_permalink($post_7->ID); ?>">
		<?php 			
			echo get_the_post_thumbnail( $post_7->ID,'' );
		?>									
		</a>
		<?php endif;?>
		<div class="author">
			<?php _e('By ','wpdance')?><?php the_author_posts_link(); ?>
		</div>
		<p class="excerpt"><?php the_excerpt_max_words(80,$post_7)?></p>
		<div class ="simple-blog-bottom">
		<div class="share-list">
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
		<a class="button" href="<?php the_permalink($post_7->ID); ?>"><?php _e("Read more", "wpdance");?></a>
		</div>
		</div>
		<?php endif;
		echo '</div>';
		$ret_html = ob_get_contents();
		ob_end_clean();
	     wp_reset_query();
		return $ret_html;
	}
}


 
add_shortcode('wd_recent_simple_blogs','wd_simple_recent_blogs_functions');

?>