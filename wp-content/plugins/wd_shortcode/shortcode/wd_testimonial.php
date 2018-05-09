<?php
add_image_size('testimonial2',500,500, true);
	if(!function_exists('wd_testimonial_function')){
		function wd_testimonial_function($atts,$content){
			extract(shortcode_atts(array(
				'slug'				=> ''
				,'title' 			=> ''
				,'box_style'		=> 'style-1'
				,'show_nav' 		=> 1
				,'show_nav_pos' 	=> 'top_right'
				,'id'				=> 0
				,'style'			=> 'style1'
				,'limit'			=> 5
				,'wd_query_type'	=> 'simple'
				,'short_limit'		=> 20
				,'show_img'			=> 1
				,'show_date'		=> 1
				,'cat_test_slug' 	=> ''
				,'show_short'		=> 1
			),$atts));
			
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "testimonials-by-woothemes/woothemes-testimonials.php", $_actived ) ) {
				return;
			}
			
			global $post;
			$count = 0;
			if( $style=="style1" || $style =="style2" ):	
				if($cat_test_slug) :
				$_testimonial = woothemes_get_testimonials( array('limit' => $limit, 'size' => 100 ,'category'=> $cat_test_slug ));
				else :
				$_testimonial = woothemes_get_testimonials( array('limit' => $limit, 'size' => 100));
				endif;
			ob_start();
			?>			
			<?php $_random_id = 'testi'.rand();  ?>
				<div class="sc_testimonial <?php echo esc_attr($style);?>">
					 <div class="project" id="nav<?php echo $_random_id ?>">
						<div id="<?php echo $_random_id ?>" class="sky-carousel">						  
							<div class="sky-carousel-wrapper">
								<ul class="sky-carousel-container">
								<?php 									
									foreach( $_testimonial as $testimonial ){
										$post = $testimonial;
										setup_postdata( $post );
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); 
										 //print_r( $image[0]);										
								?>									
									<li>
										<img src="<?php echo $image[0] ?>" alt="" class="sc-image">
											
										<?php 
										$content = get_the_content();
										$content = wp_trim_words( strip_tags($content), $short_limit, $more = null );
										?>
										<div class="sc-content">																						
											<div class="avartar">
												<div class="name">												
												  <p><?php the_title();?>	</p>
												</div>
												<div class="job">
												 <?php echo get_post_meta($post->ID,'_byline',true);?>
												</div>
												<h2><?php echo $content;?></h2>
												<div class="social">
													<a href="http://twitter.com" target="_blank" title="<?php _e('Follow us', 'wpdance'); ?>" ><i class="fa fa-twitter-square"></i></a>
													<a href="http://www.facebook.com" target="_blank" title="<?php _e('Become our fan', 'wpdance'); ?>" ><i class="fa fa-facebook-square"></i></a>
													<a href="http://www.pinterest.com" target="_blank" title="<?php _e('See Us', 'wpdance'); ?>" ><i class="fa fa-pinterest-square"></i></a>
												</div>
											</div>
										</div>
									</li>
									
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						jQuery(function() {	
							'use strict';
							jQuery("#<?php echo $_random_id ?>").carousel({
								itemWidth: 170,
								itemHeight: 170,
								distance: 25,
								selectedItemDistance: 75,
								selectedItemZoomFactor: 1,
								unselectedItemZoomFactor: 0.7,
								unselectedItemAlpha: 0.6,
								motionStartDistance: 210,
								topMargin: 115,
								gradientStartPoint: 0.35,
								gradientOverlayColor: "#ebebeb",
								gradientOverlaySize: 190,
								selectByClick: true,
								classprev:"#nav<?php echo $_random_id ?>"
							});
						});
				</script>
				</div>	
			<?php
			endif;
		if($style=="style3" ||  ($style=="style5")) :
		if( absint($id) > 0 ){
			$_testimonial = woothemes_get_testimonials( array('id' => $id,'limit' => 1, 'size' => 100 ));
			ob_start();
			foreach( $_testimonial as $testimonial ){
			$post = $testimonial;
			setup_postdata( $post );
			?>
				<div class="testimonial-item testimonial <?php echo esc_attr($style);?>">
					<div class="avartar">
						<?php if(absint($show_img)):?>													
							<a href="#"><?php the_post_thumbnail(array(100,100));?></a>
							<?php endif;?>												
					</div>							
					<div class="detail">						
						<?php if(absint($show_short)):?>
						<?php 
						$content = get_the_content();
						$content = wp_trim_words( strip_tags($content), $short_limit, $more = null );
						?>
						<div class="testimonial-content"><?php echo $content;?></div>
						<?php endif;?>
						<div class="name">												
							  <p><?php the_title();?>	</p>
						</div>
						<div class="job">
							 <?php echo get_post_meta($post->ID,'_byline',true);?>
						</div>
					</div>
				</div>
			<?php
			}
		}				
		endif;
		if($style=="style4" ) :
			if($cat_test_slug) :
			$_testimonial = woothemes_get_testimonials( array('limit' => $limit, 'size' => 100 ,'category'=> $cat_test_slug ));
			else :
			$_testimonial = woothemes_get_testimonials( array('limit' => $limit, 'size' => 100));
			endif;
			ob_start();
			$slider_loading = ' wd-loading';
			 $testimonial_id = "wd_testimonial_".rand();
			?>
			<div class="products_shortcode_wrapper <?php echo esc_attr($style);?>">
			<div class="wd_testimonial_slider <?php echo esc_attr($show_nav_pos);?> <?php echo $slider_loading;?>">
			  <div class="<?php echo $testimonial_id?>">
			 <?php foreach( $_testimonial as $testimonial ){
					 $post = $testimonial;
					 setup_postdata( $post ); ?>
				<div class="testimonial-item testimonial">
					<div class="avartar">
						<?php if(absint($show_img)):?>
						<a href="#"><?php the_post_thumbnail('testimonial2');?></a>
						<?php endif;?>
					</div>							
					<div class="detail">				
						<?php 
						$content = get_the_content();
						$content = wp_trim_words( strip_tags($content), $short_limit, $more = null );
						?>
						<?php if(absint($show_short)):?>
						<div class="testimonial-content"><?php echo $content;?></div>
						<?php endif;?>
						<div class="name">												
							  <p><?php the_title();?>	</p>
					</div>
					<div class="job">
							 <?php echo get_post_meta($post->ID,'_byline',true);?>
					</div>
					</div>					
				</div>
				<?php 	} ?>
			</div>
		</div>
		</div>
		<script type='text/javascript'>
				//<![CDATA[
				jQuery(document).ready(function() {
					"use strict";
					var temp_visible = 1;
					
					var row = 1;
					var item_width = 1100;
					
					var show_nav = <?php if($show_nav): ?> true <?php else: ?> false <?php endif;?>;
					var prev,next,pagination;
					var show_icon_nav = <?php if($show_nav): ?> true <?php else: ?> false <?php endif;?>;
					
					var object_selector = ".<?php echo $testimonial_id;?>";
					/*generate_horizontal_slide(temp_visible,row,item_width,show_nav,show_icon_nav,object_selector);*/
					var _slider_datas =	{
						item 			: temp_visible
						,loop			: true
						,nav			: show_nav
						//,navText		: [ '<', '>' ]
						,dots			: show_icon_nav
						,lazyload		:true
						//,itemElement	:'section'
						,pagination 	: true
						,responsive		:{
							0:{
								items:1
							},
							480:{
								items:1
							},
							768:{
								items: 1
							},
							992:{
								items: 1
							},
							1200:{
								items:temp_visible
							}
						}
						,onInitialized: function(){
							jQuery(object_selector).parents('.wd-loading').addClass('wd-loaded').removeClass('wd-loading');
						}
					}
					var owl = jQuery(object_selector);
					owl.owlCarousel(_slider_datas);	
				});
				//]]>	
			</script>
			<?php				
		endif;
		if($style=="style6" ) :
			if($cat_test_slug) :
			$_testimonial = woothemes_get_testimonials( array('limit' => $limit, 'size' => 100 ,'category'=> $cat_test_slug ));
			else :
			$_testimonial = woothemes_get_testimonials( array('limit' => $limit, 'size' => 100));
			endif;
			ob_start();
			$slider_loading = ' wd-loading';
			 $testimonial_id = "wd_testimonial_".rand();
			?>
			<div class="products_shortcode_wrapper <?php echo esc_attr($style);?>">
			<div class="wd_testimonial_slider <?php echo esc_attr($show_nav_pos);?> <?php echo $slider_loading;?>">
			  <div class="<?php echo $testimonial_id?>">
			 <?php foreach( $_testimonial as $testimonial ){
					 $post = $testimonial;
					 setup_postdata( $post ); ?>
				<div class="testimonial-item testimonial">
					<div class="avartar">
						<?php if(absint($show_img)):?>
						<a href="#"><?php the_post_thumbnail('testimonial2');?></a>
						<?php endif;?>
					</div>							
					<div class="detail">
						<?php 
						$content = get_the_content();
						$content = wp_trim_words( strip_tags($content), $short_limit, $more = null );
						if(strlen(trim($title)) >0){
						?>
						<div class="heading-title">
						  <?php echo $title;?>
					    </div>
						<?php } ?>
						<div class="social">
							<a href="http://twitter.com" target="_blank" title="<?php _e('Follow us', 'wpdance'); ?>" ><i class="fa fa-twitter-square"></i></a>
							<a href="http://www.facebook.com" target="_blank" title="<?php _e('Become our fan', 'wpdance'); ?>" ><i class="fa fa-facebook-square"></i></a>
							<a href="http://www.pinterest.com" target="_blank" title="<?php _e('See Us', 'wpdance'); ?>" ><i class="fa fa-pinterest-square"></i></a>
						</div>
						<?php if(absint($show_short)):?>
						<div class="testimonial-content"><?php echo $content;?></div>
						<?php endif;?>
						<div class="name">												
							  <p><?php the_title();?>	</p>
					</div>
					<div class="job">
							 <?php echo get_post_meta($post->ID,'_byline',true);?>
					</div>
					</div>					
				</div>
				<?php 	} ?>
			</div>
		</div>
		</div>
		<script type='text/javascript'>
				//<![CDATA[
				jQuery(window).load( function(){
					jQuery('.<?php echo $testimonial_id?>').each(function(){
					var element = jQuery(this);
					var _slider_datas =	{
							items: 1
							,loop: true
							,nav: true
							,dots : false
							,animateIn: 'fadeIn'
							,animateOut: 'fadeOut'
							,navText: [,]
							,navSpeed: 1000
							,slideBy: 1
							,margin: 0
							,navRewind: false
							,autoplay: false
							,autoplayTimeout: 5000
							,autoplayHoverPause: true
							,autoplaySpeed: false
							,mouseDrag: false
							,touchDrag: true
							,responsive:{
								0:{
									items : 1
								}
							}
							,onInitialized: function(){
								element.addClass('loaded').removeClass('loading');
							}
					}
					element.owlCarousel(_slider_datas);
					});
				});
				//]]>	
			</script>
			<?php				
		endif;
				$output = ob_get_contents();
		        ob_end_clean();
				rewind_posts();
			   wp_reset_query();
				return $output;
		}
	}
	add_shortcode('wd_testimonial','wd_testimonial_function');
?>