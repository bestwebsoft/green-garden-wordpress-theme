<?php
/**
 * The Template for displaying all single posts.
 *
 * @subpackage Green Garden
 * @since      Green Garden 1.2
 */
get_header();
get_sidebar(); ?>
	<div id="grngrdn-content" class="alignright no-border">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post_<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h2 class="post-title wrap"><?php the_title(); ?></h2>
					<p class="entry-meta grey">
						<?php echo __( 'Posted on', 'green-garden' ) . '&nbsp;';
						echo '<a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_date() . '</a>';
						if ( has_category() ) {
							echo '&nbsp;' . __( 'in', 'green-garden' ) . '&nbsp;';
							the_category( ', ' );
						} ?>
					</p>
				</header><!-- .entry-header -->
				<div class="entry">
					<?php if ( has_post_thumbnail() ) : /*check for thumbnail existing*/
						the_post_thumbnail( 'grngrdn_post' ); ?>
						<p class="thumbnail-caption grey"><?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?></p>
					<?php endif;
					the_content(); ?>
					<div class="clear"></div>
					<?php wp_link_pages(); ?>
				</div><!-- .entry -->
				<?php if ( has_tag() ) : ?>
					<footer class="entry-footer">
						<p class="entry-meta grey"><?php the_tags( __( 'Tags:', 'green-garden' ) . '&nbsp;', ', ', '.' ) ?></p>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
				<nav id="post-nav" class="post-navigation" role="navigation">
					<div class="post-nav-prev alignleft"><?php previous_post_link( '%link', '&laquo; %title' ); ?></div>
					<div class="post-nav-next alignright"><?php next_post_link( '%link', '%title &raquo;' ); ?></div>
					<div class="clear"></div>
				</nav><!-- #post-nav .post-navigation -->
			</article><!-- #post -->
		<?php endwhile;
		comments_template(); ?>
	</div><!-- #grngrdn-content -->
<?php get_footer();
