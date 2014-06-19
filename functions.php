<?php /**
 * Green Garden functions and definitions
 *
 * @subpackage Green Garden
 * @since Green Garden 1.2
 */
function grngrdn_content_width() {/*settting width for attachment*/
	if ( is_attachment() ) :
		global $content_width;
		$content_width = 940;
	endif;
}

function grngrdn_setup() {
	add_theme_support( 'automatic-feed-links' ); /*automatic-feed-links*/
	add_theme_support( 'post-thumbnails' ); /*support thumbnails*/
	 if ( ! isset( $content_width ) )
		$content_width = 560; /* pixels */
	add_image_size( 'grngrdn_post', 560, 283 , true ); /*size for posts thumbnail*/
	add_image_size( 'grngrdn_slider', 1920, 350 , true ); /*size for slider thumbnail*/
	$bgdefaults = array(
		'default-color'				=> '#f3f3f3',
		'default-image'				=> '',
		'wp-head-callback'			=> '_custom_background_cb',
		'admin-head-callback'		=> '',
		'admin-preview-callback'	=> '',
	);
	add_theme_support( 'custom-background', $bgdefaults );/*adding custom background*/
	$headerdefaults = array(
		'default-image'				=> '',
		'width'						=> 1920,
		'height'					=> 200,
		'flex-width'				=> false,
		'flex-height'				=> false,
		'random-default'			=> false,
		'header-text'				=> true,
		'default-text-color'		=> '6b9f3d',
		'uploads'					=> true,
		'wp-head-callback'			=> 'grngrdn_header_style',
		'admin-head-callback'		=> '',
		'admin-preview-callback'	=> '',
	);
	add_theme_support( 'custom-header', $headerdefaults );/*adding custom header*/
	load_theme_textdomain( 'grngrdn', get_template_directory() . '/languages' );/*including textdomain*/
	add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );/*including editor style*/
	register_nav_menu( 'menu', 'greengarden');/*register navigation menu*/
}

function grngrdn_widgets_init() { /*registering sidebar*/
	register_sidebar( array( 
		'name'				=> 'grngrdn_sidebar',
		'id'				=> 'sidebar',
		'before_widget'		=> '<aside id="%1$s" class="widget %2$s wrap_widget">',
		'after_widget'		=> '</aside>',
	) );
}

function grngrdn_wp_title( $title, $sep ) {/*customize site title*/
	global $paged, $page;
	if ( is_feed() )
		return $title;
	/* Add the site name. */
	$title .= get_bloginfo( 'name' );
	/* Add the site description for the home/front page. */
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	/* Add a page number if necessary. */
	if ( 2 <= $paged || 2 <= $page )
		$title = "$title $sep " . sprintf( __( 'Page', 'grngrdn' ) . '&nbsp;%s', max( $paged, $page ) );
	if ( is_category() )
		$title = sprintf( __( 'Category:', 'grngrdn' )) . "&nbsp;$title";
	if ( is_tag() )
		$title = sprintf( __( 'Tag:', 'grngrdn' )) . "&nbsp;$title";
	if ( is_search() )
		$title = sprintf( __( 'Searching for:', 'grngrdn' )) . "&nbsp;$title";
	if ( is_404() )
		$title = '404' . "&nbsp;$title";
	return $title;
}

function grngrdn_scripts_styles() { /*adding styles and scripts for theme*/
	wp_enqueue_style( 'greengardenStyles', get_template_directory_uri() . '/style.css', false, null );/*including styles*/
	wp_enqueue_script( 'greengardenScripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );	/*including main scripts*/
	wp_enqueue_script( 'greengardenScriptSlider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ) );/*including scripts for slider*/
	wp_enqueue_script( 'greengardenHtml5', get_template_directory_uri() . '/js/html5.js' );/*including scripts for compatibility html5 with IE*/
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );/*including scripts for comments reply*/
	$script_localization = array( /*array with elements to localize in scripts*/
		'choose_file'			=> __( 'Choose file', 'grngrdn' ),
		'file_is_not_selected'	=> __( 'File is not selected', 'grngrdn' ),
		'grngrdn_home_url'			=> esc_url( home_url() ),
	);
	wp_localize_script( 'greengardenScripts', 'script_loc', $script_localization );/*localization in scripts*/
}

function grngrdn_comment( $comment, $args, $depth ){/*customize comments*/
	$GLOBALS['comment'] = $comment;
	global $post;
	switch ( $comment->comment_type ) :
		case 'pingback':
		case 'trackback': ?>
			<li <?php comment_class(); ?> id="list-comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback', 'grngrdn' ); ?>: <?php comment_author_link(); ?></p><?php edit_comment_link( '&#9997;' . __( 'Edit', 'grngrdn' ) ); ?>
			</li>
		<?php break;
		default : ?>
			<li <?php comment_class(); ?> id="list-comment-<?php comment_ID(); ?>">		
				<article id="comment-<?php comment_ID(); ?>" class="article-comment">
					<header class="comment-header comment-author vcard">
						<?php echo get_avatar ( $comment, 60 );
						printf( '<cite><b class="fn">' . __( 'by', 'grngrdn' ) . '&nbsp;%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						/* If current post author is also comment author, make it known visually.*/
						( $comment->user_id === $post->post_author ) ? '<sup>' . __( 'This is post author', 'grngrdn' ) . '</sup>' : '' );
						printf( '<br><a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( '%1$s ' . __( 'at', 'grngrdn' ) . ' %2$s', get_comment_date(), get_comment_time() )
						); ?>
					</header><!-- .comment-header .comment-author .vcard -->
					<section class="comment-content comment">
						<?php comment_text();
						edit_comment_link( '&#9997;' . __( 'Edit', 'grngrdn' ) ); ?>
					</section><!-- .comment-content .comment -->
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'grngrdn' ) . '&nbsp;&darr;', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div> <!-- .reply -->
				</article><!-- #comment .article-comment -->
			</li>
		<?php break;
	endswitch;
}

function grngrdn_slider_excerpt_length( $length ) { /*filter for slider excerpt ( 23 words )*/
	return 23;
}

function grngrdn_slider_excerpt_more( $more ) { /*filter for slider excerpt ( nothing instead [...] )*/
	return '';
}

function grngrdn_excerpt_more( $more ) { /*filter for customize 'more' in excerpt*/
	return ' <a class="continue" href="'. get_permalink( get_the_ID() ) . '">[' . __( 'Continue', 'grngrdn' ) . ']</a>';
}

function grngrdn_metabox_for_slider(){ /*adding metabox for show post in slider*/
	add_meta_box( 'grngrdn_checkbox_for_slider', __( 'Add to slider' , 'grngrdn'), 'grngrdn_metabox_for_slider_callback', 'post', 'normal' );
}

function grngrdn_save_post_meta_for_slider( $post_id ){ /* add and save meta for post*/
	global $post, $post_id;	
	if ( wp_is_post_revision( $post_id ) )
		return $post_id;
	if ( $post != NULL ) :
		if ( ( isset ( $_POST['grngrdn_add_slide'] ) ) && ( $_POST['grngrdn_add_slide'] == 'on' ) ) :
			update_post_meta( $post->ID, 'grngrdn_add_slide', $_POST['grngrdn_add_slide'] );
		else :
			update_post_meta( $post->ID, 'grngrdn_add_slide', 'off' );
		endif;
	endif;
}

function grngrdn_metabox_for_slider_callback(){ /*customize metabox*/
	global $post; 
	$screen = get_current_screen(); ?>
	<label for='grngrdn_add_slide'><?php echo __( 'To add this', 'grngrdn' ) . '&nbsp;' . $screen->post_type . '&nbsp;' . __( 'into the slider, mark it', 'grngrdn' ); ?></label>	
	<input type='checkbox' name='grngrdn_add_slide' id='grngrdn_add_slide' value='on' <?php if ( 'on' == get_post_meta( $post->ID, 'grngrdn_add_slide', true ) ) : ?> checked='checked' <?php endif; ?> />
	<?php }

function grngrdn_autosave_slider( $post_id ) {/*save slider settings if autosave*/
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;
	elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
}

function grngrdn_header_style() {
	$text_color = get_header_textcolor();
	$display_text = display_header_text();
	if ( $text_color == HEADER_TEXTCOLOR )/* If no custom options for text are set, return default. */
		return;
	/* If optins are set, we use them */ ?>
	<style type="text/css">
	<?php 
		if ( 'blank' == $text_color ) { /* If the user has set a custom color for the text use that */
		} else { ?>
		.site-title a {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php } 
	if( ! $display_text ){ /* Display text or not */ ?>
		.site-title {
			display: none;
		}
	<?php } ?>
	</style>
<?php }

add_action( 'template_redirect', 'grngrdn_content_width' ); 
add_action( 'after_setup_theme','grngrdn_setup' );
add_action( 'widgets_init', 'grngrdn_widgets_init' );
add_filter( 'wp_title', 'grngrdn_wp_title', 10, 2 );
add_action( 'wp_enqueue_scripts', 'grngrdn_scripts_styles' );
add_filter( 'excerpt_more', 'grngrdn_excerpt_more' );
add_action( 'add_meta_boxes', 'grngrdn_metabox_for_slider' );
add_action( 'save_post', 'grngrdn_save_post_meta_for_slider' );
add_action( 'save_post', 'grngrdn_autosave_slider' ); ?>