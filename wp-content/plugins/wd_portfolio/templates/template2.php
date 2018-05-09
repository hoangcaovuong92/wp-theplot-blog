<?php
//add_image_size('portfolio_item',480,300,true); /* image for slideshow */
function show_wd_portfolio_mansory( $columns = 4,$show_filter = "yes"/*, $style="padding"*/, $show_title = "yes" ,$show_desc = "yes", $count = "-1", $portf_style = 'style1' ,$show_pages="yes" ){
	$wd_portfolio = new WD_Portfolio();
	 
	
?>
					
						<div id="portfolio-container" class="<?php echo "portfolio-".$portf_style."-style" ?>">
							<div id="portfolio-container-holder">	
								<div class="portfolio-galleries" id="portfolio-galleries">
									<?php $terms = get_terms('wd-portfolio-category',array('hide_empty'=>true)); ?>
									<input class="limited" type="hidden" value="<?php echo $count ;?>" />
									<?php if( $columns > 1 && strcmp('yes',$show_filter) == 0 ) : ?>
									<div>	
										<ul class="portfolio-filter">
											<li id="all" class="active"><a href="javascript:void(0)" id="all_a" class="filter-portfoio active"><?php _e('ALL','wpdance');?></a></li>
										<?php foreach( $terms as $term ) : ?>
											<li id="<?php echo esc_html($term->slug) ; ?>"><a href="javascript:void(0)" id="<?php echo esc_html($term->slug) ; ?>_a" class="filter-portfoio"><?php echo esc_html(get_term($term,'wd-portfolio-category')->name); ?></a></li>
										<?php endforeach;?>
										</ul>
									</div>
									<?php endif; ?>
								
									<?php $terms=get_terms('wd-portfolio-category',array('hide_empty'=>true)); ?>
									<input class="limited" type="hidden" value="<?php echo get_option('posts_per_page' ) ;?>" />
									<div id="portfolio-galleries-holder">
									<?php	
										$title_icon = "";
										query_posts('post_type=portfolio&posts_per_page='.$count.'&paged='.get_query_var('page'));$count=0;
										echo '<div class="isotope items">';
										if(have_posts()) :
										$id_widget = 'portfolio-galleries-holder';
										
										while(have_posts()) : the_post(); global $post;global $wp_query;
										
											$post_title = esc_html(get_the_title($post->ID));
											
											$post_url = get_post_meta($post->ID,'wd-portfolio-url',true)? esc_url(get_post_meta($post->ID,'wd-portfolio-url',true)): esc_url(get_permalink($post->ID));
											//$post_url =  esc_url(get_permalink($post->ID));
											
											$post_cat = wp_get_post_terms( $post->ID, 'wd-portfolio-category' );
											
											$term_list = implode( ' ', wp_get_post_terms($post->ID, 'wd-portfolio-category', array("fields" => "slugs")) );

											$thumb = get_post_thumbnail_id($post->ID);
											$thumburl = wp_get_attachment_image_src($thumb,'portfolio_image');
											$thumb_lightbox_url = wp_get_attachment_image_src($thumb,'full');
											$item_class = "thumb-image";
											
											$light_box_url = trim($wd_portfolio->wd_portfolio_get_meta('wd-portfolio'));
							
											
											if( strlen( $light_box_url ) <= 0 ){
												$light_box_url = $thumb_lightbox_url[0];
											}
											$light_box_class = $wd_portfolio->wd_portfolio_get_filetype( $light_box_url );
											
											
											
											$post_count = $wp_query->post_count;
											$div_pos = $count % 3;
										?>
										
										<?php
											
											$class_span = "col-lg-".(24 / $columns);
											$class_span .= ' col-md-'.(24 / floor($columns * 992 / 1200));
											$class_span .= ' col-sm-'.(24 / floor($columns * 768 / 1200));
											$class_span .= ' col-xs-'.(24 / floor($columns * 480 / 1200));
											$class_span .= ' col-mb-1';
										?>
										
										<div class="item <?php echo $class_span;?> item-portfolio<?php //if($count % $columns == 0)  echo " first"; ?><?php  //if($count % $columns == ($columns - 1) || ($count + 1) == $wp_query->post_count ){ echo " last";} ?>" data-type="<?php echo $term_list;?>" data-id="<?php echo $post->ID;?>">
											<div>	
												<div class="thumb-holder <?php echo $item_class;?>">
													<div class="thumbnail">	
														<div class="thumb-image post-item ">																											
																	<a class="image" href="<?php echo $post_url; ?>">
																		<?php if($thumburl[0]): ?>
																			<?php the_post_thumbnail('full',array('class' => 'thumbnail-effect-1'));?>																
																		<?php else:  ?>
																			<img alt="<?php echo $post_title?>" title="<?php echo $post_title;?>" class="opacity_0" src="<?php echo get_template_directory_uri(); ?>/images/no-image-blog.gif"/>
																		<?php endif;?>
																	</a>
																	

															<div class="hover-default thumb-image-hover">
																<div class="background opacity_6"></div>
																
																<div class="icons">
																	<?php if($portf_style == 'wide'):?>
																		<h2 class="post-title heading-title list-title portfolio-grid-title"><?php echo $post_title; ?></h2>
																	<?php endif; ?>	
																	<a class="zoom-gallery wd_pretty_photo thumb-image <?php echo $light_box_class;?>" title="<?php _e("View Portfolio","wpdance"); ?>" data-rel="wd_pretty_photo['<?php echo $light_box_class;?>']" href="<?php echo esc_url($light_box_url);?>"></a>
																	<a class="link-gallery " title="<?php _e("View Details","wpdance");?>" href="<?php echo $post_url;?>"></a>
																</div>
															</div>
															<div class="thumb-hover-start"></div>													
														</div>
													</div>
		
													<div class="thumb-tag">
													<div class="thumb-tag-inner">
														<?php 
														$i = 1;
														if(count($post_cat)>0):
														echo "<span class=\"portfilio_cats text_color \">";
														foreach($post_cat as $c){
															echo $c->name;
															if($i < count($post_cat)) echo ", ";
															$i++;
														}
														echo "</span>";
														endif;
														?>
														<?php if($show_title == 'yes'): ?>
														<h2 class="post-title heading-title list-title portfolio-grid-title">
															<a  href="<?php echo $post_url; ?>">
															<?php echo $post_title; ?>
															</a>
														</h2>
														<?php endif; ?>
																												
													</div>
													</div>
																							
												</div>
											</div>
										</div>
										<?php		
											$count++;
										endwhile;
										echo '</div>';
										else : echo "Sorry.There are no posts to display";
										endif;	
									?>	
									</div>
								</div>
							</div>
							<div class="clear"></div>
							<div class="end_content">
							   <!--div class="count_project"><span class="number_project"><?php echo wp_count_posts('portfolio')->publish; ?></span> Project<?php if(wp_count_posts('portfolio')->publish > 1) { echo 's'; } ?></div-->
							    <?php if (strcmp('yes',$show_pages) == 0 ) { ?>
							   <div class="page_navi"><?php ew_pagination(); wp_reset_query();?></div>
							    <?php }?>
							</div>
						</div>				
					<script type="text/javascript">
					(function($,sr){
 
						  // debouncing function from John Hann
						  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
						  var debounce = function (func, threshold, execAsap) {
							  var timeout;
						 
							  return function debounced () {
								  var obj = this, args = arguments;
								  function delayed () {
									  if (!execAsap)
										  func.apply(obj, args);
									  timeout = null; 
								  };
						 
								  if (timeout)
									  clearTimeout(timeout);
								  else if (execAsap)
									  func.apply(obj, args);
						 
								  timeout = setTimeout(delayed, threshold || 100); 
							  };
						  }
							// smartresize 
							jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
						 
						})(jQuery,'smartresize');
							function untrigger_event_hover(data){
								data.children('.thumb-image .post-item,.thumb-video .post-item').unbind('hover');
							}
							function trigger_event_hover(){
								var backgOverColor      = "#3f3f3f";
								var backgOutColor       = '#141211';
								var text1BaseColor      = '#fff';
								jQuery('.thumb-image .post-item,.thumb-video .post-item').hover();	
							
							}
							
							jQuery(function() {
								tvlgiao_wpdance_load_isotope_portfolio();
								jQuery("a[data-rel^='wd_pretty_photo']").prettyPhoto({
									social_tools : false
									,theme: 'pp_woocommerce'
									,default_width: jQuery('body').innerWidth()/8*5
									,default_height: window.innerHeight - 30
								});
											
								if (jQuery.browser.msie && jQuery.browser.version == 8) {
									jQuery(".thumb-image-hover").each(function(index,value){
										jQuery(value).width( jQuery(value).parent().width() ).height( jQuery(value).parent().height() );
									});
								}
											
								
								trigger_event_hover();
								var applications = jQuery('#portfolio-galleries-holder');
								applications.find('div.item-portfolio').each(function(i,value){
									if(i % <?php echo $columns ?> == 0 ) { jQuery(this).addClass('first') ; };
									if(i % <?php echo $columns ?> == <?php echo $columns - 1; ?> || i == <?php echo $post_count - 1; ?> ) { jQuery(this).addClass('last');} ;
								});
								<?php if( $columns > 1 ) : ?>
								var filterType = jQuery('.portfolio-filter > li');
								var data = applications.clone();
								var flag = 0;
								// attempt to call Quicksand on every form change
								
								filterType.click(function(e) {
									if(!jQuery(this).hasClass('active')){
										var list_id = [];
										jQuery('.portfolio-filter > li.active').removeClass('active');
										jQuery(this).addClass('active');
										if (jQuery(this).attr('id') == 'all') {
											var filteredData = data.find('div.item-portfolio');
										} else {	
											var filteredData = data.find('div.item-portfolio[data-type~=' + jQuery(this).attr('id') + ']');
										}
	
										
										for( i = 0 ; i < filteredData.length ; i++ ){
											list_id.push(filteredData.eq(i).attr('data-id'));
																
										}

										if(flag != 0){
											console.log('flag_0');
											endModuleGallery(false);
										}
										
										window.setTimeout( function(){
											
											applications.quicksand(filteredData, {
													duration			: 0
													,easing				: 'easeInOutQuad'
													,retainExisting		: false
												},function() {
													if(filteredData.length > 0){																	
														moduleGallery();
														 	jQuery( ".item" ).wrapAll( "<div class='isotope items' />");	
														tvlgiao_wpdance_load_isotope_portfolio();
														trigger_event_hover();
													}else{
														jQuery('.not-found-wrapper').show();
													}
													
													
											});
											applications.find('div.item-portfolio').removeClass('first').removeClass('last');
											var count = 0;
											for( i = 0 ; i < list_id.length ; i++ ){
												var temp = jQuery('#portfolio-galleries-holder div.item-portfolio[data-id='+list_id[i]+']');
												if(i % <?php echo $columns ?> == 0 ) { 
													jQuery(temp).addClass('first') ; 
												}
												if(i % <?php echo $columns ?> == <?php echo $columns - 1; ?>  ) { 
													jQuery(temp).addClass('last');
												}
											}
											
											
										}, flag );
										
										flag = 1500;	
									}
								});
								<?php endif; ?>
							});
							function tvlgiao_wpdance_load_isotope_portfolio(){
							var $container = jQuery('#<?php echo  $id_widget;?> .isotope');
								
								$container.imagesLoaded( function() {
									$container.isotope({
										layoutMode: 'masonry'
										,itemSelector: '.item'
									});
								});
								jQuery('#<?php echo  $id_widget;?>').removeAttr("style");
								jQuery(window).smartresize(function(){
									  $container.isotope({										
										layoutMode: 'masonry'
										,itemSelector: '.item'
									  });
								});
							}
						</script>
							
<?php
}

?>