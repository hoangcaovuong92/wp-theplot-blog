<?php 
	add_action( 'tvlgiao_wpdance_wd_footer_init', 'wd_footer_init_widget_area_1', 10 );
	if(!function_exists ('wd_footer_init_widget_area_1')){
		function wd_footer_init_widget_area_1(){
			global $tvlgiao_wpdance_wd_data; ?>
			<div class="wd_recent_blogs">
				<div class="container">
					<div class="row">
						<?php	if ( is_active_sidebar( 'recent-blogs-widget-area' ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( 'recent-blogs-widget-area' ); ?>
										</ul>
									<?php endif; ?>	
					</div>
				</div>
		    </div>
		<?php if( (int)$tvlgiao_wpdance_wd_data['wd_show_first_footer_area'] == 1 ): ?>
			<div class="first-footer-widget-area">
				<div class="container">
					<div class="row">
						
						<div class="first-footer-widget-area-1 col-sm-8 hidden-phone">
							<div>
								<?php if ( is_active_sidebar( 'first-footer-widget-area-1' ) ) : ?>
									<ul class="xoxo">
										<?php dynamic_sidebar( 'first-footer-widget-area-1' ); ?>
									</ul>
								<?php endif; ?>
							</div>
						</div><!-- end #footer-first-area -->
						<div class="first-footer-widget-area-2 col-sm-4 hidden-phone">
							<div>
								<?php
									if ( is_active_sidebar( 'first-footer-widget-area-2' ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( 'first-footer-widget-area-2' ); ?>
										</ul>
								<?php endif; ?>								
							</div>
						</div><!-- end #footer-first-area-2 -->
						<div class="first-footer-widget-area-3 col-sm-6 hidden-phone">
							<div>
								<?php
									if ( is_active_sidebar( 'first-footer-widget-area-3' ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( 'first-footer-widget-area-3' ); ?>
										</ul>
								<?php endif; ?>								
							</div>
						</div><!-- end #footer-first-area-3 -->
						<div class="first-footer-widget-area-4 col-sm-6 hidden-phone">
							<div>
								<?php
									if ( is_active_sidebar( 'first-footer-widget-area-4' ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( 'first-footer-widget-area-4' ); ?>
										</ul>
								<?php endif; ?>								
							</div>
						</div><!-- end #footer-first-area-4 -->
							
					</div>
				</div>
			</div>
			
		<?php endif; ?>	
		
	<?php
		}
	}
	
	add_action( 'tvlgiao_wpdance_wd_footer_init', 'wd_footer_init_widget_area_2', 15 );
	if(!function_exists ('wd_footer_init_widget_area_2')){
		function wd_footer_init_widget_area_2(){
			global $tvlgiao_wpdance_wd_data;
		?>
			<?php if( (int)$tvlgiao_wpdance_wd_data['wd_show_second_footer_area'] == 1 ): ?>
			<div class="second-footer-widget-area">
				<div class="container">
					<div class="row">
						<div class="second-footer-widget-area-1 col-sm-16 hidden-phone">
							<div>
								<?php
								if ( is_active_sidebar( 'second-footer-widget-area-1' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'second-footer-widget-area-1' ); ?>
								</ul>
								<?php endif; ?>								
							</div>
						</div><!-- end #footer-second-area-1 -->
						<div class="second-footer-widget-area-2 col-sm-8 hidden-phone">
							<div>
								<?php
								if ( is_active_sidebar( 'second-footer-widget-area-2' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'second-footer-widget-area-2' ); ?>
								</ul>
								<?php endif; ?>								
							</div>
						</div><!-- end #footer-second-area-1 -->
						
					</div>
				</div>
			</div>
			<?php endif;?>
		<?php			
		}
	}
	
	add_action( 'tvlgiao_wpdance_wd_footer_init', 'wd_footer_init_widget_area_3', 20 );
	if(!function_exists ('wd_footer_init_widget_area_3')){
		function wd_footer_init_widget_area_3(){
			global $tvlgiao_wpdance_wd_data;
	?>	
		<?php if( (int)$tvlgiao_wpdance_wd_data['wd_show_third_footer_area'] == 1 ): ?>
			<div class="third-footer-widget-area">				
						<?php 
						$third_f = array();
						if(is_active_sidebar( 'third-footer-widget-area-1' )) $third_f[1] = 1;
						if(is_active_sidebar( 'third-footer-widget-area-2' )) $third_f[2] = 2;
						if(is_active_sidebar( 'third-footer-widget-area-3' )) $third_f[3] = 3;
						if(is_active_sidebar( 'third-footer-widget-area-4' )) $third_f[4] = 4;
						$third_f_class_1 = $third_f_class_2 = $third_f_class_3 = $third_f_class_4 = '';
						if(count($third_f) === 4) {
							$third_f_class_1 = $third_f_class_2 = $third_f_class_3 = $third_f_class_4 = 'col-sm-6';
						} elseif(count($third_f) === 3) {
							
							if(array_key_exists(4, $third_f)) {
								if(array_key_exists(1, $third_f)) {
									if(array_key_exists(2, $third_f)) {
										$third_f_class_1 = $third_f_class_2 = "col-sm-6";
										$third_f_class_4 = 'col-sm-12';
									} else {
										$third_f_class_1 = 'col-sm-12';
										$third_f_class_3 = $third_f_class_4 = "col-sm-6";
									}
								} else {
									die('You should add content for third-footer-widget-area-1');
								}
							} else {
								$third_f_class_1 = $third_f_class_2 = $third_f_class_3 = $third_f_class_4 = 'col-sm-8';
							}
						} elseif(count($third_f) === 2) {
							if(array_key_exists(1, $third_f)) $third_f_class_1 = 'col-sm-12';
							if(array_key_exists(2, $third_f)) $third_f_class_2 = 'col-sm-12';
							if(array_key_exists(3, $third_f)) $third_f_class_3 = 'col-sm-12';
							if(array_key_exists(4, $third_f)) $third_f_class_4 = 'col-sm-12';
						}
						
						$third_footer_class = ( is_active_sidebar( 'third-footer-widget-area-1' ) &&  is_active_sidebar( 'third-footer-widget-area-2' ) && is_active_sidebar( 'third-footer-widget-area-3' ) && is_active_sidebar( 'third-footer-widget-area-4' ) )? "col-sm-6" : "col-sm-8"; 
						?>																		
						<?php if ( is_active_sidebar( 'third-footer-widget-area-1' ) ) : ?>
						<div class="third-footer-widget-area-1 <?php echo esc_attr($third_f_class_1);?> hidden-phone">
							<div>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'third-footer-widget-area-1' ); ?>
								</ul>
															
							</div>
						</div><!-- end #footer-third-area-1 -->
						<?php endif; ?>	
						
						<?php if ( is_active_sidebar( 'third-footer-widget-area-2' ) ) : ?>
						<div class="third-footer-widget-area-2 <?php echo esc_attr($third_f_class_2);?> hidden-phone">
							<div>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'third-footer-widget-area-2' ); ?>
								</ul>
							</div>
						</div><!-- end #footer-third-area-2 -->
						<?php endif; ?>	
						
						<?php if ( is_active_sidebar( 'third-footer-widget-area-3' ) ) : ?>
						<div class="third-footer-widget-area-3 <?php echo esc_attr($third_f_class_3);?> hidden-phone">
							<div>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'third-footer-widget-area-3' ); ?>
								</ul>
							</div>
						</div><!-- end #footer-third-area-3 -->
						<?php endif; ?>
						
						<?php if ( is_active_sidebar( 'third-footer-widget-area-4' ) ) : ?>
						<div class="third-footer-widget-area-4 <?php echo esc_attr($third_f_class_4);?> hidden-phone">
							<div>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'third-footer-widget-area-4' ); ?>
								</ul>
							</div>
						</div><!-- end #footer-third-area-3 -->
						<?php endif; ?>
						
					</div>
		<?php endif; ?>	
		
	<?php
		}
	}	
?>