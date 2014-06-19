<?php /**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=grngrdn-main div and all content after.
 *
 * @subpackage Green Garden
 * @since Green Garden 1.2
 */ ?>
		<div class="clear"></div>
		</div><!-- #grngrdn-main -->
		<footer id="colophon" class="grngrdn-site-footer">
			<div class="grngrdn-footer-main aligncenter">
				<div class="grngrdn-footer-theme-name alignleft">
					<h3 class="wrap"><?php echo wp_get_theme(); ?></h3>
				</div>
				<div class="grngrdn-footer-siteinfo alignright">
					<p><?php _e( 'Powered by', 'grngrdn' ); ?><a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>"> BestWebSoft </a><?php _e( 'and', 'grngrdn' ); ?><a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>"> WordPress</a></p>
					<p>&copy;<?php echo date( "Y" ) . '&nbsp;' ?><?php echo wp_get_theme()->get( 'Name' ); ?></p>
				</div><!-- .grngrdn-footer-siteinfo -->
				<div class="clear"></div>
			</div><!-- .grngrdn-footer-main -->
		</footer><!-- #colophon .grngrdn-site-footer -->
	</div><!-- #grngrdn-page -->
	<?php wp_footer(); ?>
</body>
</html>