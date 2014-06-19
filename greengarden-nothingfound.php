<?php /**
 * The template for displaying help content 
 * if post(s) or page not found.
 *
 * @subpackage Green Garden
 * @since Green Garden 1.2
 */ ?>
<article id="post-0" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="post-title wrap"><?php _e( 'Nothing Found', 'grngrdn' ); ?></h2>
	</header><!-- .entry-header -->	
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		<div class="entry">
			<p><?php _e( 'Ready to publish your first post?', 'grngrdn' ); ?> <a href="<?php _e( esc_url( admin_url( 'post-new.php' ) ) ); ?>"><?php _e( 'Get started here', 'grngrdn' ) ?></a></p>
		</div><!-- .entry -->
	<?php elseif ( is_search() ) : ?>
		<div class="entry">
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'grngrdn' ); ?></p>
		</div><!-- .entry -->
		<?php get_search_form();
	else : ?>
		<div class="entry">
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'grngrdn' ); ?></p>
		</div><!-- .entry -->
		<?php get_search_form();
	endif; /*is_home() && current_user_can( 'publish_posts' )*/ ?>
</article><!-- #post-0 .post  -->