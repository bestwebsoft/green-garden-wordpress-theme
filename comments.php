<?php /**
 * The template for displaying Comments.
 *
 * @subpackage Green Garden
 * @since Green Garden 1.2
 */
if ( post_password_required() ) /*check for password verification*/
	return;
if ( have_comments() || comments_open() ) : ?>
	<article id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php printf( _n( __( 'One thought on', 'grngrdn' ) . ' &ldquo;%2$s&rdquo;', '%1$s ' . __( 'thoughts on', 'grngrdn' ) . ' &ldquo;%2$s&rdquo;', get_comments_number(), 'grngrdn' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
		</h2>
		<ul class="commentlist">
			<?php wp_list_comments( array( 'style' => 'ul', 'callback' =>'grngrdn_comment' ) ); ?>
		</ul><!-- .commentlist -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : /* are there comments to navigate through*/ ?>
			<nav id="comment-nav" class="comment-navigation" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( '&laquo;' . __( 'Older Comments', 'grngrdn' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'grngrdn' ). '&raquo;' ); ?></div>
			</nav><!-- #comment-nav .comment-navigation-->
		<?php endif; /* check for comment navigation */
	endif; /* have_comments() */
	if ( comments_open() ) :
		$args = array(
			'comment_notes_after' => '<p class="form-allowed-tags">' . __( 'You may use these', 'grngrdn' ) . '<abbr title="HyperText Markup Language"> HTML </abbr>' . __( 'tags and attributes', 'grngrdn' ) . ':' . ' <pre>' . allowed_tags() . '</pre>' . '</p>'
		);
		comment_form( $args ); /*custom comment form*/
	else : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'grngrdn' ); ?></p>
	<?php endif; ?><!-- comments_open() -->
	</article><!-- #comments .comments-area-->
<?php elseif (is_single() ) : ?>
	<article class="comments-area">
		<p class="no-comments"><?php _e( 'Comments are closed.', 'grngrdn' ); ?></p>
	</article>
<?php endif ?><!-- have_comments() || comments_open() -->
