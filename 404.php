<?php
/**
 * The Template for displaying 404 pages ( Not Found ).
 *
 * @subpackage Green Garden
 * @since      Green Garden 1.2
 */
get_header();
get_sidebar(); ?>
	<div id="grngrdn-content" class="alignright">
		<article class="post">
			<header class="entry-header">
				<h2 class="post-title wrap">404</h2>
			</header>
			<div class="entry">
				<p><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'green-garden' ); ?></p>
				<p><?php _e( 'Please try using our search box below to look for information on the internet.', 'green-garden' ); ?></p>
			</div><!-- .entry -->
			<?php get_search_form(); ?>
		</article> <!-- .post -->
	</div><!-- #grngrdn-content -->
<?php get_footer();
