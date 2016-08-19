<?php
/**
 * The Header for this theme.
 *
 * Displays all of the <head> section and everything up till <div id="grngrdn-main">
 *
 * @subpackage Green Garden
 * @since      Green Garden 1.2
 */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif;
	wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="grngrdn-page">
	<div id="grngrdn-site-header" class="header">
		<div class="grngrdn-header-main aligncenter">
			<header id="grngrdn-logo" role="banner" class="alignleft">
				<h1 class="site-title  wrap">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
			</header>
			<div id="grngrdn-search" class="alignright"><?php get_search_form(); ?></div><!-- #grngrdn-search -->
			<nav id="grngrdn-main-nav" class="alignright"><?php wp_nav_menu( array( 'theme_location' => 'menu' ) ); ?></nav><!-- #grngrdn-main-nav -->
			<div class="clear"></div>
		</div><!-- .grngrdn-header-main -->
		<?php if ( get_header_image() ) : ?>
			<div id="grngrdn-custom-image-image" class="aligncenter">
				<img src="<?php header_image(); ?>" alt="" />
			</div>
		<?php endif;
		if ( is_home() ) :
			get_template_part( 'greengarden', 'slider' );
		endif; ?>
	</div><!-- #grngrdn-site-header -->
	<div class="clear"></div>
	<div id="grngrdn-main" class="aligncenter">
