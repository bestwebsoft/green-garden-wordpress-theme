<?php /**
 * The Sidebar containing widget areas.
 *
 * @subpackage Green Garden
 * @since Green Garden 1.2
 */ ?>
<div id="grngrdn-sidebar" role="complementary" class="alignleft">
	<?php $args = array(
		'before_widget'	=> '<aside class="widget wrap-widget">',
		'after_widget'	=> '</aside>',
	);
	if ( !dynamic_sidebar( 'sidebar' ) ):
		the_widget( 'WP_Widget_Recent_Posts', false, $args );
		the_widget( 'WP_Widget_Recent_Comments', false, $args );
		the_widget( 'WP_Widget_Archives', false, $args );
		the_widget( 'WP_Widget_Categories', false, $args );
	endif; /*!dynamic_sidebar( 'sidebar' )*/ ?>
</div><!-- #grngrdn-sidebar -->