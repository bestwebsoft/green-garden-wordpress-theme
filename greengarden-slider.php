<?php /**
 * The template for displaying slider in header.
 *
 * @subpackage Green Garden
 * @since Green Garden 1.2
 */
global $wp_query;
	$args = array( 
		'post_type'				=> 'post',
		'meta_key'				=> 'grngrdn_add_slide',
		'meta_value'			=> 'on',
		'posts_per_page'		=> -1,
		'ignore_sticky_posts'	=> 1,
	);
	$wp_query = new WP_Query( $args );
	if ( $wp_query->have_posts() ) : /* check for existing posts with specified parameters*/ ?>
		<div class="flexslider">
			<ul class="slides">
				<?php add_filter( 'excerpt_length', 'grngrdn_slider_excerpt_length' );
				add_filter( 'excerpt_more', 'grngrdn_slider_excerpt_more' );
				while ( $wp_query->have_posts() ) :  $wp_query->the_post(); ?>
					<li>
						<div class="slider-text aligncenter">
							<div class="grngrdn-slider-head aligncenter"><h1><?php the_title(); ?></h1></div>
							<div class="grngrdn-slider-content aligncenter">
								<?php the_excerpt(); ?>
							</div><!-- .grngrdn-slider-content -->
							<a class="grngrdn-slider-more" href="<?php the_permalink(); ?>"><?php _e( 'learn more', 'grngrdn' ); ?></a>
						</div><!-- .slider-text -->
						<?php if ( has_post_thumbnail() ) : 
							the_post_thumbnail( 'grngrdn_slider' ); 
						endif; ?>
					</li>
				<?php endwhile;
				remove_filter( 'excerpt_length', 'grngrdn_slider_excerpt_length' );
				remove_filter( 'excerpt_more', 'grngrdn_slider_excerpt_more' ); ?>
			</ul><!-- .slides -->
		</div><!--.flexslider-->
	<?php endif; /* $wp_query->have_posts() */	
	wp_reset_postdata();
	wp_reset_query(); ?>