<?php /**
 * The template for displaying image attachments
 *
 * @subpackage Green Garden
 * @since Green Garden 1.2
 */
get_header();
get_sidebar(); ?>
<div id="grngrdn-content" class="alignright no-border">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post_<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h2 class="post-title wrap"><?php the_title(); ?></h2>
				<p class="entry-meta grey"><?php printf( __( 'Posted on', 'grngrdn' ) . '&nbsp;' ) ?><a href="<?php the_permalink(); ?>"><?php echo get_the_date( 'j F, Y' ); ?></a><?php if ( has_category() ) printf( '&nbsp;' . __( 'in', 'grngrdn' ) . '&nbsp;' ); the_category( ', ' ); ?></p>
			</header><!-- .entry-header -->
			<div class="entry">
				<div class="entry-attachment">
					<div class="attachment">
						<?php $attachments = array_values( get_children( array( 
							'post_parent'		=> $post->post_parent, 
							'post_status'		=> 'inherit', 
							'post_type'			=> 'attachment', 
							'post_mime_type'	=> 'image', 
							'order'				=> 'ASC', 
							'orderby'			=> 'menu_order ID',
						) ) );
						foreach ( $attachments as $k => $attachment ) :
							if ( $attachment->ID == $post->ID )
								break;
						endforeach; 
						$k++;
						if ( count( $attachments ) > 1 ) :
							if ( isset( $attachments[ $k ] ) ) :
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
							else :
								// or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
							endif;
						else :
							// or, if there's only 1 image, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
						endif; ?>
						<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
							<?php $attachment_size = apply_filters( 'grngrdn_attachment_size', array( 560, 460 ) );
							echo wp_get_attachment_image( $post->ID, $attachment_size ); ?>
						</a>
						<?php if ( ! empty( $post->post_excerpt ) ) : ?>
						<div class="wp-caption-text">
							<?php the_excerpt(); ?>
						</div>
						<?php endif; ?>
					</div><!-- .attachment -->
				</div><!-- .entry-attachment -->
				<div class="entry-description">
					<?php the_content(); ?>
					<div class="clear"></div>
					<?php wp_link_pages(); ?>
				</div><!-- .entry-description -->
			</div>	<!-- .entry -->
			<nav id="image-nav" class="image-navigation" role="navigation">
				<div class="image-nav-prev alignleft"><?php previous_image_link( false, '&laquo;&nbsp;' . __( 'Previous', 'grngrdn' ) ); ?></div>
				<div class="image-nav-next alignright"><?php next_image_link( false, __( 'Next', 'grngrdn' ) . '&nbsp;&raquo;' ); ?></div>
				<div class="clear"></div>
			</nav><!-- #image-nav .image-navigation -->
		</article><!-- #post -->
	<?php endwhile;
	comments_template(); ?>
</div><!-- #grngrdn-content -->
<?php get_footer(); ?>