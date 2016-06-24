<?php
/**
 * The Sidebar containing widget areas.
 *
 * @subpackage Green Garden
 * @since      Green Garden 1.2
 */ ?>
<div id="grngrdn-sidebar" role="complementary" class="alignleft">
	<?php if ( is_active_sidebar( 'green-garden-sidebar' ) ) {
		dynamic_sidebar( 'green-garden-sidebar' );
	} else {
		$args = array(
			'before_widget' => '<aside class="widget wrap-widget">',
			'after_widget'  => '</aside>',
		);
		the_widget( 'WP_Widget_Recent_Posts', false, $args );
		the_widget( 'WP_Widget_Recent_Comments', false, $args );
		the_widget( 'WP_Widget_Archives', false, $args );
		the_widget( 'WP_Widget_Categories', false, $args );
	} ?>
</div><!-- #grngrdn-sidebar -->
