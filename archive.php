<?php /**
 * The template for displaying Archive pages.
 *
 * @subpackage Green Garden
 * @since Green Garden 1.2
 */
get_header();
get_sidebar(); ?>
<div id="grngrdn-content" class="alignright">
	<div class="grngrdn-archive-name">
		<h1 class="grngrdn-page-title">
			<?php if ( is_day() ) :
				printf( __( 'Daily Archives:', 'grngrdn' ) . '&nbsp;' . '%s', get_the_date() );
					elseif ( is_month() ) :
				printf( __( 'Monthly Archives:', 'grngrdn' ) . '&nbsp;' . '%s', get_the_date( _x( 'F Y', 'monthly archives date format', 'grngrdn' ) ) );
					elseif ( is_year() ) :
				printf( __( 'Yearly Archives:', 'grngrdn' ) . '&nbsp;' . '%s', get_the_date( _x( 'Y', 'yearly archives date format', 'grngrdn' ) ) );
					else :
				_e( 'Archives:', 'grngrdn' );
			endif; /*is_day()*/ ?>
		</h1><!-- .grngrdn-page-title -->
	</div>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article id="post_<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h3 class="post-title wrap"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="entry-meta grey"><?php printf( __( 'Posted on', 'grngrdn' ) . '&nbsp;' ) ?><a href="<?php the_permalink(); ?>"><?php echo get_the_date( 'j F, Y' ) ?></a><?php if ( has_category() ) printf( '&nbsp;' . __( 'in', 'grngrdn' ) . '&nbsp;' ); the_category( ', ' ); ?></p>
			</header><!-- .entry-header -->
			<div class="entry">
				<?php if ( has_post_thumbnail() ) : /*check for thumbnail existing*/
					the_post_thumbnail( 'grngrdn_post' ); ?>
					<p class="thumbnail-caption grey"><?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?></p>
				<?php endif;
				the_excerpt(); ?>
			</div><!-- .entry -->
			<?php if ( has_tag() ) : ?>
				<footer class="entry-footer">
					<p class="entry-meta grey"><?php the_tags( __( 'Tags:', 'grngrdn' ) . '&nbsp;' ,', ','.' ) ?></p>
				</footer><!-- .entry-footer -->
			<?php endif; ?>
		</article><!-- #post -->
	<?php endwhile; ?>
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
			<nav id="posts-nav" class="posts-navigation" role="navigation">
				<div class="posts-nav-prev alignleft"><?php previous_posts_link( '&laquo;&nbsp;' . __( 'Previous page', 'grngrdn' ) ); ?></div>
				<div class="posts-nav-next alignright"><?php next_posts_link( __( 'Next page', 'grngrdn' ) . '&nbsp;&raquo;' ); ?></div>
				<div class="clear"></div>
			</nav><!-- #posts-nav .posts-navigation -->
		<?php endif; ?>
	<?php else:
		get_template_part( 'greengarden', 'nothingfound' );
	endif; ?> <!-- have_posts() -->
</div><!-- #grngrdn-content -->
<?php get_footer(); ?>