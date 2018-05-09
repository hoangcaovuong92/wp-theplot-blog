<?php
	remove_action('projects_after_loop_item','projects_template_short_description',10);
	add_action('projects_after_loop_item','wd_projects_template_short_description',10);
	if(!function_exists('wd_projects_template_short_description')){
		function wd_projects_template_short_description(){
				global $post;
			?>
			<div class="short-description">
				<?php echo wpautop(apply_filters( 'post_excerpt',  substr(get_the_excerpt(),0,30)) . '...') ?>
			</div>
			<?php	
		}
	}
	function projects_get_project_image( $size = 'project-archive' ) {
		global $post;

		if ( has_post_thumbnail() )
			return '<a href="<?php the_permalink(); ?>" class="project-permalink">' .get_the_post_thumbnail( $post->ID, $size ).'</a>';
	}	
	if(!function_exists('wd_projects')){
		function wd_projects($atts,$content){
			
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "projects-by-woothemes/projects.php", $_actived ) ) {
				return;
			}
			
			global $projects_loop;

		extract( shortcode_atts( array(
			'slider'				=> '1',
			'limit' 				=> '12',
			'columns' 				=> '4',
			'orderby' 				=> 'date',
			'order' 				=> 'desc',
			'exclude_categories'	=> null,
		), $atts ) );

		$args = array(
			'post_type'				=> 'project',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> $limit,
			'orderby' 				=> $orderby,
			'order' 				=> $order,
			'tax_query' 			=> array(
										array(
											'taxonomy' 	=> 'project-category',
											'field' 	=> 'id',
											'terms' 	=> explode( ',', $exclude_categories ),
											'operator' 	=> 'NOT IN'
										)
									)
		);

		ob_start();
	
		$projects = new WP_Query( apply_filters( 'projects_query', $args, $atts ) );

		$projects_loop['columns'] = $columns;
		
		$class_slider = (absint($slider))? ' wd-loading': '';
		
		$i=0;
		
		if ( $projects->have_posts() ) : ?>
			<?php $_random_id = 'wd_projects_slider_wrapper_'.rand(); ?>
			
			<div class="wd-projects" id="<?php echo $_random_id;?>">
				<div class="wd_projects_slider_wrapper_inner<?php echo $class_slider;?>">
					<?php projects_project_loop_start(); ?>

						<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
							
							<?php //projects_get_template_part( 'content', 'project' ); ?>
							<?php content_project($i); ?>
							<?php $i++;?>				
						<?php endwhile; // end of the loop. ?>

					<?php projects_project_loop_end(); ?>
				</div>
			</div>
		<?php endif;
		if(absint($slider)):
		?>
		<script type='text/javascript'>
				//<![CDATA[
					jQuery(document).ready(function() {
						"use strict";
						var temp_visible = <?php echo $columns;?>;
						
						var row = 1;

						var item_width = 180;
						
						var show_nav = true;


						var show_icon_nav = false;
						
						var object_selector = "#<?php echo $_random_id?>  ul.projects";
							
						var autoplay = false;
                        generate_horizontal_slide(temp_visible,row,item_width,show_nav,show_icon_nav,autoplay,object_selector);
					});
				//]]>	
				</script>
		<?php 
		endif;
		wp_reset_postdata();

		return '<div class="projects wd-columns-' . $columns . '">' . ob_get_clean() . '</div>';
		
	}
	}
	function content_project($i)
	{		
		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

		global $project, $projects_loop;
		global $post;
		add_image_size('project_thumb',575,400,true);
		// Store loop count we're currently on
		if ( empty( $projects_loop['loop'] ) )
			$projects_loop['loop'] = 0;

		// Store column count for displaying the grid
		if ( empty( $projects_loop['columns'] ) )
			$projects_loop['columns'] = apply_filters( 'projects_loop_columns', 2 );

		// Increase loop count
		$projects_loop['loop']++;

		// Extra post classes
		$classes = array();
		
		$classes[] = 'col-sm-' . (24 / absint($projects_loop['columns']));

		if($i % 2==0)
			$number = "even";
		else 
			$number = "odd";
		?>
		<li <?php post_class( $classes ); ?>>
		<div class="project-inner-item <?php echo $number; ?>">
			<?php do_action( 'projects_before_loop_item' ); ?>
				<figure class="project-thumbnail">
				<?php	if ( has_post_thumbnail()){ ?>
						<a href="<?php the_permalink() ?>" class="project-permalink"><?php echo get_the_post_thumbnail( $post->ID, 'project_thumb' ) ?></a>					
					</figure>
				<?php } ?>
			<div class="project_content">		
				<?php
					echo '<h3>' . get_the_title() . '</h3>';
				?>	
				<?php
					projects_get_template( 'loop/short-description.php' );
				?>
			</div>
			<div class="action">
			 <a class="button" href="<?php the_permalink(); ?>" class="project-permalink">View My Porfolio	</a>
			</div>
		</div>
		</li>
<?php 
	   } 
	add_shortcode('wd_projects','wd_projects');
?>