<?php
/**
 * The template for displaying search forms in Green Garden
 *
 * @subpackage Green Garden
 * @since      Green Garden 1.2
 */ ?>
<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="alignleft" name="s" id="s" placeholder="<?php esc_attr_e( 'Enter search keyword', 'green-garden' ); ?>" value="<?php the_search_query(); ?>" />
	<input type="submit" class="alignright" value="" />
	<div class="clear"></div>
</form><!-- .searchform -->
